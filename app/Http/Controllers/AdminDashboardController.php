<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sneaker;
use App\Models\Brand;
use App\Models\Category;
use App\Models\NewsletterSubscription;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request, $sneaker_id = null)
    {
        // $lastOrders = Order::latest()->take(5)->get();
        $query = Order::query();
        $query->with('user', 'sneaker')->latest()->get();
        $lastOrders = $query->paginate(5);
        
        $query = Review::query();
        $query->with('user', 'sneaker')->latest()->get();
        $lastReviews = $query->paginate(5);


        // $topSellingSneakers = Sneaker::with('brand', 'category')
        // ->withCount('orders')
        // ->orderBy('orders_count', 'desc')
        // ->take(5)
        // ->get();  
        
        $query = Sneaker::query();
        $query->with('brand', 'category')
        ->withCount('orders')
        ->orderBy('orders_count', 'desc')
        ->get();
        $topSellingSneakers = $query->paginate(5);

        $query = Brand::query();
        $query->withCount('sneakers')->orderBy('sneakers_count', 'desc')->get();
        $topSellingBrands = $query->paginate(5);

        $query = Category::query();
        $query->withCount('sneakers')->orderBy('sneakers_count', 'desc')->get();
        $topSellingCategories = $query->paginate(5);
        // Fetch top 5 users with the most orders
        $query = User::query();
        $query->withCount('orders')->orderBy('orders_count', 'desc')->get();
        $topUsersWithOrders = $query->paginate(5);
        // Newsletter subscriptions
        $query = NewsletterSubscription::query();
        $query->latest()->get();
        $Newsletters = $query->paginate(5);


        $totalIncome = Order::sum('total_price');
        $totalUsers = User::count();
        $totalShoes = Sneaker::sum('stock');
        $totalOrders = Order::sum('quantity');
        $sneakers= Sneaker::all();

        
        // Fetch orders per time period
    if ($sneaker_id !== null) {
        $ordersPerTime = Order::where('sneaker_id', $sneaker_id)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'))
            ->groupBy('date')
            ->get();
    } else {
        $ordersPerTime = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'))
            ->groupBy('date')
            ->get();
    }

    // Fetch all sneakers for dropdown selection
    $sneakers = Sneaker::all();

            if ($sneaker_id) {
                $ordersPerTime = Order::where('sneaker_id', $sneaker_id)
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'))
                    ->groupBy('date')
                    ->get();
            } else {
                $ordersPerTime = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as orders'))
                    ->groupBy('date')
                    ->get();
            }
        // Pass the top users with orders to the view
        return view('dashboard', compact('Newsletters','lastOrders','ordersPerTime','sneakers', 'lastReviews','totalOrders', 'topSellingSneakers', 'topSellingBrands', 'topSellingCategories', 'totalIncome', 'totalUsers', 'totalShoes', 'topUsersWithOrders'));
    }


}