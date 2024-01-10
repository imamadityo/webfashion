<?php

$ekspedisi_terpilih = $_POST["ekspedisi"];
$kota_terpilih = $_POST["kota"];
include "../include/function.php";
//$id_kota_terpilih = $_POST["id_kota"];
//$ekspedisi_terpilih = $_POST["ekspedisi"];
$curl = curl_init();
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=318&destination=".$kota_terpilih."&weight=1000&courier=".$ekspedisi_terpilih,
    //CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 15025a2d1d9b5f8174dc55f9964352f8"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$datakirim = json_decode($response, true);
$paket = $datakirim["rajaongkir"]["results"]["0"]["costs"];
?>
<option value="">--Pilih Jenis Pengiriman--</option>
<?php
foreach ($paket as $key => $data) {
?>
    <option jenis="<?= $data['service'] ?>"
            ongkir="<?=$data['cost']['0']['value']?>"
            etd="<?= $data['cost']['0']['etd'] ?>"
    ><?= $data['service'] ?> <?= formatRupiah($data['cost']['0']['value']) ?> (<?= $data['cost']['0']['etd']?> Hari)</option>
<?php } ?>