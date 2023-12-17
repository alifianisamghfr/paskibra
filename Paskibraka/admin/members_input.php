<?php include("inc_header.php") ?>
<?php
$nama_lengkap      = "";
$email    = "";
$isi        = "";
$error      = "";
$sukses     = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1   = "select * from halaman where id = '$id'";
    $q1     = mysqli_query($koneksi,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $nama_lengkap  = $r1['nama_lengkap'];
    $email    = $r1['email'];
    $isi        = $r1['isi'];

    if($isi == ''){
        $error  = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_lengkap      = $_POST['nama_lengkap'];
    $isi        = $_POST['isi'];
    $email    = $_POST['email'];

    if ($nama_lengkap == '' or $isi == '') {
        $error     = "Silakan masukkan semua data yakni adalah data isi dan nama.";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1   = "update halaman set nama_lengkap = '$nama_lengkap',email='$email',isi='$isi',tgl_isi=now() where id = '$id'";
        }else{
            $sql1       = "insert into halaman(nama_lengkap,email,isi) values ('$nama_lengkap','$email','$isi')";
        }
        
        $q1         = mysqli_query($koneksi, $sql1);
        if ($q1) {
            $sukses     = "Sukses memasukkan data";
        } else {
            $error      = "Gagal masukkan data";
        }
    }
}


?>
<h1>Halaman Admin Input Data</h1>
<div class="mb-3 row">
    <a href="members.php">
        << Kembali ke halaman admin</a>
</div>
<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form action="" method="post">
    <div class="mb-3 row">
        <label for="nama_lengkap" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama_lengkap" value="<?php echo $nama_lengkap ?>" nama_lengkap="nama_lengkap">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" value="<?php echo $email ?>" name="email">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="isi" class="col-sm-2 col-form-label">Isi</label>
        <div class="col-sm-10">
            <textarea name="isi" class="form-control" id="summernote"><?php echo $isi ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("inc_footer.php") ?>