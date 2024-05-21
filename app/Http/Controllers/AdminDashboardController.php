<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sneaker;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalSneakers = Sneaker::count();
        $totalBrands = Brand::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        return response()->json([
            'totalSneakers' => $totalSneakers,
            'totalBrands' => $totalBrands,
            'totalCategories' => $totalCategories,
            'totalOrders' => $totalOrders,
            'totalUsers' => $totalUsers,
        ]);
    }

    public function topSellingSneakers()
    {
        $topSellingSneakers = OrderItem::select('sneaker_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('sneaker_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return response()->json($topSellingSneakers);
    }

    public function topSpendingUsers()
    {
        $topSpendingUsers = Order::select('user_id', DB::raw('SUM(total) as total_spent'))
            ->groupBy('user_id')
            ->orderByDesc('total_spent')
            ->limit(10)
            ->get();

        return response()->json($topSpendingUsers);
    }
}