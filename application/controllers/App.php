<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {

    public function daftar_pesanan(){
        $data['title'] = 'Daftar Pesanan';
        $data['menu'] = "pesanan";
        $data['dropdown'] = "daftarPesanan";
        // $data['modal'] = ["modal_closing"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/daftar_pesanan_reload.js",
            // "modules/closing.js",
        ];

        $this->load->view("pages/app/daftar_pesanan", $data);
    }

    public function load_daftar_pesanan(){
        header('Content-Type: application/json');
        $output = $this->app->load_daftar_pesanan();
        echo $output;
    }

    public function pesanan_terbaru(){
        $data['title'] = 'Pesanan Terbaru';
        $data['menu'] = "pesanan";
        $data['dropdown'] = "pesananTerbaru";
        $data['modal'] = ["modal_pesanan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/pesanan_terbaru_reload.js",
            "modules/pesanan.js",
        ];

        $this->load->view("pages/app/pesanan_terbaru", $data);
    }

    public function load_pesanan_terbaru(){
        header('Content-Type: application/json');
        $output = $this->app->load_pesanan_terbaru();
        echo $output;
    }

    public function pesanan_terkirim(){
        $data = $this->app->pesanan_terkirim();
        echo json_encode($data);
    }

    public function list_komen(){
        $data = $this->app->list_komen();
        echo json_encode($data);
    }

    public function add_komen($status_stok = ""){
        $data = $this->app->add_komen($status_stok);
        echo json_encode($data);
    }

    public function stok_kosong(){
        $data['title'] = 'Stok Kosong';
        $data['menu'] = "pesanan";
        $data['dropdown'] = "stokKosong";
        $data['modal'] = ["modal_pesanan"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/stok_kosong_reload.js",
            "modules/pesanan.js",
        ];

        $this->load->view("pages/app/stok_kosong", $data);
    }

    public function load_stok_kosong(){
        header('Content-Type: application/json');
        $output = $this->app->load_stok_kosong();
        echo $output;
    }

    public function pesanan_belum_lunas(){
        $data['title'] = 'Pesanan Belum Lunas';
        $data['menu'] = "pesanan";
        $data['dropdown'] = "pesananBelumLunas";
        // $data['modal'] = ["modal_closing"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/pesanan_belum_lunas_reload.js",
            // "modules/closing.js",
        ];

        $this->load->view("pages/app/pesanan_belum_lunas", $data);
    }

    public function load_pesanan_belum_lunas(){
        header('Content-Type: application/json');
        $output = $this->app->load_pesanan_belum_lunas();
        echo $output;
    }

    public function pesanan_retur_cancel(){
        $data['title'] = 'Pesanan Retur Cancel';
        $data['menu'] = "pesanan";
        $data['dropdown'] = "pesananReturCancel";
        // $data['modal'] = ["modal_closing"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/pesanan_retur_cancel_reload.js",
            "modules/pesanan.js",
        ];

        $this->load->view("pages/app/pesanan_retur_cancel", $data);
    }

    public function load_pesanan_retur_cancel(){
        header('Content-Type: application/json');
        $output = $this->app->load_pesanan_retur_cancel();
        echo $output;
    }

    public function pesanan_retur_diterima(){
        $data = $this->app->pesanan_retur_diterima();
        echo json_encode($data);
    }

    public function pendapatan(){
        $data['id_gudang'] = $this->session->userdata("id_gudang");
        $data['title'] = 'List Pendapatan';
        $data['menu'] = "pendapatan";
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
        ];

        $data['pembayaran'] = $this->app->pembayaran();
        $data['pencairan'] = $this->app->get_all("pencairan_gudang", ["id_gudang" => $data['id_gudang']], "tgl_input", "DESC");

        // var_dump($data['pembayaran']['periode']);

        $this->load->view("pages/app/pembayaran", $data);
    }
}

/* End of file Produk.php */
