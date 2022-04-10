<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Other extends MY_Controller {

    public function cs(){
        $data['title'] = 'List CS';
        $data['menu'] = "Other";
        $data['dropdown'] = "listCs";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/cs_reload.js",
            "modules/cs.js",
        ];

        $this->load->view("pages/other/list_cs", $data);
    }

    public function add_cs(){
        $data = $this->other->add_cs();
        echo json_encode($data);
    }

    public function edit_cs(){
        $data = $this->other->edit_cs();
        echo json_encode($data);
    }
    
    public function get_cs(){
        $data = $this->other->get_cs();
        echo json_encode($data);
    }

    public function load_cs(){
        header('Content-Type: application/json');
        $output = $this->other->load_cs();
        echo $output;
    }

    public function gudang(){
        $data['title'] = 'List Gudang';
        $data['menu'] = "Other";
        $data['dropdown'] = "listGudang";
        $data['modal'] = ["modal_other"];
        $data['js'] = [
            "ajax.js",
            "function.js",
            "helper.js",
            "load_data/gudang_reload.js",
            "modules/gudang.js",
        ];

        $this->load->view("pages/other/list_gudang", $data);
    }

    public function add_gudang(){
        $data = $this->other->add_gudang();
        echo json_encode($data);
    }

    public function edit_gudang(){
        $data = $this->other->edit_gudang();
        echo json_encode($data);
    }
    
    public function get_gudang(){
        $data = $this->other->get_gudang();
        echo json_encode($data);
    }

    public function load_gudang(){
        header('Content-Type: application/json');
        $output = $this->other->load_gudang();
        echo $output;
    }
}

/* End of file Produk.php */
