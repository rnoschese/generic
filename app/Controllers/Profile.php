<?php

namespace App\Controllers;

class Profile extends BaseController
{
    public function index()
    {
        $page = 'profile';
        view_template($page);
    }
}