<?php
//Menghubungkan dengan Mysql
$koneksi = mysqli_connect("localhost","root","","UNIBOOKSTORE");
 
// Jika ada kesalah tampilkan
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNIBOOKSTORE - ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">UNIBOOKSTORE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pengadaan.php">Pengadaan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Memasukan Data Buku Sebagai Admin -->
<div class="cointaner">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Tambah Data Buku</h1>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">
                                        <i class="bi bi-person"></i> ID BUKU</label>
                                    <input id="id_buku" type="text" class="form-control" name="id_buku" value="" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="name">
                                        <i class="bi bi-geo-alt"></i> Kategori
                                    </label>
                                    <input class="form-control" list="datalistOptions" id="kategori" name="kategori" placeholder="Kategori...">
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
                                    <input id="nama_buku" type="text" class="form-control" name="nama_buku" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="harga">
                                        <i class="bi bi-envelope"></i> Harga
                                    </label>
                                    <input id="harga" type="number" class="form-control" name="harga" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="harga">
                                        <i class="bi bi-envelope"></i> Stock
                                    </label>
                                    <input id="stock" type="number" class="form-control" name="stock" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="penerbit">
                                        <i class="bi bi-envelope"></i> Penerbit
                                    </label>
                                    <input id="penerbit" type="text" class="form-control" name="penerbit" value="" required>
                                </div>
                                <button type="submit" name="save" class="btn btn-primary">Tambah buku</button>
                            </form>
                        </div>
  </div>

  <div class="container">
  <h1>Data Buku</h1>
  <div class="row">
                <div class="col mb-4">
                    <div class="main-content-inner">
                        <div class="container shadow p-3 mb-5 bg-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered border-primary table-hover" id="dataTables-example">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>ID BUKU</th>
                                            <th>Kategori</th>
                                            <th>Nama Buku</th>
                                            <th>Harga</th>
                                            <th>Stock</th>
                                            <th>Penerbit</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($koneksi, "SELECT * FROM tabel_buku");
                                        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                                        if (mysqli_num_rows($sql) > 0) {
                                            //membuat variabel untuk menyimpan nomor urut
                                            //melakukan perulangan while dengan dari dari query
                                            $no = 1;
                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                //menampilkan data perulangan
                                                echo '
						<tr>
                            <td>' . $no . '</td>
							              <td>' . $data['ID_BUKU'] . '</td>
							              <td>' . $data['Kategori'] . '</td>
							              <td>' . $data['Nama_Buku'] . '</td>
							              <td>' . $data['Harga'] . '</td>
							              <td>' . $data['Stock'] . '</td>
                            <td>' . $data['Penerbit'] . '</td>
                            <td>
                            <a href="edit-buku.php?ID_BUKU=' . $data['ID_BUKU'] . '" class="badge text-bg-warning">Edit</a>
                            <a href="hapus-buku.php?ID_BUKU=' . $data['ID_BUKU'] . '" class="badge text-bg-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
                            </td>
						</tr>
						';
                                                $no++;
                                            }
                                            //jika query menghasilkan nilai 0
                                        } else {
                                            echo '
					<tr>
						<td colspan="3">Persediaan buku masih aman.</td>
					</tr>
					';
                                        }
                                        ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
  </div>
</div>

<?php
  if(isset($_POST['save'])) {
    //ketika button save di tekan ambil data setiap input
    $id_buku = $_POST['id_buku'];
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga_buku = $_POST['harga'];
    $stock = $_POST['stock'];
    $penerbit = $_POST['penerbit'];

    $sql = mysqli_query($koneksi, "SELECT * FROM tabel_buku WHERE ID_BUKU='$id_buku'");
    var_dump($sql);
    if(!$sql->num_rows > 0) {
      $masukan = "INSERT INTO tabel_buku (ID_BUKU, Kategori, Nama_Buku, Harga, Stock, Penerbit)
                  VALUES ('$id_buku','$kategori', '$nama_buku','$harga_buku', '$stock', '$penerbit')";
      $hasil = mysqli_query($koneksi, $masukan);
      if($hasil) {
        echo '<script language="javascript">';
        echo 'alert("Data berhasil di simpan")';
        echo '</script>';
        echo "<script>location='admin.php';</script>";
      }
    }
  }
