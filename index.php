<?php
session_start();

if (!isset($_SESSION["login"])) {
    header('location: login.php');

    exit;
}

require "function.php";

$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM buku"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['page'])) ? $_GET['page'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$buku = query("SELECT * FROM buku
                ORDER BY id DESC
                LIMIT $awalData, $jumlahDataPerHalaman");

// pencarian
if (isset($_POST["search"])) {
    $buku = search($_POST["keyword"]);
}

include "template/header.php";
?>

<div class="container bg-white rounded shadow my-4 p-3">
    <h2 class="text-center mb-3">Daftar Buku</h2>
    <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Buku</a>
    <a href="logout.php" class="nav-link btn btn-secondary float-right">Keluar</a>
    <form action="" method="post" class="form-inline">
        <input class="form-control mb-3 mr-2" type="search" name="keyword" id="keyword" placeholder="Cari data buku..." aria-label="Search" autocomplete="off">
        <button class="btn btn-primary mb-3" type="submit" name="search">Search</button>
    </form>
    <div id="container">
        <table class="table table-bordered table-striped table-responsive-lg">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Jumlah Halaman</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = $awalData + 1; ?>
                <?php foreach ($buku as $row) : ?>
                    <tr>
                        <th scope="row"><?= $i; ?>.</th>
                        <td><img src="img/<?= $row["gambar"]; ?>" width="50"></td>
                        <td><?= $row["judul"]; ?></td>
                        <td><?= $row["pengarang"]; ?></td>
                        <td><?= $row["penerbit"]; ?></td>
                        <td><?= $row["jumlah_halaman"]; ?> Halaman</td>
                        <td>Rp. <?= $row["harga"]; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-info">Ubah</a>
                            <a href="hapus.php?id=<?= $row["id"]; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <?php if ($halamanAktif > 1) : ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $halamanAktif - 1; ?>">Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?><span class="sr-only">(current)</span></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($halamanAktif < $jumlahHalaman) : ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $halamanAktif + 1; ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<?php include "template/footer.php" ?>