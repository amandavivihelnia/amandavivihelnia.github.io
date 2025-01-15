<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #052B51;
            color: white;
            padding: 30px 20px;
            box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar.closed {
            transform: translateX(-250px);
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 10px 0;
            display: block;
            margin: 8px 0;
            transition: all 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #ECA408;
            border-radius: 5px;
            padding-left: 20px;
        }

        .sidebar h4 {
            font-size: 24px;
            margin-bottom: 30px;
            font-weight: bold;
            position: relative;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 0;
        }

        .toggle-btn {
            position: fixed;
            top: 15px;
            right: 15px;
            background-color: #f8f9fa;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            z-index: 1000;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .toggle-btn i {
            font-size: 24px;
            color: #052B51;
        }

        .toggle-btn:hover {
            transform: scale(1.1);
        }

        .stat-card {
            border-radius: 12px;
            color: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .bg-primary {
            background: linear-gradient(135deg, #00c6ff, rgb(0, 78, 204));
        }

        .bg-success {
            background: linear-gradient(135deg, #00e676, rgb(0, 123, 52));
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffea00, rgb(255, 174, 0));
        }

        .bg-danger {
            background: linear-gradient(135deg, #ff1744, rgb(203, 0, 0));
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.4);
        }

        .table {
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 10px 0;
            background-color: #052B51;
            color: #fff;
            font-size: inherit;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-250px);
            }

            .sidebar.closed {
                transform: translateX(0);
            }

            .content {
                margin-left: 0;
            }

            .toggle-btn {
                display: block;
            }
        }

        .header-title {
            text-align: center;
            font-size: 36px;
            color: #052B51;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .button {
            background-color: rgb(235, 133, 37);
            border-color: rgb(235, 133, 37);
            color: #ffff;
        }

        .button:hover {
            background-color: rgb(223, 25, 11);
            border-color: rgb(223, 25, 11);
        }

        .logout-button {
            margin-top: auto;
        }
    </style>
</head>

<body>
    <button class="toggle-btn" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>
    <div class="sidebar" id="sidebar">
        <h4>
            <a href="dashboard" style="color: white; text-decoration: none; font-size: inherit;">Laundry Latte</a>
        </h4>
        <a href="transaksi">🛒 Transaksi</a>
        <a href="detail_transaksi">🛒 Detail Transaksi</a>
        <a href="customer">👥 Customer</a>
        <a href="menu">📋 Menu</a>
        <a href="karyawan">👨‍💼 Karyawan</a>
        <a href="laporan">📋 Laporan Transaksi</a>
        <form action="login" method="POST" class="logout-button">
            <button type="submit" class="btn button w-100">Logout</button>
        </form>
    </div>

    <div class="content" id="content">
        <h1 class="header-title">Welcome to Laundry Latte Dashboard</h1>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="stat-card bg-primary">
                    <h5>Total Customers</h5>
                    <h3><?= $total_customers ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-success">
                    <h5>Total Transactions</h5>
                    <h3><?= $total_transactions ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-warning">
                    <h5>Total Income</h5>
                    <h3>Rp <?= number_format($total_income, 0, ',', '.') ?></h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stat-card bg-danger">
                    <h5>Total Menus</h5>
                    <h3><?= $total_menus ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Monthly Income</h5>
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Menu Statistics</h5>
                        <canvas id="menuChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5>Detailed Menu Statistics</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Menu</th>
                            <th>Jumlah Dipesan</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menu_statistics as $menu): ?>
                            <tr>
                                <td><?= $menu['nama_menu'] ?></td>
                                <td><?= $menu['jumlah'] ?></td>
                                <td><?= number_format($menu['persentase'], 2) ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Laundry Latte.</p>
    </footer>

    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        function toggleSidebar() {
            sidebar.classList.toggle('closed');
            content.classList.toggle('shifted');
        }

        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyLabels = <?= json_encode($monthly_labels) ?>;
        const monthlyEarnings = <?= json_encode($monthly_earnings) ?>;

        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Earnings',
                    data: monthlyEarnings,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const menuCtx = document.getElementById('menuChart').getContext('2d');
        const menuData = <?= json_encode(array_column($menu_statistics, 'jumlah')) ?>;
        const menuLabels = <?= json_encode(array_column($menu_statistics, 'nama_menu')) ?>;

        new Chart(menuCtx, {
            type: 'pie',
            data: {
                labels: menuLabels,
                datasets: [{
                    label: 'Menu Statistics',
                    data: menuData,
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(99, 255, 132, 0.2)',
                        'rgba(86, 255, 205, 0.2)',
                        'rgba(235, 54, 162, 0.2)',
                        'rgba(192, 75, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(99, 255, 132, 1)',
                        'rgba(86, 255, 205, 1)',
                        'rgba(235, 54, 162, 1)',
                        'rgba(192, 75, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                layout: {
                    padding: {
                        top: 20,
                        right: 20,
                        bottom: 20,
                        left: 20
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>

</html>