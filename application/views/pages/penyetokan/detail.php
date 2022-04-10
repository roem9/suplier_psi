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
                        <h2 class="page-title text-nowrap">
                            <?= $title?>
                        </h2>
                    </div>
                </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    <form id="formPenyetokan">
                        <!-- <h5>List Varian</h5> -->
                        <div class="card mb-3">
                            <div class="card-body">
                                <table class="table card-table table-vcenter text-dark">
                                    <thead>
                                        <tr>
                                            <th class="w-1">No</th>
                                            <th>Varian</th>
                                            <th style="width : 30%">QTY</th>
                                        </tr>
                                    </thead>
                                    <tbody class="listOfVarian">
                                        <?php 
                                            $i = 1;
                                            foreach ($detail_penyetokan as $detail) :?>
                                            <tr id="<?= $i?>">
                                                <td>
                                                    <input type="hidden" name="id_varian" value="<?= $detail['id_varian']?>">
                                                    <span class="urut"><?= $i?></span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)" class="hapusVarian text-danger" data-id="<?= $i?>" data-nama="<?= $detail['nama_varian']?>"><?= $detail['nama_varian']?></a>
                                                </td>
                                                <td class="text-right">
                                                    <input type="number" name="qty" class="form form-control form-control-md required" value="<?= $detail['qty']?>">
                                                </td>
                                            </tr>
                                        <?php 
                                            $i++;
                                            endforeach;?>
                                    </tbody>
                                </table>
                                
                                <div class="form-floating mt-3">
                                    <input type="text" name="cari_varian" class="form-control form-control-sm">
                                    <label class="col-form-label">Input Varian Produk</label>
                                </div>

                                <?php $varian = list_varian();?>
                                <ul class="list-group" id="listOfVarian" style="display:none">
                                </ul>
                            </div>
                        </div>

                        <input type="hidden" name="id_penyetokan" value="<?= $penyetokan['id_penyetokan']?>" class="form">
                        <div class="form-floating mb-3">
                            <input type="datetime-local" name="tgl_penyetokan" class="form form-control form-control-sm required" style="background-color: white" value="<?= date("Y-m-d\TH:i", strtotime($penyetokan['tgl_penyetokan']));?>" <?= ($this->session->userdata("level") == "Super Admin") ? "" : "readonly"?>>
                            <label class="col-form-label">Tgl. Penyetokan</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea name="keterangan" class="form form-control form-control-sm required" data-bs-toggle="autosize"><?= $penyetokan['keterangan']?></textarea>
                            <label class="col-form-label">Keterangan</label>
                        </div>
                        
                        <?php if($this->session->userdata("level") == "Super Admin") :?>
                            <div class="d-grid gap-2 mb-3">
                                <a href="javascript:void(0)" class="btn btn-md btn-primary" id="btnEdit">
                                    <?= tablerIcon("device-floppy", "me-1")?>
                                    Simpan Perubahan
                                </a>
                            </div>
                        <?php endif;?>
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
        let urut = <?= COUNT($detail_penyetokan);?>
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
