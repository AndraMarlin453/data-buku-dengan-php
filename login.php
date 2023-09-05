<?php
session_start();
require "function.php";

// Cek cookie
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if (isset($_SESSION["login"])) {
    header('location: index.php');

    exit;
}

include "template/header.php";

if (isset($_POST["masuk"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if (mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) {
            // pasang session
            $_SESSION['login'] = true;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header('location: index.php');
            exit;
        }
    }
    $error = true;
}

?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-center text-white bg-primary">
                    <h3>Login</h3>
                </div>
                <div class="card-body">

                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            Username atau Password salah!
                        </div>
                    <?php endif; ?>

                    <form action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group form-check">
                            <input class="form-check-input" type="checkbox" name="remember" value="" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember Me
                            </label>
                        </div>
                        <p style="font-size: 12px;">Belum punya akun? Silahkan daftar <a href="registrasi.php" class="text-decoration-none">disini</a></p>
                        <button type="submit" name="masuk" class="btn btn-primary btn-block">Masuk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include "template/footer.php" ?>