<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $dateRange = $request->input('date_range', '30'); // Default to last 30 days
        $startDate = Carbon::now()->subDays($dateRange)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Sales Report
        $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_price');

        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $totalProductsSold = Order::whereBetween('created_at', [$startDate, $endDate])
            ->sum('quantity');

        // Daily Sales Data for Chart
        $dailySales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total_price) as total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Top Selling Products
        $topSellingProducts = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc')
            ->take(10)
            ->with('product:id,title,price,image')
            ->get();

        // Sales by Category
        $salesByCategory = Order::whereBetween('orders.created_at', [$startDate, $endDate])
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'categories.title as category_name',
                DB::raw('SUM(orders.quantity) as total_quantity'),
                DB::raw('SUM(orders.total_price) as total_revenue')
            )
            ->groupBy('categories.id', 'categories.title')
            ->orderBy('total_revenue', 'desc')
            ->get();


        // Order Status Distribution
        $orderStatus = Order::whereBetween('created_at', [$startDate, $endDate])
            ->select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Monthly Sales Trend (Last 6 months)
        $monthlySales = Order::where('created_at', '>=', Carbon::now()->subMonths(6))
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'), DB::raw('SUM(total_price) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Customer Statistics
        $newCustomers = User::whereBetween('created_at', [$startDate, $endDate])
            ->where('role', 'user')
            ->count();

        $activeCustomers = Order::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count('user_id');

        // Average Order Value
        $averageOrderValue = $totalOrders > 0 ? ($totalSales / $totalOrders) : 0;

        return view('Admin.Reports', compact(
            'totalSales',
            'totalOrders',
            'totalProductsSold',
            'dailySales',
            'topSellingProducts',
            'salesByCategory',
            'orderStatus',
            'monthlySales',
            'newCustomers',
            'activeCustomers',
            'averageOrderValue',
            'dateRange',
            'startDate',
            'endDate'
        ));
    }
}

