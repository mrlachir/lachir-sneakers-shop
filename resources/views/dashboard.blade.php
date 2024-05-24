@extends('layouts.sidebarmenu')

@section('content')
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-2">
                    <div class="bg-gary-900 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-gray-900 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2 text-white">Orders Per Time</h3>
                            <!-- Form for Selecting Sneaker -->
                            <form class="flex" id="sneakerForm" method="GET">
                                <!-- Sneaker Selection Dropdown -->
                                <select id="sneaker_id" name="sneaker_id"
                                    class="flex w-auto h-10 mr-2 mb-4 bg-yellow-300 border border-gray-400 rounded">
                                    <option value="">All Sneakers</option>
                                    @foreach ($sneakers as $sneaker)
                                        <option value="{{ $sneaker->id }}">{{ $sneaker->name }}</option>
                                    @endforeach
                                </select>
                                <!-- Submit Button -->
                                <button type="button" id="goToSneakerBtn"
                                    class="flex bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 h-10 rounded">
                                    Go
                                </button>
                            </form>
                            <!-- Chart Container -->
                            <div id="chartdiv" style="width: 100%; height: 300px;"></div>
                        </div>
                    </div>


                    {{-- totals --}}
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Total Income -->
                        <div class="bg-blue-200 overflow-hidden shadow-sm sm:rounded-lg dashboard-section">
                            <div
                                class="h-full flex flex-col justify-center items-center p-6 bg-blue-300 border-b border-gray-200">
                                <h3 class="font-semibold text-xl mb-2 dashboard-heading">Total Income</h3>
                                <div class="dashboard-content">
                                    <p class="text-4xl">${{ $totalIncome }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Users -->
                        <div class="bg-green-200 overflow-hidden shadow-sm sm:rounded-lg dashboard-section">
                            <div
                                class="h-full flex flex-col justify-center items-center p-6 bg-green-300 border-b border-gray-200">
                                <h3 class="font-semibold text-xl mb-2 dashboard-heading">Total Users</h3>
                                <div class="dashboard-content">
                                    <p class="text-4xl">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Shoes -->
                        <div class="bg-yellow-200 overflow-hidden shadow-sm sm:rounded-lg dashboard-section">
                            <div
                                class="h-full flex flex-col justify-center items-center p-6 bg-yellow-300 border-b border-gray-200">
                                <h3 class="font-semibold text-xl mb-2 dashboard-heading">Total Shoes in stock</h3>
                                <div class="dashboard-content">
                                    <p class="text-4xl">{{ $totalShoes }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Total Orders -->
                        <div class="bg-red-200 overflow-hidden shadow-sm sm:rounded-lg dashboard-section">
                            <div
                                class="h-full flex flex-col justify-center items-center p-6 bg-red-300 border-b border-gray-200">
                                <h3 class="font-semibold text-xl mb-2 dashboard-heading">Total Orders</h3>
                                <div class="dashboard-content">
                                    <p class="text-4xl">{{ $totalOrders }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Selling Sneakers Table -->
                    <div class="bg-blue-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-blue-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Top Selling Sneakers</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-blue-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sneaker Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Brand
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Orders Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topSellingSneakers as $sneaker)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $sneaker->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $sneaker->brand->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $sneaker->category->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $sneaker->orders_count }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $topSellingSneakers->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Top Users with Orders Table -->
                    <div class="bg-green-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-green-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Top Users with Orders</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-green-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Orders Count
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Total Spend
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topUsersWithOrders as $user)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $user->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $user->orders_count }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        ${{ $user->orders->sum('total_price') }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $topUsersWithOrders->links() }}
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
                <div class="grid grid-cols-1 gap-6 py-6 md:grid-cols-2 xl:grid-cols-3">
                    <!-- Top Selling Brands Table -->
                    <div class="bg-yellow-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-yellow-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Top Selling Brands</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-yellow-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Brand Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sneakers Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topSellingBrands as $brand)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $brand->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $brand->sneakers_count }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $topSellingBrands->links() }}
                            </div>
                        </div>

                    </div>

                    <!-- Top Selling Categories Table -->
                    <div class="bg-purple-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-purple-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Top Selling Categories</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-purple-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Category Name
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sneakers Count
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($topSellingCategories as $category)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $category->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $category->sneakers_count }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $topSellingCategories->links() }}
                            </div>
                        </div>
                    </div>

                    {{-- Newsletter subscriptions --}}
                    <div class="bg-red-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-red-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Newsletter subscriptions</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-red-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Id
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                e-mail
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($Newsletters as $Newsletter)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $Newsletter->id }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $Newsletter->email }}
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $Newsletters->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6 py-6 md:grid-cols-2 xl:grid-cols-1">
                    <!-- Last Orders Table -->
                    <div class="bg-blue-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-blue-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Last Orders</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-blue-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Order ID
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sneaker
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantity
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($lastOrders as $order)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $order->id }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $order->created_at }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">
                                                        {{ $order->sneaker->id }}_{{ $order->sneaker->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $order->quantity }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $order->user->name }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $lastOrders->links() }}
                            </div>
                        </div>
                    </div>

                    <!-- Last Reviews Table -->
                    <div class="bg-green-100 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 h-full bg-green-200 border-b border-gray-200">
                            <h3 class="font-semibold text-xl mb-2">Last Reviews</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <!-- Table Header -->
                                    <thead class="bg-green-50">
                                        <tr>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Review ID
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sneaker
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                User
                                            </th>
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Rating
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($lastReviews as $review)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $review->id }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $review->created_at }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $review->sneaker->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $review->user->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $review->rating }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $lastReviews->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </x-app-layout>



    <!-- JavaScript Code to Update Form Action and Submit Form -->
    <script>
        document.getElementById('goToSneakerBtn').addEventListener('click', function() {
            var sneakerId = document.getElementById('sneaker_id').value;
            var form = document.getElementById('sneakerForm');
            form.action = '/dashboard/' + sneakerId;
            form.submit();
        });
    </script>
    <!-- AmCharts Script -->
    <script src="https://www.amcharts.com/lib/3/amcharts.js?x"></script>
    <script src="https://www.amcharts.com/lib/3/serial.js?x"></script>
    <script src="https://www.amcharts.com/lib/3/themes/dark.js"></script>

    <!-- AmCharts Script -->
    <script>
        // Retrieve orders per time period data passed from controller
        var ordersPerTime = {!! json_encode($ordersPerTime) !!};

        // Create chart
        var chart = AmCharts.makeChart("chartdiv", {
            "type": "serial",
            "theme": "dark",
            "dataProvider": ordersPerTime,
            "valueAxes": [{
                "title": "Number of Orders"
            }],
            "graphs": [{
                "valueField": "orders",
                "type": "column",
                "fillAlphas": 0.8
            }],
            "categoryField": "date",
            "categoryAxis": {
                "parseDates": true,
                "minPeriod": "DD",
                "dashLength": 1
            }
        });
    </script>
@endsection
