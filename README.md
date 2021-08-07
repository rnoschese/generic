# GENERIC LOGIN (Codeigniter 4)

## CONNESSIONE DB 

HOST: 62.149.181.41<br>
USERNAME: **_mysql_generic_**<br>
PASSWORD: **_9eRRA1dAfOzqu8gs_**

## PLUGIN

###SELECT2

#### HTML (view)

`<select id="select_test" name="test" class="form-control" style="width: 100%"></select>`

#### jQuery
Utilizzo:
L'url deve puntare a classe/funzione <br>
addNew se impostato su true permette di aggiungere option alla select (valore di default false)

$('#select_test').select2Ajax({<br>
url: '../select2/test',<br>
placeholder: 'Seleziona / inserisci modulo',<br>
addNew: true
});

#### PHP (app/Controllers/Select2)

<?php

namespace App\Controllers;
use CodeIgniter\HTTP\IncomingRequest;

class Select2 extends BaseController {
...
public function test(){
        $request = service('request');
        $db      = \Config\Database::connect();
        $builder = $db->table('xxx');

        if (!empty($this->request->getVar("q"))) {
            $builder->like('xxx', $request->getVar("q"));
        }

        if (!empty($request->getVar("dataDefault")) && strlen($request->getVar("dataDefault")) > 0) {
            $builder->where('xxx', $request->getVar("dataDefault"));
        }

        $builder->select(' xxx AS id, xxx AS text');
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
