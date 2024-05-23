<?php

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\Sneaker;
use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the last 5 orders
        $lastOrders = Order::with('user', 'sneaker')->latest()->take(2)->get();

        // Fetch the last 5 reviews
        $lastReviews = Review::with('user', 'sneaker')->latest()->take(5)->get();

        // Fetch top selling sneakers
        $topSellingSneakers = Sneaker::with('brand', 'category')
            ->withCount('orders')
            ->orderBy('orders_count', 'desc')
            ->take(5)
            ->get();

        // Fetch total income, users, and sneakers
        $totalIncome = Order::sum('total_price');
        $totalUsers = User::count();
        $totalSneakers = Sneaker::count();

        // Fetch sale statistics for the chart (e.g., sales by month)
        $saleStatistics = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as total_sales')
            )
            ->groupBy('month')
            ->get();

        // Fetch order statistics
        $orderStatistics = [
            'totalOrders' => Order::count(),
            'pendingOrders' => Order::where('status', 'pending')->count(),
            'completedOrders' => Order::where('status', 'completed')->count(),
            // Add other statuses as needed
        ];

        return view('dashboard.index', compact(
            'lastOrders', 
            'lastReviews', 
            'topSellingSneakers', 
            'totalIncome', 
            'totalUsers', 
            'totalSneakers', 
            'saleStatistics', 
            'orderStatistics'
        ));
    }
}
