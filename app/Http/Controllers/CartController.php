<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, Book $book)
    {
        $request->validate([
            'qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $qty = (int) $request->input('qty', 1);

        if ($book->stock < $qty) {
            return back()->with('error', 'Stok buku tidak mencukupi untuk jumlah yang diminta.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $newQty = $cart[$book->id]['qty'] + $qty;
            if ($book->stock < $newQty) {
                return back()->with('error', 'Total jumlah di keranjang melebihi stok yang tersedia.');
            }
            $cart[$book->id]['qty'] = $newQty;
        } else {
            $cart[$book->id] = [
                'id' => $book->id,
                'title' => $book->title,
                'author' => $book->author,
                'price' => (float) $book->price,
                'qty' => $qty,
                'cover' => $book->cover,
                'stock' => $book->stock,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Buku berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $qty = (int) $request->input('qty');

        if ($book->stock < $qty) {
            return back()->with('error', 'Stok tidak mencukupi.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            $cart[$book->id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(Book $book)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$book->id])) {
            unset($cart[$book->id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Buku berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang telah dikosongkan.');
    }
}
