<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
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
    <div class="container mt-4">
        <h2 class="text-center">Tambah Menu Baru</h2>
        <form action="<?php echo site_url('menu/aksi_tambah'); ?>" method="post">
            <div class="mb-3">
                <label for="id_menu" class="form-label">ID Menu:</label>
                <input type="text" class="form-control" name="id_menu" id="id_menu" required />
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Menu:</label>
                <input type="text" class="form-control" name="nama" id="nama" required />
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Menu:</label>
                <input type="text" class="form-control" name="jenis" id="jenis" required />
            </div>
            <div class="mb-3">
                <label for="waktu" class="form-label">Waktu:</label>
                <input type="text" class="form-control" name="waktu" id="waktu" required />
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga:</label>
                <input type="number" class="form-control" name="harga" id="harga" required />
            </div>
            <div class="btn-container">
                <a href="<?php echo site_url('menu'); ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</body>
</html>
