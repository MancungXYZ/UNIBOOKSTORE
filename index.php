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
    <title>UNIBOOKSTORE</title>
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin.php">Admin</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pengadaan.php">Pengadaan</a>
        </li>
      </ul>
      <form method="GET" action="index.php" class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<?php
  if(isset($_GET['search'])) {
    //menampung variabel kata_cari dari form pencarian
	$kata_cari = $_GET['search'];

	// Mencari Buku berdasarkan Nama Buku
	$query = "SELECT * FROM tabel_buku WHERE Nama_Buku LIKE '%".$kata_cari."%'";
    } else {
	//jika tidak ada pencarian, default yang dijalankan query ini
	$query = "SELECT * FROM tabel_buku";
    }
?>

<!-- Menampilkan Data buku -->
<div class="container mt-3">

    <div class="row">
      
        <?php
          if(isset($_GET['search'])) {
            //menampung variabel kata_cari dari form pencarian
          $kata_cari = $_GET['search'];
          $query = "SELECT * FROM tabel_buku WHERE Nama_Buku LIKE '%".$kata_cari."%'";
          } else {
            $query = "SELECT * FROM tabel_buku";
          }
          
          $ambil = $koneksi->query($query);


        ?>

        <?php while($perbuku = $ambil->fetch_assoc()) { ?>

          <div class="col-md-4 mb-3 d-flex justify-content-center">
            <div class="card shadow" style="width: 18rem;">
              <img src="book.png" class="card-img-top" alt="Buku" width="150" height="150">
              <div class="card-body text-center">
                <div class="container">
                  <h5 class="card-title"><?php echo $perbuku['Nama_Buku']; ?></h5>
                  <p class="card-text">Rp. <?php echo number_format($perbuku['Harga']); ?></p>
                </div>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">Stock : <?php echo $perbuku['Stock']; ?></li>
                </ul>
              </div>
            </div>
          </div>
          <?php } ?>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>