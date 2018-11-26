<?php

session_start();
if(!isset($_SESSION["login"]))
{
    echo $_SESSION["login"];
    header("Location:login.php");
    exit;
}
    require 'Functions.php';
    $Mahasiswa = query("SELECT * FROM Mahasiswa");

    //tombol cari ditekan
    // cari pada line 7 adalah name dari button
    if (isset($_POST["cari"]))
    {
        //cari line 10 adalah function cari dari keyword adalah name dari inputan text
        $Mahasiswa = cari($_POST["keyword"]);
    }
?>

<html lang="en">
    <head>
        <meta charsey="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <h1><center>Daftar Mahasiswa</h1>
        <div class="container">
        <p>

        <a href="logout.php">Log Out </a>

        <a href="tambah_data.php">Tambah Data Mahasiswa</a>
    <form action="" method="post">
        <!-- autofocus atribut pada html 5 yg digunakan untukmemberikan tanda pertama kali ke inputan pada saat page di reload -->
        <!-- placeholder atribut yg digunakan untuk menampilkan tulisan pada textbox -->
        <!-- autocomplete digunakan agar history pencarian dari user lain tidak ada -->
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukkan Keyword Pencarian" autocomplete="off">
        <button type="submit" name="cari"> Cari</button>
    </form>
    <br>
        <a href="tambah.php"> Tambah Data Mahasiswa</a>
        <table border="1" cellpadding="10" cellspacing="0">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Nim</th>
            <th>Email</th>
            <th>Jurusan</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1 ?>
        <?php foreach($Mahasiswa as $row):?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $row["Nama"]; ?></td>
            <td><?= $row["Nim"]; ?></td>
            <td><?= $row["Email"]; ?></td>
            <td><?= $row["Jurusan"]; ?></td>
            <td><img src="Gambar/<?php echo $row["Gambar"]; ?>" alt="" scrset="" width="100" height="100"></td>
            <td>
                <a href="Edit.php?id=<?php echo $row["id"];?>">Edit</a>
                <a href="Hapus.php?id=<?php echo $row["id"]; ?>"onclick="return confirm('Apakah data ini akan dihapus')">Hapus</a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endforeach;?>
        </table>        
    </body>
</html>