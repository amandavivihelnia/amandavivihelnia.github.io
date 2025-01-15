<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Detail Transaksi</title>
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
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            height: 45px;
            font-weight: bold;
            width: 48%;
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
            width: 48%;
        }
        .btn-secondary:hover {
            background-color: #d6d6d6;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Detail Transaksi</h2>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php endif; ?>

        <?php echo form_open('detail_transaksi/aksi_edit'); ?>

            <input type="hidden" name="id_detail" value="<?= $detail['id_detail']; ?>" />

            <div class="mb-3">
                <label for="id_trans" class="form-label">ID Transaksi:</label>
                <input type="text" name="id_trans" value="<?= isset($detail['id_trans']) ? $detail['id_trans'] : '' ?>" required class="form-control" readonly />
            </div>

            <div class="mb-3">
                <label for="id_detail" class="form-label">ID Detail Transaksi:</label>
                <input type="text" name="id_detail" value="<?= isset($detail['id_detail']) ? $detail['id_detail'] : '' ?>" required class="form-control" readonly />
            </div>

            <div class="mb-3">
                <label for="id_menu" class="form-label">Menu:</label>
                <select class="form-select" name="id_menu" required>
                    <option value="">--Pilih Menu--</option>
                    <?php foreach ($menu as $item): ?>
                        <option value="<?= $item['id_menu']; ?>" <?= isset($detail['id_menu']) && $detail['id_menu'] == $item['id_menu'] ? 'selected' : ''; ?>>
                            <?= $item['nama_menu']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="kuantitas" class="form-label">Kuantitas:</label>
                <input type="number" class="form-control" name="kuantitas" id="kuantitas" value="<?= isset($detail['kuantitas']) ? $detail['kuantitas'] : '' ?>" required oninput="calculateSubtotal()" />
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="harga" id="harga" value="<?= isset($detail['harga']) ? $detail['harga'] : '' ?>" required oninput="calculateSubtotal()" />
            </div>

            <div class="mb-3">
                <label for="subtotal" class="form-label">Subtotal:</label>
                <input type="number" class="form-control" name="subtotal" id="subtotal" value="<?= isset($detail['subtotal']) ? $detail['subtotal'] : '' ?>" readonly />
            </div>

            <div class="mb-3">
                <label for="trans_masuk" class="form-label">Tanggal Masuk:</label>
                <input type="date" class="form-control" name="trans_masuk" value="<?= isset($detail['trans_masuk']) ? $detail['trans_masuk'] : '' ?>" required />
            </div>

            <div class="mb-3">
                <label for="trans_ambil" class="form-label">Tanggal Ambil:</label>
                <input type="date" class="form-control" name="trans_ambil" value="<?= isset($detail['trans_ambil']) ? $detail['trans_ambil'] : '' ?>" required />
            </div>

            <div class="mb-3">
                <label for="id_karyawan" class="form-label">Nama Karyawan:</label>
                <select class="form-select" name="id_karyawan" required>
                    <option value="">--Pilih Karyawan--</option>
                    <?php foreach ($karyawan as $item): ?>
                        <option value="<?= $item['id_karyawan']; ?>" <?= isset($detail['id_karyawan']) && $detail['id_karyawan'] == $item['id_karyawan'] ? 'selected' : ''; ?>>
                            <?= $item['nama_karyawan']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="no_hp_cus" class="form-label">No HP:</label>
                <input type="text" class="form-control" name="no_hp_cus" id="no_hp_cus" value="<?= isset($detail['no_hp_cus']) ? $detail['no_hp_cus'] : '' ?>" required />
            </div>

            <div class="mb-3">
                <label for="pembayaran" class="form-label">Pembayaran:</label>
                <input type="number" class="form-control" name="pembayaran" id="pembayaran" value="<?= isset($detail['pembayaran']) ? $detail['pembayaran'] : '' ?>" required />
            </div>

            <div class="mb-3">
                <label for="status_pembayaran" class="form-label">Status Pembayaran:</label>
                <input type="text" class="form-control" name="status_pembayaran" id="status_pembayaran" value="<?= isset($detail['status_pembayaran']) ? $detail['status_pembayaran'] : '' ?>" required />
            </div>

            <div class="btn-container">
                <a href="<?= site_url('detail_transaksi'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        <?php echo form_close(); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function calculateSubtotal() {
            const kuantitas = document.getElementById('kuantitas').value;
            const harga = document.getElementById('harga').value;
            const subtotalField = document.getElementById('subtotal');
            
            if (kuantitas && harga) {
                const subtotal = parseFloat(kuantitas) * parseFloat(harga);
                subtotalField.value = subtotal.toFixed(2); // Ensures two decimal places
            } else {
                subtotalField.value = '';
            }
        }

        window.onload = function() {
            calculateSubtotal();
        };
    </script>
</body>
</html>
