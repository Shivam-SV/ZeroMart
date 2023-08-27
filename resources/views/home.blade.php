@extends('layout.app')

@section('title', 'Home')

@php
    $orders = [
        [
            'id' => 1,
            'customer' => 'John Doe',
            'date' => '2023-01-15',
            'amount' => 150.0,
        ],
        [
            'id' => 2,
            'customer' => 'Jane Smith',
            'date' => '2023-02-05',
            'amount' => 200.0,
        ],
        [
            'id' => 3,
            'customer' => 'Alice Johnson',
            'date' => '2023-03-20',
            'amount' => 120.0,
        ],
    ];
@endphp

@section('content')
    <div class="container bg-white py-4 px-36">

        <div style="width: 50%; margin: auto;">
            <canvas id="ordersChart"></canvas>
        </div>

        <div class="flex justify-center">
            <div class="stats shadow ">
                <div class="stat place-items-center">
                    <div class="stat-title">Total Orders</div>
                    <div class="stat-value">31K</div>
                    <div class="stat-desc">From January 1st to February 1st</div>
                </div>

                <div class="stat place-items-center">
                    <div class="stat-title">This Month Orders</div>
                    <div class="stat-value text-primary">295</div>
                    <div class="stat-desc">From January 1st to February 1st</div>
                </div>

                <div class="stat place-items-center">
                    <div class="stat-title">Cancelled Orders</div>
                    <div class="stat-value">56</div>
                    <div class="stat-desc">This month</div>
                </div>

            </div>
        </div>

        <div id="recent-orders">
            <h3 class="text-primary">Some Recent Orders</h3>
            <div class="overflow-x-auto">
                <table class="table">
                    <thead>
                        <tr>
                            @foreach (array_keys($orders[0]) as $heading)
                                <th>{{ $heading }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                @foreach ($order as $field)
                                    <td>{{ $field }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const orderData = {
            labels: ['January', 'February', 'March', 'April', 'May'],
            datasets: [{
                label: 'Number of Orders',
                data: [10, 15, 25, 12, 20],
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        };
        const ctx = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctx, {
            type: 'bar',
            data: orderData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
