<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
        <div class="container-xl">
            <ul class="navbar-nav">

                <li class="nav-item dropdown" id="pesanan">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-report-analytics" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Pesanan
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" id="daftarPesanan" href="<?= base_url()?>app/daftar_pesanan" >
                            Daftar Pesanan
                        </a>
                        <a class="dropdown-item" id="pesananTerbaru" href="<?= base_url()?>app/pesanan_terbaru" >
                            Pesanan Terbaru
                        </a>
                        <a class="dropdown-item" id="stokKosong" href="<?= base_url()?>app/stok_kosong" >
                            Stok Kosong
                        </a>
                        <!-- <a class="dropdown-item" id="pesananBelumLunas" href="<?= base_url()?>app/pesanan_belum_lunas" > -->
                        <a class="dropdown-item" id="pesananBerhasil" href="<?= base_url()?>app/pesanan_berhasil" >
                            <!-- Pesanan Belum Lunas -->
                            Pesanan Berhasil
                        </a>
                        <a class="dropdown-item" id="pesananReturCancel" href="<?= base_url()?>app/pesanan_retur_cancel" >
                            Pesanan Retur/Cancel
                        </a>
                    </div>
                </li>

                <li class="nav-item" id="pendapatan">
                    <a class="nav-link btnLoading" href="<?= base_url()?>app/pendapatan" role="button" aria-expanded="false" >
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <svg width="24" height="24" class="me-3">
                                <use xlink:href="<?= base_url()?>assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-coin" />
                            </svg> 
                        </span>
                        <span class="nav-link-title">
                            Pendapatan
                        </span>
                    </a>
                </li>

            </ul>
        </div>
        </div>
    </div>
</div>