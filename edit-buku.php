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
                                if ( isset($_GET["ID_BUKU"])) {
                                $id_buku = $_GET["ID_BUKU"];
                                    if ($ambil_data = mysqli_query($koneksi, "SELECT * FROM tabel_buku WHERE ID_BUKU='$id_buku'")) {
                                        $data_buku = $ambil_data->fetch_assoc();
                            ?>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">
                                        <i class="bi bi-person"></i> ID BUKU</label>
                                    <input readonly id="id_buku" type="text" class="form-control" name="id_buku" value="<?php echo $data_buku["ID_BUKU"];?>" required autofocus readyonly>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">
                                        <i class="bi bi-geo-alt"></i> Kategori
                                    </label>
                                    <input class="form-control" list="datalistOptions" id="kategori" name="kategori" placeholder="Kategori..." value="<?php echo $data_buku["Kategori"];?>">
                                      <datalist id="datalistOptions">
                                        <option value="Keilmuan">
                                        <option value="Bisnis">
                                        <option value="Novel">
                                      </datalist>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="email">
                                        <i class="bi bi-envelope"></i> Nama Buku
                                    </label>
                                    <input id="nama_buku" type="text" class="form-control" name="nama_buku" value="<?php echo $data_buku["Nama_Buku"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="harga">
                                        <i class="bi bi-envelope"></i> Harga
                                    </label>
                                    <input id="harga" type="number" class="form-control" name="harga" value="<?php echo $data_buku["Harga"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="harga">
                                        <i class="bi bi-envelope"></i> Stock
                                    </label>
                                    <input id="stock" type="number" class="form-control" name="stock" value="<?php echo $data_buku["Stock"];?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="penerbit">
                                        <i class="bi bi-envelope"></i> Penerbit
                                    </label>
                                    <input id="penerbit" type="text" class="form-control" name="penerbit" value="<?php echo $data_buku["Penerbit"];?>" required>
                                </div>
                                <button type="submit" id="save" name="save" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                            <?php
                                    } else
                                    echo "ID_BUKU dengan Kode : $id_buku tidak ditemukan. Edit data dibatalkan!";
                                } else
                                  echo "Ooopps terjadi kesalahan";
                            ?>
                        </div>
  </div>
<?php
  if (isset($_POST["save"])) {
        if ($koneksi->connect_errno == 0) {
            // Bersihkan data
            $id_buku = $_POST['id_buku'];
            $kategori = $_POST['kategori'];
            $nama_buku = $_POST['nama_buku'];
            $harga_buku = $_POST['harga'];
            $stock = $_POST['stock'];
            $penerbit = $_POST['penerbit'];

            // Menyusun SQL
            $sql = "UPDATE tabel_buku SET Kategori='$kategori', Nama_Buku='$nama_buku', Harga='$harga_buku', Stock='$stock', Penerbit='$penerbit' WHERE ID_BUKU='$id_buku'";
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