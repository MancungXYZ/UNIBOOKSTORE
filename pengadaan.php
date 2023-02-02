<?php
$koneksi = mysqli_connect("localhost","root","","UNIBOOKSTORE");
 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UNIBOOKSTORE - PENGADAAN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
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
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pengadaan.php">Pengadaan</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Menampilkan pengadaan -->
<div class="container">
  <h1>Data Pengadaan Buku</h1>
  <div class="row">
                <div class="col mb-4">
                    <div class="main-content-inner">
                        <div class="container shadow p-3 mb-5 bg-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered border-primary table-hover" id="dataTables-example">
                                    <thead class="thead-dark text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Buku</th>
                                            <th>Nama Penerbit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = mysqli_query($koneksi, "SELECT Nama_Buku, Penerbit FROM tabel_buku WHERE Stock < 10");
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
							              <td>' . $data['Nama_Buku'] . '</td>
                            <td>' . $data['Penerbit'] . '</td>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>