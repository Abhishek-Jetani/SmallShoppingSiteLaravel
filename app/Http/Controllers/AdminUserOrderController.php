<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class AdminUserOrderController extends Controller
{

    public function userAllOrders(Request $request)
    {
        if ($request->ajax()) {
           $query = Order::with('user', 'product');

            if ($request->start_date) {
                $query->whereDate('created_at', '>=', $request->start_date);
            }
            if ($request->end_date) {
                $query->whereDate('created_at', '<=', $request->end_date);
            }
            
            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row->user->name;
                })
                ->addColumn('product_name', function ($row) {
                    return $row->product->title;
                })
                ->addColumn('quantity', function ($row) {
                    return $row->quantity;
                })
                ->addColumn('total_price', function ($row) {
                    return $row->total_price;
                })
                ->addColumn('order_date', function ($row) {
                    return $row->created_at->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($row) {
                    $deleteButton = '<button class="btn delete-order" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></button>';
                    return $deleteButton;
                })
                ->filterColumn('quantity', function($query, $keyword) {
                    $sql = "CONCAT(orders.quantity,'-',orders.created_at)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->orderColumn('created_at', function ($data, $order) {
                    $data->orderBy('created_at', $order);
                })
                ->rawColumns(['user_name', 'product_name', 'quantity', 'total_price', 'order_date', 'action'])
                ->toJson();
        }

        return view('admin.order.user_all_order');
    }


    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return response()->json(['message' => 'Order Deleted Successfully'], 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Something went wrong, please refresh the page'], 500);
        }
    }
}
