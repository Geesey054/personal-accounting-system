<?php

namespace App\Controllers;

class Home extends BaseController
{
public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return  view('template/include/header.php').
                view('template/include/sidebar.php').
                view('main').
                view('template/include/footer');
                
    }

    public function test(){
        view('template/include/header.php').
               view('template/include/sidebar.php').
               view('Expense_accounting').
                view('template/include/footer');
    }
    public function account_statement(){
        view('template/include/header.php').
               view('template/include/sidebar.php').
               view('account_statement').
                view('template/include/footer');
    }
}
