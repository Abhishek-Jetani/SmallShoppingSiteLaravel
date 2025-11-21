@extends('layouts.admin_layout')

@section('title', 'Orders')

@section('styles')
<style>
    /* Page fade animation */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }

    /* Card shadow & smooth edges */
    .card-custom {
        border-radius: 18px;
        border: none;
        box-shadow: 0px 8px 20px rgba(0,0,0,0.08);
    }

    /* Table styling */
    table thead {
        background: #f8f9fa;
        font-weight: 600;
    }

    table tbody tr:hover {
        background: #f1f5ff;
        transition: 0.2s;
    }

    .btn-primary {
        border-radius: 12px;
        padding: 8px 20px;
    }

</style>
@endsection

@section('content')
<div class="mt-4 fade-in">

    <!-- PAGE TITLE -->
    <h2 class="fw-bold mb-4">📦 Order Management</h2>

    <!-- FILTER CARD -->
    <div class="card card-custom p-4 mb-4">
        <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label class="form-label fw-semibold">Start Date</label>
                <input type="date" id="start_date" class="form-control shadow-sm">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold">End Date</label>
                <input type="date" id="end_date" class="form-control shadow-sm">
            </div>

            <div class="col-md-4">
                <button id="filter" class="btn btn-primary w-100 shadow-sm">
                    🔍 Filter Orders
                </button>
            </div>

        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="card card-custom p-4">
        <table class="table table-hover table-borderless align-middle" id="order_table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Order Date</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="table_body"></tbody>
        </table>
    </div>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

    var dataTable = $('#order_table').DataTable({
        stateSave: true,
        processing: true,
        serverSide: true,
        pageLength: 10,
        ajax: {
            url: '{{ route('admin.usersAllOrder') }}',
            data: function(d) {
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
            }
        },
        columns: [
            { data: "user_name" },
            { data: "product_name" },
            { data: "quantity" },
            { data: "total_price" },
            { data: "order_date" },
            {
                data: 'action',
                orderable: false,
                searchable: false,
                className: "text-center"
            }
        ]
    });

    $('#filter').click(function() {
        dataTable.draw();
    });

    $(document).on('click', '.delete-order', function() {
        const orderId = $(this).data('id');
        $.ajax({
            url: `{{ route('admin.deleteUserOrder', '') }}/${orderId}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function() {
                Swal.fire({
                    toast: true,
                    position: "top-end",
                    icon: "success",
                    title: "Order deleted",
                    showConfirmButton: false,
                    timer: 2500
                });
                dataTable.draw();
            },
            error: function(xhr, status, error) {
                console.error("Failed to delete order:", status, error);
            }
        });
    });

});
</script>
@endsection
