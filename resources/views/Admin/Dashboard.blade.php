{{-- this is admin layout some design  --}}
{{-- https://preview.themeforest.net/item/ebazar-ecommerce-laravel-8-admin-template/full_screen_preview/37607630 --}}

@extends('layouts.admin_layout')
@section('title')
    Dashboard
@endsection

@section('styles')
    <!-- Date filter -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .all_content {
            height: 100%;
            margin: 0px 20px 20px 20px;
        }

        .row>.col-sm-4 {
            padding: 10px;
        }

        .quantity {
            font-size: 20px;
            font-weight: bold;
        }
        .nav-link-dashboard-first{
            text-decoration: none;
        }
        
        /* filter by date and today,week,month,year  */
        .nav-tabs-dashboard {
            border-radius: 5px;
            border: 1px solid #6f42c1;
        }
        
        .nav-tabs-dashboard .nav-link-dashboard {
            border-radius: 5px;
            color: #6c757d;
        }
        
        .nav-tabs-dashboard .nav-link-dashboard.active {
            color: #fff;
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        #send-filter-btn {
            display: flex;
            align-items: center;
        }

        #send-filter-btn .bi {
            margin-right: 5px;
        }


        /* top selling products table   */
        .table tbody {
            background-color: #f5f5f5;
        }

        .productNameColumn,
        .productImageColumn {
            cursor: pointer;
        }

        .productImage {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    {{-- cards for total  orders,products,revenue,customers   --}}
    <section class="main mt-4">
        <h2>Dashboard</h2>
        <div class="container">
            <div class="all_content pt-4 pb-2">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="card m-0" style="background: rgb(13, 140, 203);">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity text-light m-0">{{ $UserCount }}</label>
                                    <h5 class="card-text text-light">Customers</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-user"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a href="{{ route('admin.manageCustomer.index') }}" class="nav-link-dashboard-first">
                                <div class="footer rounded-bottom" style="background: rgb(6, 115, 170);">
                                    <div class="text-light p-1 more-info-dashboard " style="text-align: center;"> More info <i
                                            class="fa fa-arrow-circle-o-right"></i> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0" style="background: rgb(16, 167, 16);">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity text-light  m-0">{{ $ProductCount }}</label>
                                    <h5 class="card-text text-light ">Products</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-product-hunt"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a href="{{ route('product.index') }}" class="nav-link-dashboard-first">
                                <div class="footer rounded-bottom" style="background: rgb(7, 138, 7)">
                                    <div class="text-light p-1 more-info-dashboard " style="text-align: center;"> More info <i
                                            class="fa fa-arrow-circle-o-right"></i> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0" style="background: rgb(241, 184, 15);">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity text-light m-0">{{ $TotalRevenue }}</label>
                                    <h5 class="card-text text-light ">Revenue</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-list-alt"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a href="{{ route('category.index') }}" class="nav-link-dashboard-first">
                                <div class="footer rounded-bottom" style="background:  rgb(152, 117, 12);">
                                    <div class="text-light p-1 more-info-dashboard " style="text-align: center;"> More info <i
                                            class="fa fa-arrow-circle-o-right"></i> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0" style="background:  rgb(212, 47, 14);">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity text-light  m-0">{{ $OrderCount }}</label>
                                    <h5 class="card-text text-light ">Orders</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-shopping-cart"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                            <hr class="m-0">
                            <a href="{{ route('admin.usersAllOrder') }}" class="nav-link-dashboard-first">
                                <div class="footer rounded-bottom" style="background: rgb(146, 37, 15);">
                                    <div class="text-light p-1 more-info-dashboard " style="text-align: center;"> More info <i
                                            class="fa fa-arrow-circle-o-right"></i> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- filter by date and many more  --}}
    {{-- <div class="container mt-4 d-flex justify-content-between align-items-center">
        <ul class="nav nav-tabs-dashboard nav-tabs">
            <li class="nav-item">
                <a class="nav-link-dashboard nav-link active" id="today-tab" href="#">Today</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-dashboard nav-link" id="week-tab" href="#">Week</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-dashboard nav-link" id="month-tab" href="#">Month</a>
            </li>
            <li class="nav-item">
                <a class="nav-link-dashboard nav-link" id="year-tab" href="#">Year</a>
            </li>
        </ul>
        <div class="d-flex align-items-center">
            <div class="input-group date">
                <input type="text" class="form-control me-2" id="date_range" name="date_range"
                    placeholder="Select Date Range">
                <div class="input-group-addon">
                    <span class="glyphicon glyphicon-th"></span>
                </div>
            </div>
            <button class="btn btn-primary" id="send-filter-btn">
                <i class="fa fa-filter"></i>
            </button>
        </div>
    </div>

    <section class="main">
        <div class="container">
            <div class="all_content pt-4 pb-2">
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="card m-0 bg-white">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity  m-0" id="todayOrdersCount">0</label>
                                    <h5 class="card-text ">Orders</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-shopping-cart"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0 bg-white">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity m-0" id="todaySales">0.00</label>
                                    <h5 class="card-text">Total Sales</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-dollar-sign"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0 bg-white">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity m-0" id="averageSales">0.00</label>
                                    <h5 class="card-text">Avg. Sales</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-chart-line"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card m-0 bg-white">
                            <div class="d-flex">
                                <div class="flex-grow-1 p-2">
                                    <label class="quantity m-0" id="todayCustomers">0</label>
                                    <h5 class="card-text">Customers</h5>
                                </div>
                                <div class="align-content-center">
                                    <p class="m-0 pe-3"><i class="fa fa-user"
                                            style="font-size:60px; color:rgba(35, 34, 34, 0.174);"></i></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}





    {{-- top selling products --}}
    {{-- <section class="main mt-4">
        <h2>Top Selling Products</h2>
        <div class="container">
            <div class="all_content pt-4 pb-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Index</th>
                            <th scope="col">Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity Sold</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($topSellingProducts as $key => $product)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td class="productImageColumn"
                                    onclick="window.location='{{ route('product.show', $product->product_id) }}'">
                                    <img src="{{ asset('storage/images/product/' . $product->product->image) }}"
                                        class="productImage" alt="Product Image">
                                </td>
                                <td class="productNameColumn"
                                    onclick="window.location='{{ route('product.show', $product->product_id) }}'">
                                    {{ $product->product->title }}</td>
                                <td>{{ $product->total_quantity }}</td>
                                <td>{{ $product->product->price }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> --}}
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    {{-- <script>
        $(document).ready(function() {

            function fetchStats(rangeType = null, startDate = null, endDate = null) {
                $.ajax({
                    url: '{{ route('admin.dashboard.stats') }}',
                    method: 'GET',
                    data: {
                        range: rangeType,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        $('#todayOrdersCount').text(response.orders);
                        $('#todaySales').text(response.sales.toFixed(2));
                        $('#averageSales').text(response.averageSales.toFixed(2));
                        $('#todayCustomers').text(response.customers);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching stats:', error);
                    }
                });
            }

            // Default fetch stats for "Today"
            fetchStats('today');

            $('.nav-link').click(function(event) {
                event.preventDefault();
                $('.nav-link').removeClass('active');
                $(this).addClass('active');

                let rangeType;
                switch ($(this).attr('id')) {
                    case 'today-tab':
                        rangeType = 'today';
                        break;
                    case 'week-tab':
                        rangeType = 'week';
                        break;
                    case 'month-tab':
                        rangeType = 'month';
                        break;
                    case 'year-tab':
                        rangeType = 'year';
                        break;
                    default:
                        return;
                }

                fetchStats(rangeType);
            });

            flatpickr("#date_range", {
                mode: "range",
                dateFormat: "Y-m-d",
                onClose: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const [startDate, endDate] = selectedDates.map(date => date.toISOString().split(
                            'T')[0]);
                        fetchStats(null, startDate, endDate);
                    }
                }
            });

            $('#send-filter-btn').click(function() {
                const dateRange = $('#date_range').val().split(' to ');
                if (dateRange.length === 2) {
                    const [startDate, endDate] = dateRange;
                    fetchStats(null, startDate, endDate);
                }
            });


        });
    </script> --}}
@endsection
