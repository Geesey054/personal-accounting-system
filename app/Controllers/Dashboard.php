<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
          return  view('template/include/header.php').
                view('template/include/sidebar.php').
                view('main').
                view('template/include/footer'); // ama dashboard view
    }
}
