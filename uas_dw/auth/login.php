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
    </style>
</head>
<body>

<div class="login-box">
    <h3>Login UangKu</h3>

    <form method="post" action="proses_login.php">
        Username
        <input type="text" name="nama" required>

        Password
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
