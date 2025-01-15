<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
        <a href="customer" class="active">👥 Customer</a>
        <a href="menu">📋 Menu</a>
        <a href="karyawan">👨‍💼 Karyawan</a>
        <a href="laporan">📋 Laporan Transaksi</a>
        <form action="login" method="POST" class="logout-button">
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </div>

    <div class="content" id="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Customer</h4>
        </div>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card card-custom">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="icon-circle">👥</div>
                            <h6>Banyak Customer</h6>
                        </div>
                        <h4 class="mb-0" style="font-size: 22px;">
                            <?php
                            $no = isset($customers) && is_array($customers) ? count($customers) : 0;
                            echo $no;
                            ?>
                        </h4>
                        <button class="btn btn-primary mt-3"
                            onclick="window.location.href='<?= site_url('customer/tambah'); ?>'">Tambah
                            Customer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-warning text-white">Data Customer</div>
            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No HP Customer</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Point Customer</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (!empty($customers)): ?>
                            <?php foreach ($customers as $customer): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?= htmlspecialchars($customer['no_hp_cus'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($customer['nama'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= ($customer['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td>
                                    <td><?= htmlspecialchars($customer['point_cust'] ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="actions">
                                        <a href="<?= site_url('customer/edit/' . $customer['no_hp_cus']); ?>"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <a href="<?= site_url('customer/delete/' . $customer['no_hp_cus']); ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data pelanggan.</td>
                            </tr>
                        <?php endif; ?>
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