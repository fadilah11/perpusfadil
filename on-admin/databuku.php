<?php
session_start();
include "config.php";
?>
<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
</head> 
<body>
<div class="container-fluid">  
<h2>Data Buku</h2>
<table class="table table-bordered table-hover">
<thead>
    <tr>
    <th>No</th>
    <th>Judul Buku </th>
    <th>Kategori</th>
    <th>Penulis</th>
    <th>Jumlah Halaman</th>
    <th>Synopsis</th>
    <th>cover</th>
    <th>File Buku</th>
    <th>username</th>
    <th>Data Upload</th>
    <th>Aksi</th>    
    </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>    
    <?php $ambil=$dbconnect->query("SELECT * FROM buku JOIN kategori ON buku.kategori=kategori.id_kategori JOIN users ON buku.username=users.id_user"); ?>
    <?php while ($pecah=$ambil->fetch_assoc()){ ?>
    <tr>
        <td><?php echo $nomor; ?></td>    
        <td><?php echo $pecah["judul_buku"];?></td>
        <td><?php echo $pecah["kategori"];?></td>
        <td><?php echo $pecah["penulis"];?></td>
        <td><?php echo $pecah["jumlah_halaman"];?></td>
        <td><?php echo $pecah["synopsis"];?></td>
        <td><img src="../cover_buku/<?php echo $pecah["cover"];?>" alt="" widt="70" height="70"></td>
        <td><?php echo $pecah["file_buku"];?></td>
        <td><?php echo $pecah["username"];?></td>
        <td><?php echo $pecah["data_upload"];?></td>
        <td>
           <a href="edit_buku.php?id=<?php echo $pecah['id']; ?>" class="btn btn-primary">Ubah</a>
            <a href="hapus_buku.php?id=<?php echo $pecah['id']; ?>" class="btn btn-danger">Hapus</a> 
        </td>
        </tr>
        <?php $nomor++; ?>  
        <?php } ?>    
    </tbody>
</table>
</div>
</body>
</html>