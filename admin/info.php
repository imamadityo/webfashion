<h3>Halaman Informasi </h3>
<hr class="style2">
<?= pesan($_GET['alert']) ?>
<?php
$query = $kon->query("SELECT * FROM info");
$data = mysqli_fetch_object($query);
?>
<div class="card shadow-lg">
    <div class="card-body">
        <form action="?p=aksi&form=info" method="post">
            <div class="mb-3">
                <textarea class="form-control" id="detail" name="info"><?= $data->info ?></textarea>
            </div>
            <center>
                <button type="submit" name="simpan" class="btn btn-primary">Update Info</button>
            </center>
        </form>
    </div>
</div>