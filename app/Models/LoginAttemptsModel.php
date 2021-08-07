<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAttemptsModel extends Model {

    protected $table = 'login_attempts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id','time'];
    protected $useSoftDeletes = true;

}
