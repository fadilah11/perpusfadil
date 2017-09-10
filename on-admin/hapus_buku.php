<?php
include "config.php";
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$delete=$dbconnect->query("delete from buku where id='$id'");
	if($delete)
	{
        echo "<script>alert('Data berhasil Dihapus')
        location.replace('index.php')</script>";
	}
}
?>