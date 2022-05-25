<div class="modal modal-blur fade" id="komenClosing" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stok Kosong</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id_closing" class="form">
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>Data Closing</h3>
                        <p>Customer : <span id="nama_closing"></span></p>
                        <p>Pesanan Customer : <span id="produk_closing"></span></p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3>Komen</h3>
                        <div id="list_komen"></div>
                    </div>
                </div>

                <div class="form-floating mb-3 mt-3">
                    <textarea name="komen" class="form form-control required" data-bs-toggle="autosize"></textarea>
                    <label for="" class="col-form-label">Teks Komen</label>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success w-100" id="btnKirimKomen">Kirim</button>
                </div>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>