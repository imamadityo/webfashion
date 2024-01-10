<?php
$id_provinsi_terpilih = $_POST["id_provinsi"];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $id_provinsi_terpilih,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key: 15025a2d1d9b5f8174dc55f9964352f8"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$datakota = json_decode($response, true);
$kota = $datakota["rajaongkir"]["results"];
?>
<option value="">--Pilih Kota/Kabupaten--</option>
<?php
foreach ($kota as $key => $data) {
?>
    <option value="<?= $data['city_id'] ?>" 
            id_kota="<?= $data['city_id'] ?>" 
            id_provinsi="<?= $data['province_id'] ?>"
            nama_provinsi="<?= $data['province'] ?>"
            type="<?= $data['type'] ?>"
            nama_kota="<?= $data['city_name'] ?>"
            kode_pos="<?= $data['postal_code'] ?>"
            ><?= $data['type'] ?> <?= $data['city_name'] ?></option>
<?php } ?>