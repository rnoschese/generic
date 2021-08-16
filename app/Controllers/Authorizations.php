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
        $db = db_connect();

        try{
            $builder = $db->table('authorizations');
            $builder->insert($this->request->getVar());

            return json_encode($db->insertID());
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }

    public function get_permises_user($dati = []){
        $default = array(
            'user_id' => !empty($this->request->getVar('user_id')) ? $this->request->getVar('user_id') : NULL
        );

        foreach($default as $key => $val){
            if (isset($dati[$key])){
                $arr[$key] = $dati[$key];
            }else{
                $arr[$key] = $val;
            }
        }

        try{
            $db = db_connect();
            $query = $db->query('SELECT permessi FROM members WHERE id = '.$arr['user_id'].' LIMIT 1');
            $row   = $query->getRow();
            $permessi = $row->permessi;

            $db->close();

            return json_encode($permessi);
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }

    public function update_user(){
        $permessi = $this->request->getVar('permessi');
        $user_id = $this->request->getVar('user_id');

        $db = db_connect();

        try{
            $builder = $db->table('members');
            $builder->set('permessi', $permessi);
            $builder->where('id', $user_id);
            $builder->update();

            return 'Update eseguito correttamente';
        }catch (\Exception $e){
            die($e->getMessage());
        }
    }

    public function mergeAuth($arr, $dati = []){
        $request = service('request');
        $default = array(
            'permessi' => $request->getVar('permessi'),
            'clone' => $request->getVar('clone')
        );

        foreach($default as $key => $val){
            if (isset($dati[$key])){
                $arr[$key] = $dati[$key];
            }else{
                $arr[$key] = $val;
            }
        }

        $arr1 = explode(',',$arr['permessi']);
        $arr2 = explode(',',$arr['clone']);
        $arr = array_unique (array_merge ($arr1, $arr2));

        $merge = implode(',',array_filter($arr));

	    return json_encode($merge);
    }

    public function authorization($dati = []){
        $request = service('request');
        $default = array(
            'permessi' => $request->getVar('permessi'),
            'key' => $request->getVar('key')
        );

        foreach ($default as $key => $val) {
            if (isset($dati[$key])) {
                $arr[$key] = $dati[$key];
            } else {
                $arr[$key] = $val;
            }
        }

	    return in_array($arr['key'], explode(',',$arr['permessi']));
    }
}
