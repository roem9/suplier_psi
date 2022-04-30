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
                            
                            <form action="<?= base_url()?>app/change_periode" method="post">
                                <div class="row row-cols-auto mt-3">
                                    <div class="col">
                                        <select name="periode_bulan" class="form form-select" required>
                                            <option value="">Bulan</option>
                                            <option value="01" <?php if(date("m", strtotime($setting_cs['periode'])) == 1) echo "selected";?>>Januari</option>
                                            <option value="02" <?php if(date("m", strtotime($setting_cs['periode'])) == 2) echo "selected";?>>Februari</option>
                                            <option value="03" <?php if(date("m", strtotime($setting_cs['periode'])) == 3) echo "selected";?>>Maret</option>
                                            <option value="04" <?php if(date("m", strtotime($setting_cs['periode'])) == 4) echo "selected";?>>April</option>
                                            <option value="05" <?php if(date("m", strtotime($setting_cs['periode'])) == 5) echo "selected";?>>Mei</option>
                                            <option value="06" <?php if(date("m", strtotime($setting_cs['periode'])) == 6) echo "selected";?>>Juni</option>
                                            <option value="07" <?php if(date("m", strtotime($setting_cs['periode'])) == 7) echo "selected";?>>Juli</option>
                                            <option value="08" <?php if(date("m", strtotime($setting_cs['periode'])) == 8) echo "selected";?>>Agustus</option>
                                            <option value="09" <?php if(date("m", strtotime($setting_cs['periode'])) == 9) echo "selected";?>>September</option>
                                            <option value="10" <?php if(date("m", strtotime($setting_cs['periode'])) == 10) echo "selected";?>>Oktober</option>
                                            <option value="11" <?php if(date("m", strtotime($setting_cs['periode'])) == 11) echo "selected";?>>November</option>
                                            <option value="12" <?php if(date("m", strtotime($setting_cs['periode'])) == 12) echo "selected";?>>Desember</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select name="periode_tahun" class="form form-select" required>
                                            <option value="">Tahun</option>
                                            <?php
                                                $year = date("Y");
    
                                                for ($i=2022; $i < $year+1; $i++) :?>
                                                    <option value="<?= $i?>" <?php if(date("Y", strtotime($setting_cs['periode'])) == $i) echo "selected";?>><?= $i?></option>
                                            <?php endfor;?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn-md btn-success">Go</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <table id="dataTable" class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop mobile-l mobile-p tablet-l tablet-p" style="font-size: 11px">Key Performance Indicator (KPI)</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Target</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Keterangan</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Pencapaian</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($kpi) :?>
                                        <tr>
                                            <td>1. Jumlah Kustomer Yang Dilayani</td>
                                            <td><center><?= $kpi['leads']?></center></td>
                                            <td><center>Minimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $leads = leads($setting_cs);
                                                    echo $leads;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($leads, $kpi['leads'], "Minimal")?>
                                        </tr>
                                        <tr>
                                            <td>2. Jumlah Penjualan Yang Dilakukan</td>
                                            <td><center><?= $kpi['closing']?></center></td>
                                            <td><center>Minimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $closing = closing($setting_cs);
                                                    echo $closing;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($closing, $kpi['closing'], "Minimal")?>
                                        </tr>
                                        <tr>
                                            <td>3. Persentase Paket Sukses</td>
                                            <td><center><?= $kpi['delivered_closing']?>%</center></td>
                                            <td><center>Minimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $delivered_closing = delivered_closing($setting_cs);
                                                    echo $delivered_closing . "%";
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($delivered_closing, $kpi['delivered_closing'], "Minimal")?>
                                        </tr>
                                        <tr>
                                            <td>4. Jumlah Kustomer Retensi (RO,dll)</td>
                                            <td><center><?= $kpi['customer_retensi']?></center></td>
                                            <td><center>Minimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $customer_retensi = customer_retensi($setting_cs);
                                                    echo $customer_retensi;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($customer_retensi, $kpi['customer_retensi'], "Minimal")?>
                                        </tr>
                                        <tr>
                                            <td>5. Jumlah Kustomer Referal</td>
                                            <td><center><?= $kpi['referal']?></center></td>
                                            <td><center>Minimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $referal = referal($setting_cs);
                                                    echo $referal;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($referal, $kpi['referal'], "Minimal")?>
                                        </tr>
                                        <tr>
                                            <td>6. Jumlah Kesalahan Data</td>
                                            <td><center><?= $kpi['kesalahan_data']?></center></td>
                                            <td><center>Maksimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $kesalahan_data = kesalahan_data($setting_cs);
                                                    echo $kesalahan_data;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($kesalahan_data, $kpi['kesalahan_data'], "Maksimal")?>
                                        </tr>
                                        <tr>
                                            <td>7. Jumlah Pelanggan Komplain</td>
                                            <td><center><?= $kpi['komplain']?></center></td>
                                            <td><center>Maksimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $komplain = komplain($setting_cs);
                                                    echo $komplain;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($komplain, $kpi['komplain'], "Maksimal")?>
                                        </tr>
                                        <tr>
                                            <td>8. Jumlah Rapel Laporan CS</td>
                                            <td><center><?= $kpi['rapel_laporan']?></center></td>
                                            <td><center>Maksimal</center></td>
                                            <td><center>
                                                <?php 
                                                    $rapel_laporan = rapel_laporan($setting_cs);
                                                    echo $rapel_laporan;
                                                ?>
                                            </center></td>
                                            <?= minimal_maksimal($rapel_laporan, $kpi['rapel_laporan'], "Maksimal")?>
                                        </tr>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    
<?php $this->load->view("_partials/footer")?>