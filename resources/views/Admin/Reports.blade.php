@extends('layouts.admin_layout')
@section('title')
    Reports & Analytics
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.js.min.css">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    body {
        background: #f3f4f7;
    }

    .report-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        padding: 25px;
        color: white;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .report-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: scale(0);
        transition: transform 0.6s;
    }

    .report-card:hover::before {
        transform: scale(1);
    }

    .report-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
    }

    .report-card h3 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .report-card p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }

    .report-card .icon {
        position: absolute;
        right: 20px;
        top: 20px;
        font-size: 50px;
        opacity: 0.2;
    }

    .report-card.bg-primary-gradient {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .report-card.bg-success-gradient {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .report-card.bg-warning-gradient {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    .report-card.bg-info-gradient {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    }

    .report-card.bg-danger-gradient {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    }

    .report-card.bg-purple-gradient {
        background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%);
        color: #333;
    }

    .chart-container {
        background: white;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .chart-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
    }

    .table-modern {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }

    .table-modern thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .table-modern tbody tr {
        transition: all 0.3s;
    }

    .table-modern tbody tr:hover {
        background: #f8f9fa;
        transform: scale(1.01);
    }

    .date-filter-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        margin: 5px;
        transition: all 0.3s;
    }

    .date-filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .date-filter-btn.active {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    }

    .badge-custom {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 12px;
    }

    .stats-icon {
        font-size: 40px;
        opacity: 0.3;
        position: absolute;
        bottom: 10px;
        right: 15px;
    }

    .top-product-img {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #e0e0e0;
    }
</style>
@endsection

@section('content')

<div class="main-wrapper">
    <h2 class="mb-4" data-aos="fade-up">
        <i class="fa fa-chart-line text-primary"></i> Reports & Analytics
    </h2>

    <!-- Date Range Filter -->
    <div class="mb-4" data-aos="fade-up">
        <form method="GET" action="{{ route('admin.reports') }}" class="d-flex align-items-center flex-wrap gap-2">
            <label class="me-3 mb-2 fw-bold">Date Range:</label>
            <button type="submit" name="date_range" value="7" class="btn date-filter-btn {{ $dateRange == '7' ? 'active' : '' }}">
                Last 7 Days
            </button>
            <button type="submit" name="date_range" value="30" class="btn date-filter-btn {{ $dateRange == '30' ? 'active' : '' }}">
                Last 30 Days
            </button>
            <button type="submit" name="date_range" value="90" class="btn date-filter-btn {{ $dateRange == '90' ? 'active' : '' }}">
                Last 90 Days
            </button>
            <button type="submit" name="date_range" value="365" class="btn date-filter-btn {{ $dateRange == '365' ? 'active' : '' }}">
                Last Year
            </button>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="0">
            <div class="report-card bg-primary-gradient position-relative">
                <i class="fas fa-dollar-sign icon"></i>
                <h3>₹{{ number_format($totalSales, 2) }}</h3>
                <p>Total Sales</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="report-card bg-success-gradient position-relative">
                <i class="fas fa-shopping-cart icon"></i>
                <h3>{{ $totalOrders }}</h3>
                <p>Total Orders</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="report-card bg-warning-gradient position-relative">
                <i class="fas fa-box icon"></i>
                <h3>{{ $totalProductsSold }}</h3>
                <p>Products Sold</p>
            </div>
        </div>

        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="report-card bg-info-gradient position-relative">
                <i class="fas fa-users icon"></i>
                <h3>{{ $activeCustomers }}</h3>
                <p>Active Customers</p>
            </div>
        </div>
    </div>

    <!-- Additional Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-6" data-aos="fade-up">
            <div class="report-card bg-danger-gradient position-relative">
                <i class="fas fa-user-plus icon"></i>
                <h3>{{ $newCustomers }}</h3>
                <p>New Customers</p>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="report-card bg-purple-gradient position-relative">
                <i class="fas fa-receipt icon"></i>
                <h3>₹{{ number_format($averageOrderValue, 2) }}</h3>
                <p>Average Order Value</p>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <!-- Daily Sales Chart -->
        <div class="col-md-8" data-aos="fade-up">
            <div class="chart-container">
                <h4 class="chart-title">Daily Sales Trend</h4>
                <canvas id="dailySalesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
            <div class="chart-container">
                <h4 class="chart-title">Order Status Distribution</h4>
                <canvas id="orderStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Monthly Sales Chart -->
    <div class="row g-4 mb-4">
        <div class="col-md-12" data-aos="fade-up">
            <div class="chart-container">
                <h4 class="chart-title">Monthly Sales Trend (Last 6 Months)</h4>
                <canvas id="monthlySalesChart" height="60"></canvas>
            </div>
        </div>
    </div>

    <!-- Top Selling Products -->
    <div class="row g-4 mb-4">
        <div class="col-md-12" data-aos="fade-up">
            <div class="table-modern">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Units Sold</th>
                            <th>Total Revenue</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($topSellingProducts as $index => $item)
                        <tr>
                            <td>
                                <span class="badge bg-primary badge-custom">#{{ $index + 1 }}</span>
                            </td>
                            <td>
                                @if($item->product)
                                <img src="{{ asset('storage/images/product') }}/{{ $item->product->image }}" 
                                     alt="{{ $item->product->title }}" 
                                     class="top-product-img">
                                @else
                                <span class="text-muted">N/A</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $item->product ? $item->product->title : 'Product Deleted' }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-success badge-custom">{{ $item->total_quantity }}</span>
                            </td>
                            <td>
                                <strong class="text-primary">₹{{ number_format($item->total_revenue, 2) }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info badge-custom">Active</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">No sales data available</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Sales by Category Chart -->
    <div class="row g-4 mb-4">
        <div class="col-md-12" data-aos="fade-up">
            <div class="chart-container">
                <h4 class="chart-title">Sales by Category</h4>
                <canvas id="categorySalesChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true
    });

    // Daily Sales Chart
    const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
    const dailySalesData = @json($dailySales);
    
    new Chart(dailySalesCtx, {
        type: 'line',
        data: {
            labels: dailySalesData.map(item => item.date),
            datasets: [{
                label: 'Sales (₹)',
                data: dailySalesData.map(item => item.total),
                borderColor: 'rgb(102, 126, 234)',
                backgroundColor: 'rgba(102, 126, 234, 0.1)',
                tension: 0.4,
                fill: true,
                pointRadius: 5,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Order Status Chart
    const orderStatusCtx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusData = @json($orderStatus);
    
    new Chart(orderStatusCtx, {
        type: 'doughnut',
        data: {
            labels: orderStatusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(1)),
            datasets: [{
                data: orderStatusData.map(item => item.count),
                backgroundColor: [
                    'rgba(102, 126, 234, 0.8)',
                    'rgba(17, 153, 142, 0.8)',
                    'rgba(245, 87, 108, 0.8)',
                    'rgba(79, 172, 254, 0.8)',
                    'rgba(250, 112, 154, 0.8)'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Monthly Sales Chart
    const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
    const monthlySalesData = @json($monthlySales);
    
    new Chart(monthlySalesCtx, {
        type: 'bar',
        data: {
            labels: monthlySalesData.map(item => item.month),
            datasets: [{
                label: 'Monthly Sales (₹)',
                data: monthlySalesData.map(item => item.total),
                backgroundColor: 'rgba(102, 126, 234, 0.8)',
                borderColor: 'rgb(102, 126, 234)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Category Sales Chart
    const categorySalesCtx = document.getElementById('categorySalesChart').getContext('2d');
    const categorySalesData = @json($salesByCategory);
    
    new Chart(categorySalesCtx, {
        type: 'bar',
        data: {
            labels: categorySalesData.map(item => item.category_name),
            datasets: [{
                label: 'Revenue (₹)',
                data: categorySalesData.map(item => item.total_revenue),
                backgroundColor: 'rgba(17, 153, 142, 0.8)',
                borderColor: 'rgb(17, 153, 142)',
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

