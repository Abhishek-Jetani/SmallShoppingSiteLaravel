<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $ProductCount = Product::count();
        $UserCount = User::count();
        $CategoryCount = Category::count();
        $OrderCount = Order::count();
        $TotalRevenue = Order::sum('total_price');
        $topSellingProducts = Order::select('product_id', DB::raw('SUM(quantity) as total_quantity'))
        ->groupBy('product_id')->orderBy('total_quantity', 'desc')->take(5)->with('product:id,title,price,image')->get();

        return view('Admin.Dashboard', compact('ProductCount', 'OrderCount', 'CategoryCount', 'UserCount', 'TotalRevenue', 'topSellingProducts'));
    }

    public function getStats(Request $request)
    {
        $range = $request->get('range');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        if ($range) {
            switch ($range) {
                case 'today':
                    $startDate = Carbon::today();
                    $endDate = Carbon::today();
                    break;
                case 'week':
                    $startDate = Carbon::now()->startOfWeek();
                    $endDate = Carbon::now()->endOfWeek();
                    break;
                case 'month':
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                    break;
                case 'year':
                    $startDate = Carbon::now()->startOfYear();
                    $endDate = Carbon::now()->endOfYear();
                    break;
                default:
                    return response()->json(['error' => 'Invalid range'], 400);
            }
        } else if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate);
        } else {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        // Example: Fetch stats based on the date range
        $orders = Order::whereBetween('created_at', [$startDate, $endDate])->count();
        $sales = Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_price');
        $averageSales = $sales / ($orders ?: 1);
        $customers = User::whereBetween('created_at', [$startDate, $endDate])->count();

        return response()->json([
            'orders' => $orders,
            'sales' => $sales,
            'averageSales' => $averageSales,
            'customers' => $customers
        ]);
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->has('remember'))) {
            $user = Auth::user();

            if ($user->role == 1) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'You are not an admin');
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid email or password']);
        }
    }

    public function adminchangePassword(Request $request)
    {
        return view('admin.change-password_admin');
    }

    public function adminchangePasswordSave(Request $request)
    {

        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = Auth::user();

        if (!Hash::check($request->get('current_password'), $auth->password)) {
            return back()->with('error', "Current Password is Invalid");
        }

        if (strcmp($request->get('current_password'), $request->new_password) == 0) {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return redirect()->route('admin.dashboard')->with('success', "Password Changed Successfully");
    }
}
