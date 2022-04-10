<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Other_model extends MY_Model {

    public function add_cs(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("cs", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_cs(){
        $id_cs = $this->input->post("id_cs");
        unset($_POST['id_cs']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("cs", ["id_cs" => $id_cs], $data);

        // edit data closing 
        $this->edit_data("closing", ["id_cs" => $id_cs], ["nama_cs" => $data['nama_cs']]);

        if($query) return 1;
        else return 0;
    }

    public function get_cs(){
        $id_cs = $this->input->post("id_cs");
        $data = $this->get_one("cs", ["id_cs" => $id_cs]);
        return $data;
    }

    public function load_cs(){
        $this->datatables->select('id_cs, nama_cs');
        $this->datatables->from('cs');
        // $this->datatables->where("hapus", "0");
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailCs" data-bs-toggle="modal" href="#detailCs" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail CS
                        </a>
                    </div>
                    </span>', 'id_cs');

        return $this->datatables->generate();
    }

    public function add_gudang(){
        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->add_data("gudang", $data);
        if($query) return 1;
        else return 0;
    }

    public function edit_gudang(){
        $id_gudang = $this->input->post("id_gudang");
        unset($_POST['id_gudang']);

        $data = [];
        foreach ($_POST as $key => $value) {
            $data[$key] = $this->input->post($key);
        }

        $query = $this->edit_data("gudang", ["id_gudang" => $id_gudang], $data);

        // edit data closing 
        $this->edit_data("closing", ["id_gudang" => $id_gudang], ["nama_gudang" => $data['nama_gudang']]);

        if($query) return 1;
        else return 0;
    }

    public function get_gudang(){
        $id_gudang = $this->input->post("id_gudang");
        $data = $this->get_one("gudang", ["id_gudang" => $id_gudang]);
        return $data;
    }

    public function load_gudang(){
        $this->datatables->select('id_gudang, nama_gudang');
        $this->datatables->from('gudang');
        // $this->datatables->where("hapus", "0");
        $this->datatables->add_column('menu','
                    <span class="dropdown">
                    <button class="btn align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">
                        '.tablerIcon("settings", "").'
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item detailGudang" data-bs-toggle="modal" href="#detailGudang" data-id="$1">
                            '.tablerIcon("info-circle", "me-1").'
                            Detail Gudang
                        </a>
                    </div>
                    </span>', 'id_gudang');

        return $this->datatables->generate();
    }
}

/* End of file Artikel_model.php */
