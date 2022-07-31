<?php $this->load->view("_partials/header")?>
    <div class="wrapper">
        <div class="sticky-top">
            <?php $this->load->view("_partials/navbar-header")?>
            <?php $this->load->view("_partials/navbar")?>
        </div>
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    
                    <div class="card shadow mb-4 overflow-auto">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                
                                <?php 
                                    $sisa_pembayaran = 0;
                                    if($pembayaran){
                                        foreach ($pembayaran['periode'] as $data_pembayaran){
                                            $sisa_pembayaran += ($data_pembayaran['pembayaran'] - $data_pembayaran['pencairan'] - $data_pembayaran['retur_cancel']);
                                        }
                                    }
                                ?>

                                <h3>Rekapan Pendapatan</h3>
                                <h3>Sisa <?= rupiah($sisa_pembayaran)?></h3>
                            </div>
                            <table id="dataTable" class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop" style="font-size: 11px">Periode</th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Total Pendapatan</center></th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Retur</center></th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Cair</center></th>
                                        <th class="text-dark desktop" style="font-size: 11px"><center>Sisa</center></th>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px"><center>Status</center></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($pembayaran) :?>
                                        <?php
                                            foreach ($pembayaran['periode'] as $pembayaran) :?>
                                            <tr>
                                                <td><?= $pembayaran['periode']?></td>
                                                <td>
                                                    <center>
                                                        <a class="dropdown-item detailPendapatan" data-bs-toggle="modal" href="#detailPendapatan" data-id="<?= $pembayaran['closing']['berhasil'];?>">
                                                            <?= rupiah($pembayaran['pembayaran'])?>
                                                        </a> 
                                                    </center>
                                                </td>
                                                <td class="text-danger">
                                                    <center>
                                                        <a class="dropdown-item detailRetur" data-bs-toggle="modal" href="#detailRetur" data-id="<?= $pembayaran['closing']['retur_cancel'];?>">
                                                            <?= rupiah($pembayaran['retur_cancel'])?>
                                                        </a> 
                                                    </center>
                                                </td>
                                                <td><center><?= rupiah($pembayaran['pencairan'])?></center></td>
                                                <td><center><?= rupiah($pembayaran['pembayaran'] - $pembayaran['pencairan'] - $pembayaran['retur_cancel'])?></center></td>
                                                <?php if($pembayaran['pencairan'] == 0) :?>
                                                    <td class="text-nowrap bg-danger text-light"><center>Belum Cair</center></td>
                                                <?php elseif($pembayaran['pembayaran'] - $pembayaran['pencairan'] - $pembayaran['retur_cancel'] == 0):?>
                                                    <td class="text-nowrap bg-success text-light"><center>Cair Seluruhnya</center></td>
                                                <?php elseif($pembayaran['pembayaran'] - $pembayaran['pencairan'] - $pembayaran['retur_cancel'] <= 0):?>
                                                    <td class="text-nowrap bg-secondary text-light"><center>Utang</center></td>
                                                <?php else :?>
                                                    <td class="text-nowrap bg-warning text-light"><center>Cair Sebagian</center></td>
                                                <?php endif;?>
                                            </tr>
                                            <?php endforeach;?>
                                    <?php endif;?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card shadow mb-4 overflow-auto">
                        <div class="card-body">
                            <h3>Riwayat Pencairan</h3>
                            <table id="dataTable" class="table card-table table-vcenter text-dark">
                                <thead>
                                    <tr>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px">Tgl Pencairan</th>
                                        <th class="text-dark desktop w-1 text-nowrap" style="font-size: 11px">Periode</th>
                                        <th class="text-dark desktop w-1" style="font-size: 11px">Nominal</th>
                                        <th class="text-dark desktop" style="font-size: 11px">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($pencairan) :?>
                                        <?php
                                            foreach ($pencairan as $pencairan) :?>
                                            <tr>
                                                <td><?= date("d M Y", strtotime($pencairan['tgl_pencairan']))?></td>
                                                <td class="text-nowrap"><?= periode($pencairan['periode'])?></td>
                                                <td class="text-nowrap"><?= rupiah($pencairan['nominal'])?></td>
                                                <td><?= $pencairan['catatan']?></td>
                                            </tr>
                                            <?php endforeach;?>
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

    <script>
        $(".detailPendapatan").click(function(){
            form = "#detailPendapatan";

            let data = $(this).data("id");

            $(form+" .detailPendapatan").html(data)
        })

        $(".detailRetur").click(function(){
            form = "#detailRetur";
            let data = $(this).data("id");

            $(form+" .detailRetur").html(data)
        })
    </script>

    
<?php $this->load->view("_partials/footer")?>