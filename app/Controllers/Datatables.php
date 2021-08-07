<?php

namespace App\Controllers;

class Datatables extends BaseController {

    public function __construct() {

        require_once APPPATH . 'ThirdParty/ssp.class.php';
        $this->db = db_connect();
    }

    private function datatables_details() {
        return array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname,
            'dns' => 'charset=utf8'
        );
    }

    public function members() {
        $table = 'members';

        $primaryKey = 'id';

        $columns = array(
            array('db' => 'id', 'dt' => 0, 'field' => 'id'),
            array('db' => 'email', 'dt' => 2, 'field' => 'email'),
            array('db' => 'nome', 'dt' => 5, 'field' => 'nome'),
            array('db' => 'cognome', 'dt' => 6, 'field' => 'cognome'),
            array('db' => 'foto_profilo', 'dt' => 7, 'field' => 'foto_profilo'),
            array('db' => 'tel_casa', 'dt' => 8, 'field' => 'tel_casa'),
            array('db' => 'tel_ufficio', 'dt' => 9, 'field' => 'tel_ufficio'),
            array('db' => 'cell', 'dt' => 10, 'field' => 'cell'),
            array('db' => 'qualifica', 'dt' => 11, 'field' => 'qualifica'),
            array('db' => 'classe', 'dt' => 12, 'field' => 'classe'),
            array('db' => 'settore', 'dt' => 13, 'field' => 'settore'),
            array('db' => 'reparto', 'dt' => 14, 'field' => 'reparto'),
            array('db' => 'area', 'dt' => 15, 'field' => 'area'),
            array('db' => 'livello', 'dt' => 16, 'field' => 'livello'),
            array('db' => 'ruolo', 'dt' => 17, 'field' => 'ruolo'),
            array('db' => 'mansioni', 'dt' => 18, 'field' => 'mansioni'),
            array('db' => 'responsabilita', 'dt' => 19, 'field' => 'responsabilita'),
            array('db' => 'funzioni', 'dt' => 20, 'field' => 'funzioni'),
            array('db' => 'rapporto', 'dt' => 21, 'field' => 'rapporto'),
            array('db' => 'ufficio', 'dt' => 22, 'field' => 'ufficio'),
            array('db' => 'divisione', 'dt' => 23, 'field' => 'divisione'),
            array('db' => 'progetto', 'dt' => 24, 'field' => 'progetto'),
            array('db' => 'note', 'dt' => 25, 'field' => 'note'),
            array('db' => 'attivo', 'dt' => 26, 'field' => 'attivo'),
            array('db' => 'sezione', 'dt' => 27, 'field' => 'sezione'),
            array('db' => 'natoA', 'dt' => 28, 'field' => 'natoA'),
            array('db' => 'natoIl', 'dt' => 29, 'field' => 'natoIl'),
            array('db' => 'deleted_at', 'dt' => 30, 'field' => 'deleted_at'),
            array('db' => 'created_at', 'dt' => 31, 'field' => 'created_at'),
            array('db' => 'updated_at', 'dt' => 32, 'field' => 'updated_at'),
            array(
                'db' => 'cognome',
                'dt' => 33,
                'field' => 'cognome',
                'formatter' => function($d, $row) {
                    $str = strtoupper($d . ' ' . $row['nome']);
                    return $str;
                }
            ),
            array(
                'db' => 'sezione',
                'dt' => 34,
                'field' => 'sezione',
                'formatter' => function($d, $row) {
                    return strtoupper($d);
                }
            ),
            array(
                'db' => 'sezione',
                'dt' => 35,
                'field' => 'sezione',
                'formatter' => function($d, $row) {
                    $str = '<a href="'.base_url('members/member/'.base64_encode($row['id'])).'" class="btn btn-info btn-xs tip" data-original-title="Impostazioni utente"><i class="fa fa-cog"></i></a>';
                    return $str;
                }
            ),
        );

        $sql_details = $this->datatables_details();

        $joinQuery = " FROM `{$table}` ";

        $extraWhere = " 1 ";

        $groupBy = '';

        echo json_encode(\SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy));
    }

    public function authorizations() {
        $request = service('request');
        $table = 'authorizations';

        $primaryKey = 'id';

        $columns = array(
            array('db' => 'id', 'dt' => 0, 'field' => 'id'),
            array('db' => 'modulo', 'dt' => 1, 'field' => 'modulo'),
            array('db' => 'oggetto', 'dt' => 2, 'field' => 'oggetto'),
            array('db' => 'descrizione', 'dt' => 3, 'field' => 'descrizione'),
            array(
                'db' => 'id',
                'dt' => 4,
                'field' => 'id',
                'formatter' => function($d, $row) {
                    $str = '';
                    return $str;
                }
            ),
        );

        $sql_details = $this->datatables_details();

        $joinQuery = " FROM `{$table}` ";

        $extraWhere = " 1 ";
        $extraWhere .= $request->getVar("modulo") !== "" ? " AND modulo = '".$request->getVar("modulo")."' " : "";
        $extraWhere .= $request->getVar("oggetto") !== "" ? " AND oggetto = '".$request->getVar("oggetto")."' " : "";

        $groupBy = '';

        echo json_encode(\SSP::simple($_POST, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy));
    }

}
