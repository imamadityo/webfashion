<div class="container mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1 class="h3 mb-0 text-gray-800">Proses Check Out</h1>
            <hr style="border: 3px solid gray; border-radius: 5px;">
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="card mb-4 col-md-8 border-left-info shadow-lg">
            <div class="card-body">
                <form class="form-group" method="post" action="?p=selesaibelanjaaksi" enctype="multipart/form-data">
                    <input type="hidden" name="idag" class="form-control" value="<?= $idanggota; ?>" />

                    <div class="form-group mt-3">
                        <label class="mb-1">Email address</label>
                        <input name="email" type="text" class="form-control" value="<?= "$rag[email]"; ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Nama Pembeli</label>
                        <input name="nama" type="text" class="form-control" value="<?= "$rag[nama]"; ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Nomor Hp Pembeli</label>
                        <input name="nohp" type="text" class="form-control" value="<?= "$rag[nohp]"; ?>">
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Pilih Provinsi</label>
                        <select name="nama_provinsi" id="nama_provinsi" class="form-control">
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Pilih Kota/Kabupaten</label>
                        <select name="nama_kota" id="nama_kota" class="form-control">
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Pilih Ekspedisi</label>
                        <select name="nama_ekspedisi" id="nama_ekspedisi" class="form-control">

                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Pilih Jenis Paket</label>
                        <select name="jenis_ekspedisi" id="jenis_ekspedisi" class="form-control">

                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label class="mb-1">Alamat Pengirim</label>
                        <textarea name="alamatkirim" class="form-control" placeholder="Alamat Pengiriman"></textarea>
                    </div>

                    <input type="text" hidden name="prov">
                    <input type="text" hidden name="tipe">
                    <input type="text" hidden name="kota">
                    <input type="text" hidden name="kode">
                    <input type="text" hidden name="ekspedisi">
                    <input type="text" hidden name="paket">
                    <input type="text" hidden name="bayar">
                    <input type="text" hidden name="estimasi">

                    <div class="form-group mt-3">
                        <center>
                            <input type="submit" name="Submit" class="btn btn-primary btn-user" value="PROSES CHECKOUT">
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            type: 'post',
            url: 'rajaongkir/provinsi.php',
            success: function(hasil_provinsi) {
                $("select[name=nama_provinsi]").html(hasil_provinsi);
            }
        });

        $("select[name=nama_provinsi]").on("change", function() {
            //ambil id provinsi yang dipilih
            var id_provinsi_pilih = $("option:selected", this).attr("id_provinsi");
            $.ajax({
                type: 'post',
                url: 'rajaongkir/kota.php',
                data: 'id_provinsi=' + id_provinsi_pilih,
                success: function(hasil_kota) {
                    $("select[name=nama_kota]").html(hasil_kota);
                }
            })
        });

        $.ajax({
            type: 'post',
            url: 'rajaongkir/ekspedisi.php',
            success: function(hasil_ekspedisi) {
                $("select[name=nama_ekspedisi]").html(hasil_ekspedisi);
            }
        });

        $("select[name=nama_ekspedisi]").on("change", function() {
            //mendapatkan ekpedisi yang dipilih
            var ekspedisi_terpilih = $("select[name=nama_ekspedisi]").val();
            //mendapatkan idkota yang dilipih
            var kota_terpilih = $("option:selected", "select[name=nama_kota]").attr("id_kota");
            var nama_eks = $("option:selected", this).attr("nama_ek");

            //mendapatkan data ongkos kirim
            $.ajax({
                type: 'post',
                url: 'rajaongkir/pengiriman.php',
                data: 'ekspedisi=' + ekspedisi_terpilih + '&kota=' + kota_terpilih,
                success: function(hasil_paket) {
                    //console.log(hasil_paket);
                    $("select[name=jenis_ekspedisi]").html(hasil_paket);

                    //ekpesisi terpilih
                    $("input[name=ekspedisi]").val(nama_eks);
                }
            })
        });

        $("select[name=nama_kota]").on("change", function() {
            var prov = $("option:selected", this).attr("nama_provinsi");
            var tipe = $("option:selected", this).attr("type");
            var kota = $("option:selected", this).attr("nama_kota");
            var kode = $("option:selected", this).attr("kode_pos");

            $("input[name=prov]").val(prov);
            $("input[name=tipe]").val(tipe);
            $("input[name=kota]").val(kota);
            $("input[name=kode]").val(kode);
        });

        $("select[name=jenis_ekspedisi]").on("change", function() {
            var paket = $("option:selected", this).attr("jenis");
            var bayar = $("option:selected", this).attr("ongkir");
            var estimasi = $("option:selected", this).attr("etd");

            $("input[name=paket]").val(paket);
            $("input[name=bayar]").val(bayar);
            $("input[name=estimasi]").val(estimasi);
        });

    });
</script>