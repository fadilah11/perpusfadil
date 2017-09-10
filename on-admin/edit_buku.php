<?php
include "config.php";
if(isset($_GET['id']))
{
	$id=$_GET['id'];
    $ambil=$dbconnect->query("select * from buku JOIN kategori ON buku.kategori=kategori.id_kategori JOIN users ON buku.username=users.id_user WHERE id=$id"); 
    $pecah=$ambil->fetch_assoc();
}
?>
<html>
 
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/tambah.css" rel="stylesheet">    
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
                <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                    <legend class="text-center">Edit Buku</legend>
                    <!-- judul input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="judul">Judul</label>
                        <div class="col-md-9">
                            <input id="judul_buku" name="judul" type="text" placeholder="Judul Buku" class="form-control"  value="<?php echo $pecah['judul_buku']; ?>">
                        </div>
                    </div>

                    <!-- kategori input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="kategori">Kategori</label>
                        <div class="col-md-9">
                            <select name="kategori" id="kategori">
                                            <option value="<?php echo $pecah['id_kategori']; ?>"><?php echo $pecah['kategori']; ?></option>
                                            <?php $query=$dbconnect->query("SELECT * FROM kategori");
                                                while ($row1 = mysqli_fetch_assoc($query)){
                                            ?>
                                            <option value="<?php echo $row1['id_kategori']; ?>"><?php echo $row1['kategori']; ?></option>
                                            <?php } ?>
                                        </select>
                        </div>
                    </div>

                    <!-- penulis input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="penulis">Penulis</label>
                        <div class="col-md-9">
                            <input id="penulis" name="penulis" type="text" placeholder="Penulis" class="form-control" value="<?php echo $pecah['penulis']; ?>">
                        </div>
                    </div>

                    <!-- jumlah input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="jumlah">Jumlah Halaman</label>
                        <div class="col-md-9">
                            <input id="jumlah" name="jumlah" type="jumlah" placeholder="Jumlah Halaman " class="form-control" value="<?php echo $pecah['jumlah_halaman']; ?>">
                        </div>
                    </div>

                    <!-- Message body -->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="synopsis">Synopsis</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="synopsis" name="synopsis" placeholder="Please enter your message here..." rows="5"><?php echo $pecah['synopsis']; ?></textarea>
                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-3 contol-label" for="image">Cover Buku</label>
                        <div class="col-md-9">
                            <img src="../cover_buku/<?php echo $pecah['cover']; ?>" id="uploadPreview" style="width: 150px; height: 150px;" /><br>
                            <input id="uploadImage" type="file" name="image" onchange="PreviewImage();"/>
                            <input type="text" name="" value="<?php echo $pecah['cover']; ?>" disabled>
                        </div>
                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                        <label class="col-md-3 contol-label" for="file" value>File Buku</label>
                        <div class="col-md-9">
                            <input id="uploadImage" type="file" name="file"/>
                            <input type="text" name="" value="<?php echo $pecah['file_sbuku']; ?>" disabled>
                        </div>
                    </div>

                    <!-- username input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Username</label>
                        <div class="col-md-9">
                            <select name="username" id="username">
                                            <option value="<?php echo $pecah['id_user']; ?>"><?php echo $pecah['username']; ?></option>
                                            <?php $query=$dbconnect->query("SELECT * FROM users");
                                                while ($row = mysqli_fetch_assoc($query)){
                                            ?>
                                            <option value="<?php echo $row['id_user']; ?>"><?php echo $row['username']; ?></option>
                                            <?php } ?>
                                        </select>
                        </div>
                    </div>

                    <!-- dataupload input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Data Upload</label>
                        <div class="col-md-9">
                            <input id="date" name="date" type=date placeholder="yyyy-mm-dd" class="form-control" value="<?php echo $pecah['data_upload']; ?>">
                        </div>
                    </div>


                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" name="submit">Submit</button>
                            <button type="reset" name="reset" class="btn btn-danger btn-lg">Reset</button>
                        </div>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit']))
                    {
                        $nama_cover =$_FILES['image']['name'];
                        $lokasi_cover =$_FILES['image']['tmp_name'];
                        move_uploaded_file($lokasi_cover,"../cover_buku/".$nama_cover);

                        $nama_file =$_FILES['file']['name'];
                        $lokasi_file =$_FILES['file']['tmp_name'];
                        move_uploaded_file($lokasi_file,"../buku/".$nama_file);

                        $dbconnect->query("UPDATE buku SET id='$id', judul_buku='$_POST[judul]', kategori='$_POST[kategori]', penulis='$_POST[penulis]', jumlah_halaman='$_POST[jumlah]', synopsis='$_POST[synopsis]', cover='$nama_cover', file_buku='$nama_file', username='$_POST[username]', data_upload='$_POST[date]' WHERE id='$id'");
                        echo "<div class='alert alert-info'>Data Tersimpan</div>";
                        echo "<meta http-equiv='refresh' content='1;url=databuku.php'>";

                    }
                ?>
            </div>
        </div>
    </div>
</div>
 <script type="text/javascript">
            function PreviewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

                oFReader.onload = function(oFREvent) {
                    document.getElementById("uploadPreview").src = oFREvent.target.result;
                };
            };
        </script>
</body>

</html>