<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>
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
        <h2 class="text-center mb-4">Tambah Customer</h2>
        <?= validation_errors('<div class="alert alert-danger">', '</div>'); ?>
        <form action="<?= site_url('customer/tambah/') ?>" method="POST">
            <div class="mb-3">
                <label for="no_hp_cus" class="form-label">No. HP</label>
                <input type="text" name="no_hp_cus" id="no_hp_cus" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="point_cust" class="form-label">Poin</label>
                <input type="number" name="point_cust" id="point_cust" class="form-control" required>
            </div>
            <div class="btn-container">
                <a href="<?= site_url('customer'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</body>
</html>
