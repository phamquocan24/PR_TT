@extends('admin::layout')

@section('title', 'Dashboard')

@section('content_header')
    <h3 class="pull-left">Dashboard</h3>
@endsection

@section('content')
    <div class="grid">
        <!-- Stats Cards Row -->
        <div class="row stats-cards">
            <div class="col-md-3">
                <div class="info-box bg-primary">
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL SALES</span>
                        <span class="info-box-number">71.09K</span>
                    </div>
                    <div class="info-box-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M3,22V8H7V22H3M10,22V2H14V22H10M17,22V14H21V22H17Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-danger">
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL ORDERS</span>
                        <span class="info-box-number">46</span>
                    </div>
                    <div class="info-box-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M19 20H5V19H19V20M16 9H15V4H16V9M19 3H5C3.9 3 3 3.9 3 5V15C3 16.1 3.9 17 5 17H19C20.1 17 21 16.1 21 15V5C21 3.9 20.1 3 19 3M10 8L6 8V5H10V8Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-warning">
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL PRODUCTS</span>
                        <span class="info-box-number">140</span>
                    </div>
                    <div class="info-box-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L5,8.09V15.91L12,19.85L19,15.91V8.09L12,4.15Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="info-box bg-success">
                    <div class="info-box-content">
                        <span class="info-box-text">TOTAL CUSTOMERS</span>
                        <span class="info-box-number">1</span>
                    </div>
                    <div class="info-box-icon">
                        <svg viewBox="0 0 24 24" width="24" height="24">
                            <path fill="currentColor" d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,6A2,2 0 0,0 10,8A2,2 0 0,0 12,10A2,2 0 0,0 14,8A2,2 0 0,0 12,6M12,13C14.67,13 20,14.33 20,17V20H4V17C4,14.33 9.33,13 12,13M12,14.9C9.03,14.9 5.9,16.36 5.9,17V18.1H18.1V17C18.1,16.36 14.97,14.9 12,14.9Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics and Search Section -->
        <div class="row mt-4">
            <!-- Sales Analytics -->
            <div class="col-md-8">
                <div class="box sales-analytics">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sales Analytics</h3>
                    </div>
                    <div class="box-body">
                        <canvas class="chart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>

            <!-- Latest Searches -->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Searches</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="search-header">
                                        <th>Keyword</th>
                                        <th>Results</th>
                                        <th>Hits</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>123</td>
                                        <td>0</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>G</td>
                                        <td>20</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>laptop</td>
                                        <td>13</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>watch</td>
                                        <td>5</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>2593648H</td>
                                        <td>0</td>
                                        <td>2</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Orders Section -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Orders</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="orders-header">
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1413</td>
                                        <td>Demo Admin</td>
                                        <td><span class="status-badge pending-payment">Pending Payment</span></td>
                                        <td>$450.00</td>
                                    </tr>
                                    <tr>
                                        <td>1412</td>
                                        <td>prueba prueba</td>
                                        <td><span class="status-badge pending">Pending</span></td>
                                        <td>$349.00</td>
                                    </tr>
                                    <tr>
                                        <td>1411</td>
                                        <td>fnbhjfvbdvh hdbgcb</td>
                                        <td><span class="status-badge pending-payment">Pending Payment</span></td>
                                        <td>$349.00</td>
                                    </tr>
                                    <tr>
                                        <td>1408</td>
                                        <td>anderson souza</td>
                                        <td><span class="status-badge pending-payment">Pending Payment</span></td>
                                        <td>$1,199.66</td>
                                    </tr>
                                    <tr>
                                        <td>1406</td>
                                        <td>Demo Admin</td>
                                        <td><span class="status-badge pending">Pending</span></td>
                                        <td>$699.99</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Reviews -->
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Latest Reviews</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr class="reviews-header">
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center no-data">No data available!</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    .stats-cards {
        margin-bottom: 20px;
    }
    .info-box {
        display: flex;
        justify-content: space-between;
        min-height: 100px;
        margin-bottom: 20px;
        padding: 15px;
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .bg-primary {
        background-color: #4e73df;
    }
    .bg-danger {
        background-color: #ff5a8d;
    }
    .bg-warning {
        background-color: #ff7d4a;
    }
    .bg-success {
        background-color: #1cc88a;
    }
    .info-box-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .info-box-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        width: 60px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.9);
        height: 60px;
        color: #333;
    }
    .info-box-number {
        font-size: 2rem;
        font-weight: bold;
    }
    .info-box-text {
        font-size: 0.9rem;
        text-transform: uppercase;
        font-weight: 500;
    }
    .mt-4 {
        margin-top: 1.5rem;
    }

    /* Box styling */
    .box {
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        background-color: #fff;
        margin-bottom: 20px;
    }
    .box-header {
        padding: 15px;
        border-bottom: 1px solid #f1f1f1;
    }
    .box-title {
        margin: 0;
        font-size: 18px;
        font-weight: 600;
    }
    .box-body {
        padding: 15px;
    }

    /* Table styling */
    .table-borderless {
        margin-bottom: 0;
    }
    .table-borderless td, .table-borderless th {
        border: none;
        padding: 12px 15px;
    }
    .search-header th, .orders-header th, .reviews-header th {
        color: #666;
        font-weight: 600;
        border-bottom: 1px solid #f1f1f1;
    }

    /* Status badges */
    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        display: inline-block;
    }
    .pending-payment {
        background-color: #fff8e6;
        color: #fab005;
    }
    .pending {
        background-color: #e6f4ff;
        color: #1a73e8;
    }

    /* No data message */
    .no-data {
        color: #999;
        font-style: italic;
    }

    /* Chart container */
    .sales-analytics .chart {
        width: 100%;
        height: 300px !important;
    }
</style>
@endpush

@push('globals')
    @vite([
        "modules/Admin/Resources/assets/sass/dashboard.scss",
        "modules/Admin/Resources/assets/js/dashboard.js",
    ])
@endpush
