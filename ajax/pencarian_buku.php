<?php
require '../function.php';
$keyword = $_GET["keyword"];

$query = "SELECT * FROM buku WHERE
                judul LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR
                penerbit LIKE '%$keyword%'
                ";
$buku = query($query);
?>

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
        <?php $i = 1; ?>
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