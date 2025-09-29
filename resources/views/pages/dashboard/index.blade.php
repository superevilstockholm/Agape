@extends('layouts.dashboard')
@section('title', 'Dashboard - Index')
@section('content')
    <script>
        showLoading();
    </script>
    <div class="row">
        <h3>Welcome admin {{ auth()->user()->name }} to the Dashboard 🎉</h3>
        <p>This is your admin panel.</p>
    </div>
    <div class="row mt-4">
        <div class="col-12" style="height: 250px;">
            <canvas id="dashboardChart" class="w-100 h-100"></canvas>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", async function() {
            try {
                const response = await axios.get("/api/dashboard-data", {
                    headers: {
                        "Accept": "application/json",
                        "Authorization": `Bearer ${getCookie("auth_token")}`
                    }
                });
                if (response.data.status) {
                    const stats = response.data.data.table_statistic;
                    const labels = stats.map(item => item.table);
                    const values = stats.map(item => item.count);
                    const ctx = document.getElementById("dashboardChart").getContext("2d");
                    new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Jumlah Rows",
                                data: values,
                                borderColor: "rgba(54, 162, 235, 1)",
                                backgroundColor: "rgba(54, 162, 235, 0.6)",
                                fill: true,
                                tension: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    precision: 0
                                }
                            }
                        }
                    });
                }
            } catch (error) {
                console.error(error);
            } finally {
                hideLoading();
            }
        });
    </script>
@endsection
