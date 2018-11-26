<?php
session_start();
if(!isset($_SESSION["login"]))
{
    echo $_SESSION["login"];
    header("Location:login.php");
    exit;
}
require 'Functions.php';
// cek apakah button submit sudah di tekan atau belum
// menggunakan mehtod get untuk mengambil id yg telah
// terseleksi oleh user dan dimasukkan ke dalam variabel 
// baru yaitu $id
$id=$_GET["id"];
// var_dump($id);

// query berdasar id
$mhs=query("SELECT * FROM mahasiswa WHERE id=$id")[0];
//var_dump($mhs);
//var_dump($mhs[0]["Nama"]);

// cek apakah button submit sudah ditekan atau belum
if(isset($_POST["submit"]))
{
    // cek sukses data dirubah menggunakan function edit pada function.php
    if(Edit($_POST)>0)
    {
        echo "
        <script>
        alert('data berhasil diperbarui');
        document.location.href='Index.php';
        </script>
        ";
    }
    else
    {
        echo "
        <script>
        alert('data gagal diperbaruhi');
        document.location.href='Edit.php';
        </script>";
        echo "<br>";
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <title>Update Data</title>
</head>
<body>
    <h1> Update Data Mahasiswa</h1>
    <!-- menambahkan atribut enctype -->
    <form action="" method="post" enctype="multipart/form-data">
    <li>
        <input type="hidden" name="id" balue="<?= $mhs["id"]?>">
        <!-- untuk mengirimkan gambar lama -->
        <input type="hidden" name="GambarLama" value="<?= $mhs["Gambar"]; ?>">
    </li>
    <ul>
        <li>
            <!--for pada tabel terhubung dengan id jika label nama diklik maka textfield nama akan aktif juga -->
            <label for="Nama">Nama :</label>
            <!-- untuk pengisian name besar kecil harus sesuai dengan fieldnya -->
            <input type="text" name="Nama" id="Nama" value="<?= $mhs["Nama"]; ?>">
        </li>
        <li>
            <label for="NIM">NIM :</label>
            <input type="text" name="Nim" id="Nim" required value="<?= $mhs["Nim"]; ?>">
        </li>
        <li>
            <label for="Email">Email :</label>
            <input type="text" name="Email" id="Email" required value="<?= $mhs["Email"]; ?>">
        </li>
        <li>
            <label for="Jurusan">Jurusan :</label>
            <input type="text" name="Jurusan" id="Jurusan" required value="<?= $mhs["Jurusan"]; ?>">
        </li>
        <li>
            <label for="Gambar">Gambar :</label><br>
            <!-- tambahkan image source agar gambar dapat muncul -->
            <img src="image/<?= $mhs["Gambar"]; ?>" alt="" height="100" width="100"><br>
            <input type="file" name="Gambar" id="Gambar" required value="<?= $mhs["Gambar"]; ?>">
        </li>
        <li>
            <button type="submit" name="submit">Update</button>
        </li>
    </ul>
    </form>

</body>
</html>