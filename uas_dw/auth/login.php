<!DOCTYPE html>
<html>
<head>
    <title>Login UangKu</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .login-box {
            width: 350px;
            margin: 120px auto;
            background: #fff;
            padding: 25px;
            border: 1px solid #000;
        }
        h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px 0;
            border: 1px solid #000;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            border: 1px solid #000;
            background: #fff;
            cursor: pointer;
        }
        button:hover {
            background: #000;
            color: #fff;
        }
        .password-wrapper {
            position: relative;
        }
        .password-wrapper input {
            padding-right: 38px;
            margin: 5px 0 15px 0;
        }
        .show-password {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: -8px;
            margin-bottom: 18px;
            cursor: pointer;
            font-size: 14px;
        }
        .show-password input[type="checkbox"] {
            width: 15px;
            height: 15px;
            margin: 0;
            padding: 0;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Login UangKu</h3>

    <form method="post" action="proses_login.php">
        Username
        <input type="text" name="nama" required>

        Password
        <input type="password" name="password" id="passwordInput" required>
        <label class="show-password">
            <input type="checkbox" onclick="togglePassword()"> Tampilkan Password
        </label>

        <button type="submit">Login</button>
    </form>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

</body>
</html>
