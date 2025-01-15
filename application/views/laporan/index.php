<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
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
            padding: 8px;
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

        .card-custom {
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

        footer {
            text-align: center;
            margin-top: 50px;
            padding: 10px 0;
            background-color: #052B51;
            color: #fff;
            font-size: inherit;
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
        <h4 class="fw-bold">Laporan Transaksi</h4>

        <div class="card card-custom mb-4">
            <div class="card-header bg-warning text-white">Filter Tanggal & Status</div>
            <div class="card-body">
                <form method="GET">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" class="form-control" name="start_date"
                                value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" class="form-control" name="end_date"
                                value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                        </div>
                        <div class="col-md-3">
                            <label for="status">Status Pembayaran:</label>
                            <select name="status" class="form-control">
                                <option value="">Semua</option>
                                <option value="lunas" <?= isset($_GET['status']) && $_GET['status'] == 'lunas' ? 'selected' : ''; ?>>Lunas</option>
                                <option value="belum lunas" <?= isset($_GET['status']) && $_GET['status'] == 'belum lunas' ? 'selected' : ''; ?>>Belum Lunas</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-custom mb-4">
            <div class="card-header bg-warning text-white">Ringkasan Poin Pelanggan</div>
            <div class="card-body">
                <p>Poin Tertinggi:
                    <?= isset($poin_summary->poin_tertinggi) ? $poin_summary->poin_tertinggi : 'Tidak Ada'; ?>
                </p>
                <p>Poin Terendah:
                    <?= isset($poin_summary->poin_terendah) ? $poin_summary->poin_terendah : 'Tidak Ada'; ?>
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-warning text-white">Data Laporan Transaksi</div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID Transaksi</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Nama Karyawan</th>
                            <th>Nama Customer</th>
                            <th>Poin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($transaksi)): ?>
                            <?php foreach ($transaksi as $row): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row->id_trans ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= isset($row->trans_masuk) ? date('d-m-Y', strtotime($row->trans_masuk)) : 'Tidak Ada'; ?>
                                    </td>
                                    <td><?= isset($row->total_harga) ? number_format($row->total_harga, 2) : '0.00'; ?></td>
                                    <td><?= htmlspecialchars($row->status_pembayaran ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($row->nama_karyawan ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($row->nama ?? '', ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= htmlspecialchars($row->point_cust ?? '0', ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Tidak ada data.</td>
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