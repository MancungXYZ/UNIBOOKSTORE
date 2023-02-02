<?php
$koneksi = mysqli_connect("localhost","root","","UNIBOOKSTORE");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>UNIBOOKSTORE</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
</html>

            
<div class="cointaner">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Edit Data Buku</h1>

                            <?php
                                if ( isset($_GET["ID_PENERBIT"])) {
                                $id_penerbit = $_GET["ID_PENERBIT"];
                                    if ($ambil_data = mysqli_query($koneksi, "SELECT * FROM tabel_penerbit WHERE ID_PENERBIT='$id_penerbit'")) {
                                        $data_penerbit = $ambil_data->fetch_assoc();
                            ?>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="id_penerbit">
                                        <i class="bi bi-person"></i> ID PENERBIT</label>
                                    <input readonly id="id_penerbit" type="text" class="form-control" name="id_penerbit" value="<?php echo $data_penerbit["ID_PENERBIT"];?>">
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nama_penerbit">
                                        <i class="bi bi-envelope"></i> Nama Penerbit
                                    </label>
                                    <input id="nama_penerbit" type="text" class="form-control" name="nama_penerbit" value="<?php echo $data_penerbit["Nama_Penerbit"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="Alamat">
                                        <i class="bi bi-envelope"></i> Alamat
                                    </label>
                                    <input id="alamat" type="text" class="form-control" name="alamat" value="<?php echo $data_penerbit["Alamat"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="Kota">
                                        <i class="bi bi-envelope"></i> Kota
                                    </label>
                                    <input id="kota" type="text" class="form-control" name="kota" value="<?php echo $data_penerbit["Kota"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="penerbit">
                                        <i class="bi bi-envelope"></i> Telepon
                                    </label>
                                    <input id="telepon" type="tel" class="form-control" name="telepon" value="<?php echo $data_penerbit["Telepon"];?>" required>
                                </div>
                                <button type="submit" name="ubah" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                            <?php
                                    } else
                                    echo "ID_PENERBIT dengan Kode : $id_penerbit tidak ditemukan. Edit data dibatalkan!";
                                } else
                                  echo "Ooopps terjadi kesalahan";
                            ?>
                        </div>
  </div>
<?php
  if (isset($_POST["ubah"])) {
        if ($koneksi->connect_errno == 0) {
            // Bersihkan data
            $id_penerbit = $_POST['id_penerbit'];
            $nama_penerbit = $_POST['nama_penerbit'];
            $alamat = $_POST['alamat'];
            $kota = $_POST['kota'];
            $telepon = $_POST['telepon'];

            // Menyusun SQL
            $sql = "UPDATE tabel_penerbit SET Nama_Penerbit='$nama_penerbit', Alamat='$alamat', Kota='$kota', Telepon='$telepon' WHERE ID_PENERBIT='$id_penerbit'";
            $res = $koneksi->query($sql);
            if ($res) {
                if ($koneksi->affected_rows > 0) { // jika ada penambahan data
                    echo "<script>alert('Data Berhasil disimpan!')</script>";
                    echo "<script>location='admin.php';</script>";
                }
            } else {
                echo "<script>alert('Data gagal tersimpan!')</script>";
                echo "<script>location='admin.php';</script>";
            }
        } else
            echo "<script>alert('Koneksi Database gagal!')</script>";
    }
?>