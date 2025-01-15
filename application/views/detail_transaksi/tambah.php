<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #052B51;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 40%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        h2 {
            font-size: 1.5rem;
            color: #333333;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .form-label {
            font-weight: 600;
            color: #555555;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #cccccc;
            padding: 10px;
            height: 45px;
        }

        .form-select {
            border-radius: 5px;
            border: 1px solid #cccccc;
            height: 45px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            height: 45px;
            font-weight: bold;
            width: 50%;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #e0e0e0;
            color: #333333;
            border: none;
            border-radius: 5px;
            height: 45px;
            font-weight: bold;
            width: 50%;
        }

        .btn-secondary:hover {
            background-color: #d6d6d6;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Tambah Detail Transaksi</h2>

        <?php if (validation_errors()): ?>
            <div class="alert alert-danger"><?= validation_errors(); ?></div>
        <?php endif; ?>

        <?php echo form_open('detail_transaksi/aksi_tambah'); ?>

        <div class="mb-3">
            <label for="id_trans" class="form-label">ID Transaksi:</label>
            <input type="text" class="form-control" name="id_trans" id="id_trans" 
                   value="<?= set_value('id_trans'); ?>" required autocomplete="off" />
        </div>

        <div class="mb-3">
            <label for="id_detail" class="form-label">ID Detail Transaksi:</label>
            <input type="text" class="form-control" name="id_detail" id="id_detail" 
                   value="<?= set_value('id_detail'); ?>" required autocomplete="off" />
        </div>

        <div class="mb-3">
            <label for="id_menu" class="form-label">Menu:</label>
            <select class="form-select" name="id_menu" id="id_menu" required>
                <option value="" disabled selected>--Pilih Menu--</option>
                <?php foreach ($menu as $item): ?>
                    <option value="<?= $item['id_menu']; ?>" <?= set_select('id_menu', $item['id_menu']); ?>>
                        <?= $item['nama_menu']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="kuantitas" class="form-label">Kuantitas:</label>
            <input type="number" class="form-control" name="kuantitas" id="kuantitas" 
                   value="<?= set_value('kuantitas'); ?>" required oninput="calculateSubtotal()" min="1" />
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga:</label>
            <input type="number" class="form-control" name="harga" id="harga" 
                   value="<?= set_value('harga'); ?>" required oninput="calculateSubtotal()" min="1" />
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal:</label>
            <input type="number" class="form-control" name="subtotal" id="subtotal" 
                   value="<?= set_value('subtotal'); ?>" readonly />
        </div>

        <div class="mb-3">
            <label for="trans_masuk" class="form-label">Tanggal Masuk:</label>
            <input type="date" class="form-control" name="trans_masuk" id="trans_masuk" 
                   value="<?= set_value('trans_masuk'); ?>" required />
        </div>

        <div class="mb-3">
            <label for="trans_ambil" class="form-label">Tanggal Ambil:</label>
            <input type="date" class="form-control" name="trans_ambil" id="trans_ambil" 
                   value="<?= set_value('trans_ambil'); ?>" required />
        </div>

        <div class="mb-3">
            <label for="id_karyawan" class="form-label">Nama Karyawan:</label>
            <select class="form-select" name="id_karyawan" id="id_karyawan" required>
                <option value="" disabled selected>--Pilih Karyawan--</option>
                <?php foreach ($karyawan as $item): ?>
                    <option value="<?= $item['id_karyawan']; ?>" <?= set_select('id_karyawan', $item['id_karyawan']); ?>>
                        <?= $item['nama_karyawan']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="no_hp_cus" class="form-label">No HP Customer:</label>
            <input type="text" class="form-control" name="no_hp_cus" id="no_hp_cus" 
                   value="<?= set_value('no_hp_cus'); ?>" required pattern="\d{10,12}" 
                   title="Nomor HP harus berupa angka (10-12 digit)" />
        </div>

        <div class="mb-3">
            <label for="pembayaran" class="form-label">Pembayaran:</label>
            <input type="number" class="form-control" name="pembayaran" id="pembayaran" 
                   value="<?= set_value('pembayaran'); ?>" required min="1" />
        </div>

        <div class="mb-3">
            <label for="status_pembayaran" class="form-label">Status Pembayaran:</label>
            <select class="form-select" name="status_pembayaran" id="status_pembayaran" required>
                <option value="" disabled selected>--Pilih Status Pembayaran--</option>
                <option value="Lunas" <?= set_select('status_pembayaran', 'Lunas'); ?>>Lunas</option>
                <option value="Belum Lunas" <?= set_select('status_pembayaran', 'Belum Lunas'); ?>>Belum Lunas</option>
            </select>
        </div>

        <div class="btn-container d-flex justify-content-between">
            <a href="<?= site_url('detail_transaksi'); ?>" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>

        <?php echo form_close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function calculateSubtotal() {
            const kuantitas = parseFloat(document.getElementById('kuantitas').value) || 0;
            const harga = parseFloat(document.getElementById('harga').value) || 0;
            const subtotalField = document.getElementById('subtotal');

            if (kuantitas && harga) {
                subtotalField.value = (kuantitas * harga).toFixed(2);
            } else {
                subtotalField.value = '';
            }
        }
    </script>
</body>
</html>