?>

<!-- Memasukan Data Penerbit Sebagai Admin -->
<div class="cointaner">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4">Tambah Data Penerbit</h1>
                            <form method="POST" class="needs-validation" novalidate="" autocomplete="off">
                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="id_penerbit">
                                        <i class="bi bi-person"></i> ID PENERBIT</label>
                                    <input id="id_penerbit" type="text" class="form-control" name="id_penerbit" value="" required autofocus>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="nama_penerbit">
                                        <i class="bi bi-envelope"></i> Nama Penerbit
                                    </label>
                                    <input id="nama_penerbit" type="text" class="form-control" name="nama_penerbit" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="Alamat">
                                        <i class="bi bi-envelope"></i> Alamat
                                    </label>
                                    <input id="alamat" type="text" class="form-control" name="alamat" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="Kota">
                                        <i class="bi bi-envelope"></i> Kota
                                    </label>
                                    <input id="kota" type="text" class="form-control" name="kota" value="" required>
                                </div>

                                <div class="mb-3">
                                    <label class="mb-2 text-muted" for="penerbit">
                                        <i class="bi bi-envelope"></i> Telepon
                                    </label>
                                    <input id="telepon" type="tel" class="form-control" name="telepon" value="" required>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Tambah Data Penerbit</button>
                            </form>
                        </div>
  </div>

  <div class="container">
  <h1>Data Penerbit</h1>
  <div class="row">
                <div class="col mb-4">
                    <div class="main-content-inner">
                        <div class="container shadow p-3 mb-5 bg-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered border-primary table-hover" id="dataTables-example">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>ID Penerbit</th>
                                            <th>Nama Penerbit</th>
                                            <th>Alamat</th>
                                            <th>Kota</th>
                                            <th>Telepon</th>
                                            <th>Aksi</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($koneksi, "SELECT * FROM tabel_penerbit");
                                        //jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
                                        if (mysqli_num_rows($sql) > 0) {
                                            //membuat variabel untuk menyimpan nomor urut
                                            //melakukan perulangan while dengan dari dari query
                                            $no = 1;
                                            while ($data = mysqli_fetch_assoc($sql)) {
                                                //menampilkan data perulangan
                                                echo '
						<tr>
                            <td>' . $no . '</td>
							              <td>' . $data['ID_PENERBIT'] . '</td>
							              <td>' . $data['Nama_Penerbit'] . '</td>
							              <td>' . $data['Alamat'] . '</td>
							              <td>' . $data['Kota'] . '</td>
                            <td>' . $data['Telepon'] . '</td>
                            <td>
                            <a href="edit-penerbit.php?ID_PENERBIT=' . $data['ID_PENERBIT'] . '" class="badge text-bg-warning">Edit</a>
                            <a href="hapus-penerbit.php?ID_PENERBIT=' . $data['ID_PENERBIT'] . '" class="badge text-bg-danger" onclick="return confirm(\'Yakin ingin menghapus data ini?\')">Delete</a>
                            </td>
						</tr>
						';
                                                $no++;
                                            }
                                            //jika query menghasilkan nilai 0
                                        } else {
                                            echo '
					<tr>
						<td colspan="3">Persediaan buku masih aman.</td>
					</tr>
					';
                                        }
                                        ?>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
  </div>
</div>

<?php
  if(isset($_POST['simpan'])) {
    //ketika button simpan di tekan ambil data setiap input
    $id_penerbit = $_POST['id_penerbit'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];

    $sql = mysqli_query($koneksi, "SELECT * FROM tabel_penerbit WHERE ID_PENERBIT='$id_penerbit'");
    if(!$sql->num_rows > 0) {
      $masukan = "INSERT INTO tabel_penerbit (ID_PENERBIT, Nama_Penerbit, Alamat, Kota, Telepon)
                  VALUES ('$id_penerbit','$nama_penerbit', '$alamat','$kota', '$telepon')";
      $hasil = mysqli_query($koneksi, $masukan);
      if($hasil) {
        echo '<script language="javascript">';
        echo 'alert("Data berhasil di simpan")';
        echo '</script>';
        echo "<script>location='admin.php';</script>";
      }
    }
  }
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>