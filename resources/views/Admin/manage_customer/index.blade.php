@extends('layouts.admin_layout')
@section('title')
    Customers
@endsection

@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<style>
    .page-header-box {
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: rgba(0,0,0,0.07) 0px 4px 15px;
    }

    .apple-input {
        border-radius: 10px !important;
        padding: 8px 12px !important;
        border: 1px solid #e2e2e2 !important;
    }

    .apple-input:focus {
        border-color: #007aff !important;
        box-shadow: none !important;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: rgba(0,0,0,0.07) 0px 4px 15px;
    }

    .select2-selection--single {
        border-radius: 10px !important;
        border: 1px solid #e2e2e2 !important;
        height: 40px !important;
        padding: 6px !important;
    }

    .badge-active {
        background-color: #32d74b;
    }

    .badge-deactive {
        background-color: #ff3b30;
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
</style>
@endsection


@section('content')

<div class="page-header-box mb-3">
    <div class="d-flex justify-content-between align-items-center">

        <h3 class="m-0 fw-semibold">Manage Customers</h3>

        <div class="d-flex gap-2">

            <select id="statusactive" class=" apple-input">
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
            </select>

            <a href="{{ route('admin.trashedUser') }}" class="apple-btn d-flex align-items-center gap-2">
                <i class="fa fa-trash"></i> Trash
            </a>

        </div>

    </div>
</div>


<div class="table-container">
    <table id="customer_table" class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th style="width: 35%;">Name</th>
                <th style="width: 35%;">Email</th>
                <th style="width: 15%;">Status</th>
                <th style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- Ajax Data --}}
        </tbody>
    </table>
</div>

@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$('#statusactive').select2({
    minimumResultsForSearch: -1,
    width: '130px'
});

$(document).ready(function () {

    var dataTable = $('#customer_table').DataTable({
        processing: true,
        serverSide: true,
        stateSave: true,
        ajax: {
            url: '{{ route('users.index') }}',
            type: 'GET',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.status = $('#statusactive').val();
            },
        },
        columns: [
            { data: 'name' },
            { data: 'email' },
            { data: 'status', orderable: false, searchable: false },
            { data: 'action', orderable: false, searchable: false },
        ]
    });

    $('#statusactive').change(function() {
        dataTable.draw();
    });

});
</script>
@endsection
