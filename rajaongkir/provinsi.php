<?php
//Get Data Provinsi
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "key:15025a2d1d9b5f8174dc55f9964352f8"
    ),
));
$response = curl_exec($curl);
$err = curl_error($curl);
$dataprovinsi = json_decode($response, true);
$provinsi = $dataprovinsi["rajaongkir"]["results"];
?>
<option value="">--Pilih Provinsi--</option>
<?php
foreach ($provinsi as $key => $data) {
?>
    <option value="<?= $data['province'] ?>" 
            id_provinsi="<?= $data['province_id'] ?>"
            nama_provinsi="<?= $data['province'] ?>" ><?= $data['province'] ?></option>
<?php } ?>