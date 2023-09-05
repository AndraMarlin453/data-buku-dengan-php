<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('location: login.php');

    exit;
}

include "template/header.php";
require "function.php";

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "
            <script>
                alert('Data buku berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Data buku gagal ditambahkan!');
                document.location.href = 'index.php';
            </script>
            ";
    }
}
?>

<div class="container rounded my-3">
    <div class="card mt-3">
        <div class="card-header text-center bg-dark text-white">
            <h2>Tambah Data Buku</h2>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="judul">Judul Buku</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pengarang">Pengarang</label>
                    <input type="text" name="pengarang" id="pengarang" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="penerbit">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="jumlah_halaman">Jumlah Halaman</label>
                    <input type="number" name="jumlah_halaman" id="jumlah_halaman" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Buku</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar Buku</label>
                    <input name="gambar" type="file" class="form-control-file" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
</div>

<?php include "template/footer.php" ?>