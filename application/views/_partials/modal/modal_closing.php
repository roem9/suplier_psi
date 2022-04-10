<div class="modal modal-blur fade" id="statusClosing" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Status Closing</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="user" id="formStatusClosing">
                    <input type="hidden" name="id_closing" class="form">
                    <div class="form-floating mb-3">
                        <input type="text" name="nama_closing" class="form form-control form-control-sm required">
                        <label class="col-form-label">Nama Customer</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="status" class="form form-control form-control-sm required">
                            <option value="">Pilih Status</option>
                            <option value="Canceled">Canceled</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Produksi">Produksi</option>
                            <option value="Returned">Returned</option>
                            <option value="Shipping">Shipping</option>
                            <option value="Waiting">Waiting</option>
                        </select>
                        <label for="">Status</label>
                    </div>
                    <div class="form-floating mb-3" id="tgl_delivery">
                        <input type="date" name="tgl_delivery" class="form form-control form-control-sm">
                        <label class="col-form-label">Tgl. Delivery</label>
                    </div>
                    <div class="form-floating mb-3" id="tgl_retur_cancel">
                        <input type="date" name="tgl_retur_cancel" class="form form-control form-control-sm">
                        <label class="col-form-label">Tgl. Return / Tgl. Cancel</label>
                    </div>
                    <div class="form-floating mb-3" id="catatan">
                        <textarea name="catatan" class="form form-control" data-bs-toggle="autosize"></textarea>
                        <label for="" class="col-form-label">Catatan</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn me-3" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-success btnEdit">Edit</button>
                </div>
            </div>
        </div>
    </div>
</div>