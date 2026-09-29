<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('role', 'customer')->count();
        $totalPendingOrders = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalCategories',
            'totalUsers',
            'totalPendingOrders',
            'recentOrders'
        ));
    }
}
