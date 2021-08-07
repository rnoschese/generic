<?php

namespace App\Controllers;

class Dashboard extends BaseController {

    public function index() {
        $page = 'dashboard/dashboard';
        $data['title'] = 'Dashboard';
        $data['description'] = 'Pannello di controllo';

        $data['data_array'] = $_ENV;

        view_template($page, $data);
    }

}
