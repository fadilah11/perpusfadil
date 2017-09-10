<?php
require_once("config.php");
connect_db();
if(isset($_GET[fileid]))
{
$id = $_GET[fileid];
$query = "SELECT * FROM buku WHERE id = $fileid";
$result = mysqli_query($query) or die(Error, query failed);
list($fileid,$filename,$type,$size,$path)=mysqli_fetch_array($result);
header("Content-Disposition: attachment; filename=$filename");
readfile("buku_upload/$path");
}
?>