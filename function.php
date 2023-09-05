<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "rental_buku");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data)
{
    global $conn;
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $jumlah_halaman = $data["jumlah_halaman"];
    $harga = $data["harga"];

    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // Insert data
    $query = "INSERT INTO buku VALUES ('', '$judul', '$pengarang', '$penerbit', '$jumlah_halaman', '$harga', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $fileName);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // cek file gambar
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "
        <script>
            alert('yang diupload harus file gambar!');
        </script>
    ";
        return false;
    }
    // cek ukuran gambar
    if ($fileSize > 2000000) {
        echo "
        <script>
            alert('yang diupload harus file gambar!');
        </script>
        ";
        return false;
    }

    // buat nama gambar baru
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $newFileName);
    return $newFileName;
}

function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $judul = htmlspecialchars($data["judul"]);
    $pengarang = htmlspecialchars($data["pengarang"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $jumlah_halaman = $data["jumlah_halaman"];
    $harga = $data["harga"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {

        $gambar = upload();
    }

    // Update data
    $query = "UPDATE buku SET
                judul = '$judul',
                pengarang = '$pengarang',
                penerbit = '$penerbit',
                jumlah_halaman = $jumlah_halaman,
                harga = $harga,
                gambar = '$gambar'
            WHERE id = $id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM buku WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function search($keyword)
{
    $query = "SELECT * FROM buku WHERE
                judul LIKE '%$keyword%' OR
                pengarang LIKE '%$keyword%' OR
                penerbit LIKE '%$keyword%'
                ";

    return query($query);
}

// function registrasi
function pendaftaran($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)) {
        echo "
            <script>
                alert('Username yang dibuat sudah dipakai!');
            </script>
        ";
        return false;
    }

    // confirm password
    if ($password !== $password2) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai!');
            </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}
