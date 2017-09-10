<?php
session_start();
include "../config.php";
?>
    <html>

    <head>
        <title>Tambah Buku</title>
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/tambah.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="well well-sm">
                        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
                            <legend class="text-center">Tambah Buku</legend>
                            <!-- judul input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="judul">Judul</label>
                                <div class="col-md-9">
                                    <input id="judul_buku" name="judul" type="text" placeholder="Judul Buku" class="form-control">
                                </div>
                            </div>

                            <!-- kategori input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="kategori">Kategori</label>
                                <div class="col-md-9">
                                    <select name="kategori" id="kategori">
                                            <option value="">Pilih Kategori</option>
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
                                    <input id="penulis" name="penulis" type="text" placeholder="Penulis" class="form-control">
                                </div>
                            </div>

                            <!-- jumlah input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="jumlah">Jumlah Halaman</label>
                                <div class="col-md-9">
                                    <input id="jumlah" name="jumlah" type="jumlah" placeholder="Jumlah Halaman " class="form-control">
                                </div>
                            </div>

                            <!-- Message body -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="synopsis">Synopsis</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="synopsis" name="synopsis" placeholder="Please enter your message here..." rows="5"></textarea>
                                </div>
                            </div>

                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-3 contol-label" for="image">Cover Buku</label>
                                <div class="col-md-9">
                                    <img id="uploadPreview" style="width: 150px; height: 150px;" /><br>
                                    <input id="uploadImage" type="file" name="image" onchange="PreviewImage();" />
                                </div>
                            </div>

                            <!-- File Button -->
                            <div class="form-group">
                                <label class="col-md-3 contol-label" for="file">File Buku</label>
                                <div class="col-md-9">
                                    <input id="uploadImage" type="file" name="file" />
                                </div>
                            </div>

                            <!-- username input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="email">Username</label>
                                <div class="col-md-9">
                                    <select name="username" id="username">
                                            <option value="">Pilih Username</option>
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
                                    <input id="date" name="date" type=date placeholder="yyyy-mm-dd" class="form-control">
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
    
    $dbconnect->query("INSERT INTO buku (judul_buku,kategori,penulis,jumlah_halaman,synopsis,cover,file_buku,username,data_upload) VALUES('$_POST[judul]','$_POST[kategori]','$_POST[penulis]','$_POST[jumlah]','$_POST[synopsis]','$nama_cover','$nama_file','$_POST[username]','$_POST[date]')");
        
    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    
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