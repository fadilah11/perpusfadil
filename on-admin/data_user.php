<?php
session_start();
$config= new mysqli ("localhost","root","","e-library")
?>
<html> 
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
<h2>Data User</h2>
<table class="table table-bordered table-hover">
<thead>
    <tr>
    <th>No</th>
    <th>Nama </th>
    <th>Username</th>    
    </tr>
    </thead>
    <tbody>
    <?php $nomor=1; ?>    
    <?php $ambil=$config->query("select * from users"); ?>
    <?php while ($pecah=$ambil->fetch_assoc()){?>
    <tr>
        <td><?php echo $nomor; ?></td>    
        <td><?php echo $pecah["nama"];?></td>
        <td><?php echo $pecah["username"];?></td>
        <td>
            <a href="" class="btn btn-danger">Hapus</a>
        </td>
        </tr>
        <?php $nomor++; ?>  
        <?php } ?>    
    </tbody>
</table>