<?php

namespace App\Controllers;

class Authorizations extends BaseController
{
	public function authorizations_edit(){
	    $data['title'] = 'Setup permessi';
        $data['description'] = 'Impostazione e configurazione permessi (development)';
        view_template('authorizations/authorizations_edit',$data);
    }

	public function authorizations_management(){
	    $data['title'] = 'Gestione permessi';
	    $data['description'] = 'Amministrazione permessi utenti';
        view_template('authorizations/authorizations_management',$data);
    }

    public function add(){
        $request = service('request');
        $db = \Config\Database::connect();
        $builder = $db->table('authorizations');
        $builder->insert($request->getVar());

        return json_encode($db->insertID());
    }
}
