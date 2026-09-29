<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $user = Auth::user();

        return view('checkout.index', compact('cart', 'total', 'user'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong.');
        }

        $rules = [
            'shipping_address' => ['required', 'string', 'max:1000'],
        ];

        if (!Auth::check()) {
            $rules['guest_name'] = ['required', 'string', 'max:255'];
            $rules['guest_email'] = ['required', 'email', 'max:255'];
            $rules['guest_phone'] = ['required', 'string', 'max:25'];
        }

        $validated = $request->validate($rules);

        return DB::transaction(function () use ($validated, $cart) {
            $totalPrice = 0;

            foreach ($cart as $item) {
                $book = Book::lockForUpdate()->find($item['id']);
                if (!$book || $book->stock < $item['qty']) {
                    return redirect()->route('cart.index')->with('error', 'Stok untuk buku "' . ($book ? $book->title : 'Item') . '" tidak mencukupi atau telah berubah.');
                }
                $totalPrice += $item['price'] * $item['qty'];
            }

            $orderCode = 'WS-' . strtoupper(Str::random(8)) . '-' . date('ymd');

            $order = Order::create([
                'user_id' => Auth::id(),
                'guest_name' => Auth::check() ? null : $validated['guest_name'],
                'guest_email' => Auth::check() ? null : $validated['guest_email'],
                'guest_phone' => Auth::check() ? null : $validated['guest_phone'],
                'order_code' => $orderCode,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'payment_method' => 'cod',
                'shipping_address' => $validated['shipping_address'],
            ]);

            foreach ($cart as $item) {
                $book = Book::find($item['id']);
                $book->decrement('stock', $item['qty']);

                OrderItem::create([
                    'order_id' => $order->id,
                    'book_id' => $book->id,
                    'book_title' => $book->title,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                ]);
            }

            session()->forget('cart');

            return redirect()->route('checkout.success', $order->order_code);
        });
    }

    public function success(string $orderCode)
    {
        $order = Order::with('items')->where('order_code', $orderCode)->firstOrFail();

        return view('checkout.success', compact('order'));
    }
}
