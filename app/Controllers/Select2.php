<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Select2 extends BaseController {

    public function moduli(){
        $request = service('request');
        $db      = \Config\Database::connect();
        $builder = $db->table('authorizations');

        if (!empty($this->request->getVar("q"))) {
            $builder->like('modulo', $request->getVar("q"));
        }

        if (!empty($request->getVar("dataDefault")) && strlen($request->getVar("dataDefault")) > 0) {
            $builder->where('modulo', $request->getVar("dataDefault"));
        }

        $builder->select('modulo AS id, modulo AS text')->groupBy('modulo');
        $rows = $builder->get(10)->getResult('array');

        $return = [];
        if ($rows) {
            foreach ($rows as $row) {
                $return[] = [
                    'id' => $row['id'],
                    'text' => strtoupper($row['text'])
                ];
            }
        } elseif ($request->getVar("addNew") == 'true') {
            $return[] = [
                'id' => $request->getVar("q"),
                'text' => $request->getVar("q")
            ];
        }

        echo json_encode($return);
    }

    public function oggetto(){
        $request = service('request');
        $db      = \Config\Database::connect();
        $builder = $db->table('authorizations');

        if (!empty($this->request->getVar("q"))) {
            $builder->like('oggetto', $request->getVar("q"));
        }

        if (!empty($request->getVar("dataDefault")) && strlen($request->getVar("dataDefault")) > 0) {
            $builder->where('oggetto', $request->getVar("dataDefault"));
        }

        $builder->select(' oggetto AS id, oggetto AS text');
        $rows = $builder->get(10)->getResult('array');

        $return = [];
        if ($rows) {
            foreach ($rows as $row) {
                $return[] = [
                    'id' => $row['id'],
                    'text' => strtoupper($row['text'])
                ];
            }
        } elseif ($request->getVar("addNew") == 'true') {
            $return[] = [
                'id' => $request->getVar("q"),
                'text' => $request->getVar("q")
            ];
        }

        echo json_encode($return);
    }

    public function get_permessi_member() {

        $this->load->database();
        if (!empty($this->input->get("q"))) {
            $this->db->like("concat(cognome,' ', nome)", $this->input->get("q"));
        }
        
        if (!empty($this->input->get("dataDefault")) && strlen($this->input->get("dataDefault")) > 0) {
            $this->db->where('id', $this->input->get("dataDefault"));
        }

        $query = $this->db->select("id,concat(cognome,' ', nome) as text, permessi")
                ->limit(10)
                ->get("members");
        $rows = $query->result();

        if ($rows) {
            foreach ($rows as $row) {
                $return[] = [
                    'id' => $row->id,
                    'text' => strtoupper($row->text),
                    'permessi' => $row->text,
                ];
            }
        } elseif ($this->input->get("addNew") == 'true') {
            $return[] = [
                'id' => 'new',
                'text' => $this->input->get("q")
            ];
        }
        
        echo json_encode($return);
    }

    public function members(){
        $request = service('request');
        $db      = \Config\Database::connect();
        $builder = $db->table('members');

        if (!empty($this->request->getVar("q"))) {
            $builder->like("concat(cognome,' ', nome)", $request->getVar("q"));
        }

        if (!empty($request->getVar("dataDefault")) && strlen($request->getVar("dataDefault")) > 0) {
            $builder->where("concat(cognome,' ', nome)", $request->getVar("dataDefault"));
        }

        $builder->select("id,concat(cognome,' ', nome) as text");
        $rows = $builder->get(10)->getResult('array');

        $return = [];
        if ($rows) {
            foreach ($rows as $row) {
                $return[] = [
                    'id' => $row['id'],
                    'text' => strtoupper($row['text'])
                ];
            }
        } elseif ($request->getVar("addNew") == 'true') {
            $return[] = [
                'id' => $request->getVar("q"),
                'text' => $request->getVar("q")
            ];
        }

        echo json_encode($return);
    }

    public function ruoli() {
        $request = service('request');
        $db      = \Config\Database::connect();
        $builder = $db->table('members');

        if (!empty($this->request->getVar("q"))) {
            $builder->like('ruolo', $request->getVar("q"));
        }

        if (!empty($request->getVar("dataDefault")) && strlen($request->getVar("dataDefault")) > 0) {
            $builder->where('ruolo', $request->getVar("dataDefault"));
        }

        $builder->select('ruolo AS id, ruolo AS text')->groupBy('ruolo');
        $rows = $builder->get(10)->getResult('array');

        $return = [];
        if ($rows) {
            foreach ($rows as $row) {
                $return[] = [
                    'id' => $row['id'],
                    'text' => strtoupper($row['text'])
                ];
            }
        } elseif ($request->getVar("addNew") == 'true') {
            $return[] = [
                'id' => $request->getVar("q"),
                'text' => $request->getVar("q")
            ];
        }

        echo json_encode($return);
    }

}
