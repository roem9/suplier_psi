<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
        <div class="container-xl">
                <!-- Page title -->
                <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                    <h2 class="page-title">
                        <?= $title?>
                    </h2>
                    </div>
                </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <form id="formClosing">

                        <!-- <h5>List Varian</h5> -->
                        
                        <input type="hidden" name="id_closing" class="form" value="<?= $closing['id_closing']?>">
                        
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4><?= tablerIcon("user", "", 24)?> Data Customer</h4>
                                <div class="form-floating mb-3">
                                    <input type="date" name="tgl_closing" class="form form-control form-control-sm required" value="<?= $closing['tgl_closing']?>">
                                    <label class="col-form-label">Tgl. Closing</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nama_closing" class="form form-control form-control-sm required" value="<?= $closing['nama_closing']?>">
                                    <label class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="no_hp" class="form form-control form-control-sm required number" value="<?= $closing['no_hp']?>">
                                    <label class="col-form-label">No.WA</label>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h4><?= tablerIcon("shopping-cart", "", 24)?> Data Pesanan</h4>
                                <div class="form-floating mb-3">
                                    <textarea name="produk" class="form form-control required" data-bs-toggle="autosize" style="height: 100px"><?= $closing['produk']?></textarea>
                                    <label for="" class="col-form-label">Varian Produk</label>
                                </div>
                                <table class="table card-table table-vcenter text-dark">
                                    <thead>
                                        <tr>
                                            <th>Varian</th>
                                            <th style="width: 20%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody class="listOfClosing">
                                        <?php 
                                            $i = 1;
                                            foreach ($detail_closing as $detail) :?>
                                                <tr id="<?= $i?>">
                                                    <td>
                                                        <input type="hidden" name="id_varian" value="<?= $detail['id_varian']?>">
                                                        <a href="javascript:void(0)" class="hapusClosing text-danger" data-id="<?= $i?>" data-nama="<?= $detail['nama_varian']?>"><?= $detail['nama_varian']?></a> <br>
                                                    </td>
                                                    <td class="text-right">
                                                        <input type="number" name="qty" id="qty-<?= $i?>" class="form form-control form-control-md required number" value="<?= $detail['qty']?>" data-id="<?= $i?>" style="padding-left: 5px; padding-right: 5px">
                                                        <input type="hidden" name="harga" value="<?= $detail['harga']?>">
                                                    </td>
                                                </tr>
                                        <?php 
                                            $i++;
                                            endforeach;?>
                                    </tbody>
                                </table>

                                    <div class="form-floating mt-3">
                                        <input type="text" name="cari_varian" class="form-control form-control-sm">
                                        <label class="col-form-label">Input Varian</label>
                                    </div>

                                <?php $varian = list_varian();?>
                                <ul class="list-group mb-3" id="listOfClosing" style="display:none">
                                </ul>

                                <hr style="height:5px;border:none;color:black;background-color:black;"/>

                                <div class="form-floating mb-3">
                                    <input type="text" name="nominal_transaksi" class="form form-control form-control-sm required rupiah" value="<?= rupiah($closing['nominal_transaksi'])?>">
                                    <label class="col-form-label">Nominal Transaksi</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="nominal_produk" class="form form-control form-control-sm required rupiah" value="<?= rupiah($closing['nominal_produk'])?>">
                                    <label class="col-form-label">Nominal Produk</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="metode_pembayaran" class="form form-control form-control-sm required">
                                        <option <?= ($closing['metode_pembayaran'] == "") ? 'selected' : '';?> value="">Pilih Metode Pembayaran</option>
                                        <option <?= ($closing['metode_pembayaran'] == "transfer") ? 'selected' : '';?> value="transfer">Transfer</option>
                                        <option <?= ($closing['metode_pembayaran'] == "cod") ? 'selected' : '';?> value="cod">COD</option>
                                    </select>
                                    <label class="col-form-label">Pembayaran COD / Transfer</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="jenis_closing" class="form form-control form-control-sm required">
                                        <option <?= ($closing['jenis_closing'] == "") ? 'selected' : '';?> value="">Pilih Jenis Customer</option>
                                        <option <?= ($closing['jenis_closing'] == "New") ? 'selected' : '';?> value="New">New</option>
                                        <option <?= ($closing['jenis_closing'] == "RO") ? 'selected' : '';?> value="RO">RO</option>
                                        <option <?= ($closing['jenis_closing'] == "Relation") ? 'selected' : '';?> value="Relation">Relation</option>
                                        <option <?= ($closing['jenis_closing'] == "Cross Selling") ? 'selected' : '';?> value="Cross Selling">Cross Selling</option>
                                    </select>
                                    <label class="col-form-label">Jenis Customer</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="pengirim" class="form form-control form-control-sm required">
                                        <option <?= ($closing['pengirim'] == "") ? 'selected' : '';?> value="">Pilih Pengirim</option>
                                        <option <?= ($closing['pengirim'] == "Mengantar") ? 'selected' : '';?> value="Mengantar">Mengantar</option>
                                        <option <?= ($closing['pengirim'] == "Marketplace") ? 'selected' : '';?> value="Marketplace">Marketplace</option>
                                        <option <?= ($closing['pengirim'] == "Yubi") ? 'selected' : '';?> value="Yubi">Yubi</option>
                                    </select>
                                    <label class="col-form-label">Dikirim Menggunakan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="nama_gudang" class="form form-control form-control-sm required">
                                        <option <?= ($closing['nama_gudang'] == "") ? 'selected' : '';?> value="">Pilih Gudang</option>
                                        <?php $gudang = list_gudang();?>
                                        <?php foreach ($gudang as $gudang) :?>
                                            <option <?= ($closing['nama_gudang'] == $gudang['nama_gudang']) ? 'selected' : '';?> value="<?= $gudang['nama_gudang']?>"><?= $gudang['nama_gudang']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Pilih Gudang</label>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h4><?= tablerIcon("map-pin", "", 24)?> Data Alamat</h4>
                                <div class="form-floating mb-3">
                                    <textarea name="nama_jalan" class="form form-control required" data-bs-toggle="autosize"><?= $closing['nama_jalan']?></textarea>
                                    <label for="" class="col-form-label">Nama Jalan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="rt_rw" class="form form-control" data-bs-toggle="autosize"><?= $closing['rt_rw']?></textarea>
                                    <label for="" class="col-form-label">RT/RW</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kelurahan" class="form form-control required" data-bs-toggle="autosize"><?= $closing['kelurahan']?></textarea>
                                    <label for="" class="col-form-label">Kelurahan/Desa</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kecamatan" class="form form-control required" data-bs-toggle="autosize"><?= $closing['kecamatan']?></textarea>
                                    <label for="" class="col-form-label">Kecamatan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="kota_kabupaten" class="form form-control required" data-bs-toggle="autosize" readonly><?= $closing['kota_kabupaten']?></textarea>
                                    <label for="" class="col-form-label">Kota/Kabupaten</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="provinsi" class="form form-control required" data-bs-toggle="autosize" readonly><?= $closing['provinsi']?></textarea>
                                    <label for="" class="col-form-label">Provinsi</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" name="kode_pos" class="form form-control form-control-sm number" readonly value="<?= $closing['kode_pos']?>">
                                    <label class="col-form-label">Kode Pos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="rekomendasi_kode_pos" id="kode_pos" class="form form-control form-control-sm">
                                    </select>
                                    <label class="col-form-label">Rekomendasi Kode Pos</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="patokan_rumah" class="form form-control" data-bs-toggle="autosize"><?= $closing['patokan_rumah']?></textarea>
                                    <label for="" class="col-form-label">Patokan Rumah</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea name="catatan" class="form form-control" data-bs-toggle="autosize"><?= $closing['catatan']?></textarea>
                                    <label for="" class="col-form-label">Catatan</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="nama_cs" class="form form-control form-control-sm required">
                                        <option <?= ($closing['nama_cs'] == "") ? 'selected' : '';?> value="">Pilih CS</option>
                                        <?php $cs = list_cs();?>
                                        <?php foreach ($cs as $cs) :?>
                                            <option <?= ($closing['nama_cs'] == $cs['nama_cs']) ? 'selected' : '';?> value="<?= $cs['nama_cs']?>"><?= $cs['nama_cs']?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <label class="col-form-label">Nama CS</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mb-3">
                            <a href="javascript:void(0)" class="btn btn-md btn-success" id="btnEdit">
                                <?= tablerIcon("device-floppy", "me-1")?>
                                Simpan Perubahan
                            </a>
                        </div>
                    </form>
                    
                </div>
            </div>
            <?php $this->load->view("_partials/footer-bar")?>
        </div>
    </div>

    <!-- load modal -->
    <?php 
        if(isset($modal)) :
            foreach ($modal as $i => $modal) {
                $this->load->view("_partials/modal/".$modal);
            }
        endif;
    ?>

    <script>
        $("#<?= $menu?>").addClass("active")
        let urut = <?= COUNT($detail_closing);?>;
        let index = <?= COUNT($detail_closing);?>;
    </script>

    <!-- load javascript -->
    <?php  
        if(isset($js)) :
            foreach ($js as $i => $js) :?>
                <script src="<?= base_url()?>assets/myjs/<?= $js?>"></script>
                <?php 
            endforeach;
        endif;    
    ?>

    <script>
        $( document ).ready(function() {
            let kelurahan = $("[name='kelurahan']").val();
            let kecamatan = $("[name='kecamatan']").val();

            let choice = `<option value="">Pilih Rekomendasi Kode Pos</option>`;
            result = ajax(url_base+"closing/get_rekomendasi_kode_pos", "POST", {kelurahan:kelurahan, kecamatan:kecamatan});
            result.forEach(data => {
                choice += `<option value="`+data.provinsi+`|`+data.kota_kabupaten+`|`+data.kecamatan+`|`+data.kelurahan+`|`+data.kode_pos+`" selected>`+data.kecamatan+` `+data.kelurahan+` `+data.kode_pos+`</option>`
            });

            $("#kode_pos").html(choice)
        });
    </script>

<?php $this->load->view("_partials/footer")?>
