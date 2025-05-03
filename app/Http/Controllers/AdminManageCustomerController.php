<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AdminManageCustomerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('role', '!=', '1')->select('*');
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<label class="badge text-bg-success"> Active </label>'
                        : '<label class="badge text-bg-danger"> Deactive </label>';
                })
                ->addColumn('action', function ($row) {
                    $deleteForm = '<form action="' . route('admin.deleteCustomer', $row->id) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit" class="btn delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></button></form>';

                    $statusButton = $row->status == 1
                        ? '<a href="' . route('admin.deactivateCustomer', $row->id) . '" class="btn status-btn"><i class="fa fa-ban text-danger"></i></a>'
                        : '<a href="' . route('admin.activateCustomer', $row->id) . '" class="btn status-btn"><i class="fa fa-check text-success"></i></a>';

                    return $deleteForm . ' ' . $statusButton;
                })
                ->filterColumn('name', function($query, $keyword) {
                    $sql = "CONCAT(users.name,'-',users.email)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->orderColumn('name', function ($data, $order) {
                    $data->orderBy('name', $order);
                })
                ->filter(function ($instance) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $instance->where('status', $request->get('status'));
                    }
                })
                ->rawColumns(['name', 'email', 'status', 'action'])
                ->toJson();
        }
        return view('admin.manage_customer.index');
    }

    public function trashedUser(Request $request)
    {
        if ($request->ajax()) {
            $data = User::onlyTrashed()->where('role', '!=', '1')->select('*');
           
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('email', function ($row) {
                    return $row->email;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<form action="' . route('admin.restoreCustomer', $row->id) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit" class="btn delete-btn" data-id="' . $row->id . '"><i class="fa fa-undo text-success"></i></button></form>';
                    $btn .= '<form action="' . route('admin.permanentDeleteCustomer', $row->id) . '" method="POST" style="display:inline;" id="delete-form-' . $row->id . '">'
                        . csrf_field() . method_field('DELETE')
                        . '<button type="submit" class="btn delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash text-danger"></i></button></form>';

                    return $btn;
                })
                ->filterColumn('email', function($query, $keyword) {
                    $sql = "CONCAT(users.name,'-',users.email)  like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                })
                ->orderColumn('name', function ($data, $order) {
                    $data->orderBy('name', $order);
                })
                ->rawColumns(['name', 'email', 'action'])
                ->toJson();
        }
        return view('admin.manage_customer.trashed');
    }


    public function activateUser($CustomerId)
    {
        $Customer = User::find($CustomerId);

        if ($Customer) {
            $Customer->status = true;
            $Customer->save();
            return redirect()->back()->with('success', 'Customer activated successfully');
        }
        return redirect()->back()->with('error', 'Customer not found');
    }

    public function deactivateUser($CustomerId)
    {
        $Customer = User::find($CustomerId);
        if ($Customer) {
            $Customer->status = false;
            $Customer->save();
            return redirect()->back()->with('success', 'Customer deactivated successfully');
        }
        return redirect()->back()->with('error', 'Customer not found');
    }

    public function deleteUser($userId)
    {
        try {
            $result = deleteItem(User::class, $userId, null);

            if ($result['success']) {
                return redirect()->back()->with('success', 'User temporary deleted');
            } else {
                return redirect()->back()->with('error', $result['message']);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong, please refresh the page');
        }
    }

    public function restoreUser($trashedUser)
    {
        $Customer = User::withTrashed()->find($trashedUser);
        if ($Customer) {
            $Customer->restore();
            return redirect()->back()->with('success', 'Customer restore successfully');
        }
        return redirect()->back()->with('error', 'Customer not found');
    }

    public function permanentDeleteUser($trashedUser)
    {
        try {
            $Customer = User::withTrashed()->find($trashedUser);

            if ($Customer) {
                $Customer->forceDelete();
                return redirect()->back()->with('success', 'Customer permanently deleted successfully');
            } else {
                return redirect()->back()->with('error', 'Customer not found');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred during permanent deletion');
        }
    }
}
