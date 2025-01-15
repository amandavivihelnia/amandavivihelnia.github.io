<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan</title>
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

        h4 {
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

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h4 class="text-center">Tambah Karyawan</h4>
        <form action="<?= base_url('karyawan/tambah'); ?>" method="POST">
            <div class="mb-3">
                <label for="id_karyawan" class="form-label">ID Karyawan</label>
                <input type="text" class="form-control" id="id_karyawan" name="id_karyawan" value="<?= set_value('id_karyawan'); ?>" required>
                <?= form_error('id_karyawan', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="mb-3">
                <label for="nama_karyawan" class="form-label">Nama Karyawan</label>
                <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" value="<?= set_value('nama_karyawan'); ?>" required>
                <?= form_error('nama_karyawan', '<div class="text-danger">', '</div>'); ?>
            </div>
            <div class="btn-container">
                <a href="<?= base_url('karyawan'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>

        <?php if ($this->session->flashdata('data') === 'tambah') { ?>
            <div class="alert alert-success mt-3">Karyawan berhasil ditambahkan!</div>
        <?php } ?>
    </div>
</body>
</html>
