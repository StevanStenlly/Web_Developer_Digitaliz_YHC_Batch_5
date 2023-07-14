<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","courseonline");

//Menambah data baru
if(isset($_POST['addnewkursus'])){
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi']; 

    $addtokursus = mysqli_query($conn,"insert into kursus (judul, deskripsi, durasi) values('$judul','$deskripsi','$durasi')");
    if($addtokursus){
        header('location:admin_kursus.php');
    } else {
        echo 'Gagal';
        header('location:admin_kursus.php');
    }
}

//Menambah materi baru
if(isset($_POST['addnewmateri'])){
    $judul_materi = $_POST['judul_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];
    $link = $_POST['link'];

    $addtomateri = mysqli_query($conn,"insert into materi_kursus (judul_materi, deskripsi_materi, link) values('$judul_materi','$deskripsi_materi','$link')");
    if($addtomateri){
        header('location:admin_materi.php');
    } else {
        echo 'Gagal';
        header('location:admin_materi.php');
    }
}

//Update Admin
$ambilsemuadataadmin = mysqli_query($conn,"SELECT * FROM admin");

$dataadmin=mysqli_fetch_array($ambilsemuadataadmin);

if(isset($_POST['updateadmin'])){
    $idad = $_POST['idad'];
    $foto_admin = $_FILES['foto_admin']['name'];
    $path_gambar = "img/".$dataadmin['foto_admin'];

    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if (empty($foto_admin)){

        mysqli_query($conn,"UPDATE admin SET username='$username', password='$password' WHERE id_admin='$idad'");

        echo "<script>alert('Data Berhasil Diubah'); location = 'edit_admin.php' </script>";
    } else {
        unlink($path_gambar);
        
        move_uploaded_file($_FILES['foto_admin']['tmp_name'], 'img/'.$foto_admin);

        mysqli_query($conn,"UPDATE admin SET username='$username', password='$password', foto_admin='$foto_admin'  WHERE id_admin='$idad'");

        echo "<script>alert('Data Berhasil  Diubah'); location = 'edit_admin.php'</script>";

    }
}

//Update Kursus
if(isset($_POST['updatekursus'])){
    $idk = $_POST['idk'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $durasi = $_POST['durasi']; 
    
    $update = mysqli_query($conn,"UPDATE kursus SET judul='$judul', deskripsi='$deskripsi', durasi='$durasi' WHERE id_kursus='$idk'") ;
    if($update){
        header('location:admin_kursus.php');
    } else {
        echo 'Gagal';
        header('location:admin_kursus.php');
    }
}


//Update Materi
if(isset($_POST['updatemateri'])){
    $idm = $_POST['idm'];
    $judul_materi = $_POST['judul_materi'];
    $deskripsi_materi = $_POST['deskripsi_materi'];
    $link = $_POST['link'];
    
    $update = mysqli_query($conn,"UPDATE materi_kursus SET judul_materi='$judul_materi', deskripsi_materi='$deskripsi_materi', link='$link' WHERE id_materi='$idm'") ;
    if($update){
        header('location:admin_materi.php');
    } else {
        echo 'Gagal';
        header('location:admin_materi.php');
    }
}


//Delete kursus
if(isset($_POST['hapusdata'])){
    $idk = $_POST['idk'];

    $hapus = mysqli_query($conn, "DELETE FROM kursus where id_kursus='$idk'");
    if($hapus){
        header('location:admin_kursus.php');
    } else {
        echo 'Gagal';
        header('location:admin_kursus.php');
    }
}


//Delete materi
if(isset($_POST['hapusmateri'])){
    $idm = $_POST['idm'];

    $hapus = mysqli_query($conn, "DELETE FROM materi_kursus where id_materi='$idm'");
    if($hapus){
        header('location:admin_materi.php');
    } else {
        echo 'Gagal';
        header('location:admin_materi.php');
    }
}


?>