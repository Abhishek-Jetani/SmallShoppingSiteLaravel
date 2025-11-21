@extends('layouts.admin_layout')
@section('title')
    Deleted Customers
@endsection

@section('styles')
<style>
    .page-header-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: rgba(0,0,0,0.08) 0px 4px 16px;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: rgba(0,0,0,0.05) 0px 4px 16px;
    }

    .apple-btn {
        background-color: #007aff;
        color: white;
        border-radius: 10px;
        padding: 8px 14px;
        border: none;
    }

    .apple-btn:hover {
        background-color: #0066d6;
        color: white;
    }

    .apple-btn-danger {
        background-color: #ff3b30;
        color: white;
        border-radius: 10px;
        padding: 8px 14px;
        border: none;
    }

    .apple-btn-danger:hover {
        background-color: #d9261f;
        color: white;
    }
</style>
@endsection

@section('content')

<div class="page-header-box mb-3">
    <div class="d-flex justify-content-between align-items-center">

        <h3 class="m-0 fw-semibold">Deleted Customers</h3>

        <a href="{{ route('admin.manageCustomer.index') }}" class="apple-btn-danger d-flex align-items-center gap-2">
            <i class="fa fa-arrow-left"></i> Back
        </a>

    </div>
</div>


<div class="table-container">
    <table id="trashed_user_table" class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 35%;">Name</th>
                <th style="width: 40%;">Email</th>
                <th style="width: 25%;">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- AJAX DATA --}}
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function () {

    var table = $('#trashed_user_table').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            url: '{{ route('admin.trashedUser') }}',
            type: 'GET',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
            },
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });

});
</script>
@endsection
