<?php

namespace App\Controllers;

class Members extends BaseController {

    public function index() {
        $data['title'] = 'Utenti';
        $data['description'] = 'Elenco utenti censiti';
        view_template('members/members');
    }

    public function member() {
        $data['title'] = 'Profilo utente';
        $data['description'] = 'Dettaglio profilo utente';
        view_template('members/member');
    }


}
