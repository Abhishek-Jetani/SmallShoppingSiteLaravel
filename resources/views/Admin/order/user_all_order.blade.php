@extends('layouts.admin_layout')
@section('title')
    Orders
@endsection
@section('styles')
    <style>
        .table_body>td,
        tr {
            vertical-align: left !important;
            text-align: left !important;
            align-items: left !important;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">
        <h2>Orders</h2>

        <div class="d-flex p-2" style="background: white;">
            <div class="p-2 flex-fill">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date" class="form-control mt-2">
            </div>
            <div class="p-2 flex-fill">
                <label for="end_date">End Date:</label>
                <input type="date" id="end_date" name="end_date" class="form-control mt-2">
            </div>
            <div class="p-2 flex-fill align-content-end">
                <button id="filter" class="btn btn-primary">Filter</button>
            </div>
        </div>

        <div class="p-3 mt-3" style="background: white;">
            <table class="table table-bordered table-striped" id="order_table">
                <thead>
                    <tr class="table_tr">
                        <th>User Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table_body">
                </tbody>
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
                ajax: {
                    url: '{{ route('admin.usersAllOrder') }}',
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                         
                    }
                },
                columns: [{
                        data: "user_name",
                    },
                    {
                        data: 'product_name',
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'total_price'
                    },
                    {
                        data: 'order_date'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
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
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function() {
                        Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer;
                                toast.onmouseleave = Swal.resumeTimer;
                            }
                        }).fire({
                            icon: "success",
                            title: "Order deleted"
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
