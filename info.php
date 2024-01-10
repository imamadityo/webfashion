<?php
$query = $kon->query(" SELECT * FROM info ");
$data = mysqli_fetch_object($query);
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Informasi Toko
                </div>
                <div class="card-body">
                    <?= $data->info ?>
                </div>
            </div>
        </div>
    </div>
</div>
<br>