<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends MY_Model {

    public function load_daftar_pesanan(){
        $id_gudang = $this->session->userdata('id_gudang');
        $this->datatables->select('id_closing, FORMAT(tgl_input, "dd-MM-yy"), tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel');
        $this->datatables->from('closing');
        $this->datatables->where('id_gudang', $id_gudang);
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status", "<span class='badge' style='background-color: $2'>$1</span>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailClosing" data-bs-toggle="modal" href="#detailClosing" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Closing
                        </a>
                        <a class="dropdown-item komenClosing" data-bs-toggle="modal" href="#komenClosing" data-id="$1">
                            '.tablerIcon("message-circle", "me-1").'
                            Komen
                        </a>
                        <a class="dropdown-item komplainClosing" data-bs-toggle="modal" href="#komplainClosing" data-id="$1">
                            '.tablerIcon("alert-octagon", "me-1").'
                            Komplain
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing)');

        return $this->datatables->generate();
    }

    public function load_pesanan_terbaru(){
        $id_gudang = $this->session->userdata('id_gudang');
        $this->datatables->select('id_closing, FORMAT(tgl_input, "dd-MM-yy"), tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel');
        $this->datatables->from('closing');
        $this->datatables->where(['id_gudang' => $id_gudang, "status_stok" => "Belum Dikirim"]);
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status", "<span class='badge' style='background-color: $2'>$1</span>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item terkirim" data-id="$1" data-nama="$3">
                            '.tablerIcon("send", "me-1").'
                            Terkirim
                        </a>
                        <a href="#komenClosing" class="dropdown-item komenClosing" data-bs-toggle="modal" data-id="$1">
                            '.tablerIcon("x", "me-1").'
                            Stok Kosong
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing), nama_closing');

        return $this->datatables->generate();
    }

    public function pesanan_terkirim(){
        $id_closing = $this->input->post("id_closing");
        $status_stok = $this->input->post("status_stok");

        $data = [
            "status_stok" => $status_stok,
            "tgl_kirim" => date("Y-m-d")
        ];

        return $this->edit_data("closing", ["id_closing" => $id_closing], $data);
    }

    public function list_komen(){
        $id_closing = $this->input->post("id_closing");

        $komen = $this->get_all("komen_closing", ["id_closing" => $id_closing]);

        $data['komen'] = [];
        foreach ($komen as $i => $komen) {
            $data['komen'][$i] = $komen;
            $data['komen'][$i]['tgl_input'] = date("d-m-y h:i", strtotime($komen['tgl_input']));
        }

        $data['closing'] = $this->get_one("closing", ["id_closing" => $id_closing]);
        $data['closing']['produk_closing'] = produk_closing($data['closing']['id_closing']);

        return $data;
    }

    public function add_komen($status_stok){
        if($status_stok != ""){
            $id_closing = $this->input->post("id_closing");
            $komen = $this->input->post("komen");
            $id_gudang = $this->session->userdata('id_gudang');
            $nama_gudang = $this->session->userdata('nama_gudang');
            $table = "gudang";
    
            $data = [
                "id_closing" => $id_closing,
                "id_user" => $id_gudang,
                "nama_user" => $nama_gudang,
                "table_user" => $table,
                "komen" => $komen
            ];
    
            $this->edit_data("closing", ["id_closing" => $id_closing], ["status_stok" => "Stok Kosong"]);
            $query = $this->add_data("komen_closing", $data);
    
            if($query) return 1;
            else return 0;
        } else {
            $id_closing = $this->input->post("id_closing");
            $komen = $this->input->post("komen");
            $id_gudang = $this->session->userdata('id_gudang');
            $nama_gudang = $this->session->userdata('nama_gudang');
            $table = "gudang";
    
            $data = [
                "id_closing" => $id_closing,
                "id_user" => $id_gudang,
                "nama_user" => $nama_gudang,
                "table_user" => $table,
                "komen" => $komen
            ];
    
            $query = $this->add_data("komen_closing", $data);
    
            if($query) return 1;
            else return 0;
        }
    }

    public function load_stok_kosong(){
        $id_gudang = $this->session->userdata('id_gudang');
        $this->datatables->select('id_closing, FORMAT(tgl_input, "dd-MM-yy"), tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel');
        $this->datatables->from('closing');
        $this->datatables->where(['id_gudang' => $id_gudang, "status_stok" => "Stok Kosong"]);
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status", "<span class='badge' style='background-color: $2'>$1</span>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item terkirim" data-id="$1" data-nama="$3">
                            '.tablerIcon("send", "me-1").'
                            Terkirim
                        </a>
                        <a href="#komenClosing" class="dropdown-item komenClosing" data-bs-toggle="modal" data-id="$1">
                            '.tablerIcon("x", "me-1").'
                            Catatan
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing), nama_closing');

        return $this->datatables->generate();
    }

    public function load_pesanan_belum_lunas(){
        $id_gudang = $this->session->userdata('id_gudang');
        $this->datatables->select('id_closing, FORMAT(tgl_input, "dd-MM-yy"), tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel');
        $this->datatables->from('closing');
        $this->datatables->where(['id_gudang' => $id_gudang, "status_lunas" => "", "status" => "Delivered"]);
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status", "<span class='badge' style='background-color: $2'>$1</span>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");
        $this->datatables->add_column("nominal_produk", "$1", "nominal_produk(id_closing)");

        return $this->datatables->generate();
    }

    public function load_pesanan_retur_cancel(){
        $id_gudang = $this->session->userdata('id_gudang');
        $this->datatables->select('id_closing, FORMAT(tgl_input, "dd-MM-yy"), tgl_closing, catatan, jenis_closing, nama_closing, nominal_transaksi, nama_cs, nama_gudang, status, tgl_input, tgl_delivery, tgl_ubah_status, tgl_retur_cancel, status_retur');
        $this->datatables->from('closing');
        $this->datatables->where(['id_gudang' => $id_gudang]);
        $this->datatables->where("status = 'Canceled' OR status = 'Returned'");
        $this->db->order_by("tgl_closing", "desc");

        $this->datatables->edit_column("status_closing", "<span class='badge' style='background-color: $2'>$1</span>", "status, warna_status(status), id_closing");
        $this->datatables->add_column("stok", "$1", "stok_varian(id_closing)");
        $this->datatables->add_column("produk_closing", "$1", "produk_closing(id_closing)");
        $this->datatables->add_column("durasi", "$1", "durasi(tgl_input, tgl_closing, tgl_delivery, tgl_ubah_status, tgl_retur_cancel)");
        $this->datatables->add_column("status_input", "$1", "status_input(tgl_input, tgl_closing)");
        $this->datatables->add_column("status_delivered", "$1", "status_delivered(tgl_delivery, tgl_ubah_status)");

        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item barangTelahDiterima" data-id="$1" data-nama="$3">
                            '.tablerIcon("package", "me-1").'
                            Barang Telah Diterima
                        </a>
                    </div>
                    </span>', 'id_closing, md5(id_closing), nama_closing');

        return $this->datatables->generate();
    }

    public function pesanan_retur_diterima(){
        $id_closing = $this->input->post("id_closing");

        $data = [
            "status_stok" => "",
            "status_retur" => "Sudah Diterima"
        ];

        return $this->edit_data("closing", ["id_closing" => $id_closing], $data);
    }

}

/* End of file App_model.php */
