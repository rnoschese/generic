<?php

namespace App\Models;

use CodeIgniter\Model;

class MemberModel extends Model {
    protected $table = 'members';
    protected $primaryKey = 'id';
    protected $allowedFields = [ 'email', 'password', 'salt', 'permessi', 'nome', 'cognome', 'foto_profilo', 'tel_casa', 'tel_ufficio', 'cell', 'qualifica', 'classe', 'settore', 'reparto', 'area', 'livello', 'ruolo', 'mansioni', 'responsabilita', 'funzioni', 'rapporto', 'ufficio', 'divisione', 'progetto', 'note', 'attivo', 'natoA', 'natoIl', 'deleted_at', 'created_at', 'updated_at'];
    protected $useSoftDeletes = true;

    public function getUser($email = false) {
        if ($email === false) {
            return $this->findAll();
        }
        return $this->asArray()->where(['email' => $email])->first();
    }
}
