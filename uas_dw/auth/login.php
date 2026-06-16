<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login UangKu</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body class="login-page">

<div class="login-box">
    <h3>Login UangKu</h3>

    <form method="post" action="proses_login.php">
        <label>Username</label>
        <input type="text" name="nama" required>

        <label>Password</label>
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
