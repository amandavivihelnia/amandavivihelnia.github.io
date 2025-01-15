<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login - Laundry Latte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #ffff;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow: hidden;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 90%;
            max-width: 1200px;
            position: relative;
        }

        .logo-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .logo-section h1 {
            font-size: 3.5rem;
            font-weight: bold;
            color: rgb(2, 119, 165);
            margin: 0;
        }

        .logo-section img {
            width: 100%;
            max-width: 900px;
        }

        .login-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #f8b400;
            border-radius: 25px;
            padding: 40px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #fff;
            margin-bottom: 40px;
        }

        .form-control {
            border-radius: 50px;
            padding: 10px 20px;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: rgb(6, 55, 104);
            border: none;
            border-radius: 50px;
            font-weight: bold;
            padding: 10px;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            background-color: #073c96;
        }

        .success-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .success-overlay.active {
            visibility: visible;
            opacity: 1;
        }

        .success-animation {
            width: 300px;
            height: 300px;
        }

        .success-text {
            font-size: 1.5rem;
            font-weight: bold;
            color: rgb(98, 102, 224);
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <!-- Success Overlay -->
    <div class="success-overlay" id="successOverlay">
        <dotlottie-player class="success-animation"
            src="https://lottie.host/a3d0a4eb-c015-443b-bf4a-4f5c16a0578e/fh3N02dw34.lottie" background="transparent"
            speed="1" loop autoplay></dotlottie-player>
        <div class="success-text">Berhasil login ke Laundry Latte!</div>
    </div>

    <div class="main-container">
        <div class="logo-section">
            <h1>Laundry Latte</h1>
            <img src="https://i.pinimg.com/736x/70/06/f0/7006f0b00bc371ac6782acae2ab2c969.jpg"
                alt="Laundry Illustration" />
        </div>

        <div class="login-section">
            <div class="login-card">
                <h3>LOGIN</h3>
                <form id="loginForm" action="login/aksi_login" method="POST">
                    <div class="form-group">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Karyawan" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="id" class="form-control" placeholder="ID Karyawan" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('loginForm');
        const successOverlay = document.getElementById('successOverlay');

        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();
            successOverlay.classList.add('active');
            setTimeout(() => {
                loginForm.submit();
            }, 2000);
        });
    </script>
</body>

</html>