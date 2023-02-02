<?php
$koneksi = mysqli_connect("localhost","root","","UNIBOOKSTORE");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

//jika benar mendapatkan GET id dari URL
if (isset($_GET['ID_PENERBIT'])) {
    //membuat variabel
    $id_penerbit = $_GET['ID_PENERBIT'];

    //melakukan query ke database, dengan cara SELECT data yang memiliki id yang sama dengan variabel $id
    $cek = mysqli_query($koneksi, "SELECT * FROM tabel_penerbit WHERE ID_PENERBIT ='$id_penerbit'");

    //jika query menghasilkan nilai > 0 maka eksekusi script di bawah
    if ($cek->num_rows > 0) {
        //query ke database DELETE untuk menghapus data dengan kondisi id=$id
        $del = mysqli_query($koneksi, "DELETE FROM tabel_penerbit WHERE ID_PENERBIT ='$id_penerbit'");
        if ($del) {
            echo '<script>alert("Berhasil menghapus data."); document.location="admin.php";</script>';
        } else {
            echo '<script>alert("Gagal menghapus data."); document.location="admin.php";</script>';
        }
    } else {
        echo '<script>alert("ID buku tidak ditemukan di database."); document.location="admin.php";</script>';
    }
} else {
    echo '<script>alert("Koneksi database gagal."); document.location="admin.php";</script>';
}
