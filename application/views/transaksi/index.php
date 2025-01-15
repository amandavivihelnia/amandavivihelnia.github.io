<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
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
            transition: transform 0.3s ease;
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
        }

        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
            transition: margin-left 0.3s ease;
        }

        .content.shifted {
            margin-left: 0;
        }

        .icon-circle {
            width: 60px;
            height: 60px;
            background-color: #ECA408;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 27px;
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

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
        }

        .table thead {
            background-color: #ECA408;
            color: white;
        }

        .btn-primary {
            background-color: #052B51;
            border-color: #052B51;
        }

        .btn-primary:hover {
            background-color: rgb(235, 133, 37);
            border-color: rgb(235, 133, 37);
        }

        .logout-button {
            margin-top: auto;
        }

        .logout-button button {
            background-color: rgb(235, 133, 37);
            border-color: rgb(235, 133, 37);
        }

        .logout-button button:hover {
            background-color: rgb(223, 25, 11);
            border-color: rgb(223, 25, 11);
        }

        footer {
            background-color: #052B51;
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 16px;
            width: 100%;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }
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
        <a href="detail_transaksi" class="active">🛒 Detail Transaksi</a>
        <a href="customer">👥 Customer</a>
        <a href="menu">📋 Menu</a>
        <a href="karyawan">👨‍💼 Karyawan</a>
        <a href="laporan">📋 Laporan Transaksi</a>
        <form action="login" method="POST" class="logout-button">
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <div class="content" id="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Transaksi</h4>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-circle">🛒</div>
                            <h6>Banyak Transaksi</h6>
                        </div>
                        <h4 class="mb-0"><?= $total_transaksi; ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-warning text-white">Data Transaksi</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="bg-warning text-white">
                        <tr>
                            <th>No</th>
                            <th>ID Transaksi</th>
                            <th>No HP Customer</th>
                            <th>ID Karyawan</th>
                            <th>Transaksi Masuk</th>
                            <th>Transaksi Ambil</th>
                            <th>Pembayaran</th>
                            <th>Status Pembayaran</th>
                            <th>Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($transaksi as $trans): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $trans['id_trans']; ?></td>
                                <td><?= $trans['no_hp_cus']; ?></td>
                                <td><?= $trans['id_karyawan']; ?></td>
                                <td><?= $trans['trans_masuk']; ?></td>
                                <td><?= $trans['trans_ambil']; ?></td>
                                <td><?= $trans['pembayaran']; ?></td>
                                <td><?= $trans['status_pembayaran']; ?></td>
                                <td><?= $trans['total_harga']; ?></td>
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
    </script>
</body>

</html>