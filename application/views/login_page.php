<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin Panel</title>
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background: #f4f7f6;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-card {
        background: #fff;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 350px;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #666;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        border: none;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }

    button:hover {
        background: #0056b3;
    }

    .alert {
        background: #ff4d4d;
        color: white;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 1rem;
        font-size: 14px;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="login-card">
        <h2>Admin Login</h2>

        <?php if ($this->session->flashdata('msg')): ?>
        <script>
        alert("<?= $this->session->flashdata('msg'); ?>");
        </script>
        <?php endif; ?>


        <form method="post" action="<?= base_url('auth/login_process'); ?>">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required autofocus>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Login Sekarang</button>
        </form>
    </div>

</body>

</html>