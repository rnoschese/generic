<?php

if (!function_exists('getMenu')) {
    function getMenu($page = 'dashboard')
    {

        $menu = array(
            array(
                'nome' => 'Dashboard',
                'url' => 'dashboard',
                'active' => $page === 'dashboard/dashboard' ? 'active' : '',
                'icon' => 'fa-tachometer',
                'sottoMenu' => array()
            ),
            array(
                'nome' => 'Servizio',
                'url' => 'servizio',
                'icon' => 'fas fa-key',
                'sottoMenu' => array(
                    array(
                        'nome' => 'Setup permessi (dev)',
                        'url' => 'authorizations/authorizations_edit',
                        'active' => $page === 'authorizations/authorizations_edit' ? 'active' : ''
                    ),
                    array(
                        'nome' => 'Gestione permessi',
                        'url' => 'authorizations/authorizations_management',
                        'active' => $page === 'authorizations/authorizations_management' ? 'active' : ''
                    ),
                )
            )
        );

        return $menu;
    }
}

if (!function_exists('breadcrumb')) {
    function breadcrumb($menu)
    {
        $breadcrumb = [];
        foreach ($menu as $item) {
            if (isset($item['active'])) {
                $breadcrumb[] = $item['active'] === 'active' ? $item['nome'] : null;
            }

            if (count($item['sottoMenu']) > 0) {
                foreach ($item['sottoMenu'] as $i) {
                    if ($i['active'] === 'active') {
                        $breadcrumb[] = $item['nome'];
                        $breadcrumb[] = $i['nome'];
                    }
                }
            }
        }
        return $breadcrumb;
    }
}

if (!function_exists('view_template')) {
    function view_template($page = 'home', $data = [])
    {
        $default = [
            'title' => ucfirst($page),
            'description' => '',
            'subtitle' => ucfirst($page),
            'menu' => getMenu($page),
            'breadcrumb' => ''
        ];

        foreach ($default as $key => $val) {
            if (isset($data[$key])) {
                $arr[$key] = $data[$key];
            } else {
                $arr[$key] = $default[$key];
            }
        }

        foreach ($data as $key => $val) {
            if (!isset($default[$key])) {
                $arr[$key] = $data[$key];
            }
        }

        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $arr['breadcrumb'] = breadcrumb($arr['menu']);

        echo view('templates/header', $arr);
        echo view('templates/menu', $arr);
        echo view('pages/' . $page, $arr);
        echo view('templates/footer', $arr);
    }
}

