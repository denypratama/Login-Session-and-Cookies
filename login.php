<?php
session_start();

//cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['username']))
{
    $id=$_COOKIE['id'];
    $key=$_COOKIE['key'];

    //ambil username berdasarkan id
    $result=mysqli_query($conn, "SELECT username FROM user WHERE id=$id");
    $row=mysqli_fetch_assoc($result);

    //cek cookie dan username
    if($key===hash('sha256',$row['username']))
    {
        $_SESSION['login']=true;
    }
}
if(!isset($_SESSION["login"]))
{
    echo $_SESSION["login"];
    header("Location:login.php");
    exit;
}
require 'Functions.php';

if(isset($_POST["login"]))
{
    $username=$_POST["username"];
    $password=$_POST["password"];

    $result=mysqli_query($conn,"SELECT * FROM user WHERE username='$username'");
    
    //cek username
    //mysqli_num_rows=untuk menghitung ada berapa baris yg akan dikembalikan parameter
    //kalau ada yg dikembalikan nilainya adalah 1 jika tidak ada nilainya 0

    if(mysqli_num_rows($result)===1)
    {
        //var_dump($result);
        //cek password
        $row=mysqli_fetch_assoc($result);
        //var_dump($row);

        //digunakan untuk mengecek sebuah string apakah sama dengan hashnya
        //terdapat 2 parameter (password yg blm diacak, password yg sudah diacak)
        if(password_verify($password,$row["password"]))
        {
            //set session
            $_SESSION["login"]=true;

            //cek remember me
            if(isset($_POST['remember']))
            {
                //enkripsi cookie mwnggunkan hash tipe sha256
                setcookie('id',$row['id'], time()+60);
                setcookie('key', hash(sha256,$row['username']),time()+60);
            }

            //redirect ke halaman index.php
            header("Location:Index.php");
            exit;
        }
    }
    $error=true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Halaman Login</title>
</head>
<body>
    <h1>Halaman Login</h1>
    <?php
    if(isset($error))
    :?>
    <p style="color:red;font-style=bold">
    Username dan Password Salah</p>
    <?php endif?>
    <form action="" method="post">
    <ul>
        <li>
            <label for="username">Username :</label>
            <input type="text" name="username" id="username">
        </li>
        <li>
            <label for="password">Password :</label>
            <input type="password" name="password" id="password">
        </li>
        <li>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember ME</label>
        <li>
            <button type="submit" name="login">Login</button>
        </li>
    </ul>
    </form>
</body>
</html>