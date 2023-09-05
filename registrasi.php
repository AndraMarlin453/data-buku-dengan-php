<?php
require 'function.php';
include "template/header.php";

if (isset($_POST["daftar"])) {
    if (pendaftaran($_POST) > 0) {
        echo "
            <script>
                alert('Username dan Password berhasil ditambahkan!');
            </script>
        ";
    } else {
        echo mysqli_error($conn);
    }
}

?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center text-white bg-primary">
                    <h3>Buat User Baru</h3>
                </div>
                <div class="card-body">
                    <form action="" method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password2">Konfirmasi Password</label>
                            <input type="password" name="password2" id="password2" class="form-control">
                        </div>
                        <p style="font-size: 12px;">Sudah punya akun? Silahkan <a href="login.php" class="text-decoration-none">Masuk</a></p>
                        <button type="submit" name="daftar" class="btn btn-primary btn-block">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php" ?>