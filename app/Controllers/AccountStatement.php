<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AccountStatementModel;

class AccountStatement extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AccountStatementModel();
    }

    public function index()
    {
        $data['accounts'] = $this->model->getAccounts();

        return view('template/include/header')
            . view('account_statement', $data)
            . view('template/include/footer');
    }

   public function ajaxStatement()
{
    $accountId = $this->request->getPost('account_id');

    return $this->response->setJSON(
        $this->model->getStatement($accountId)
    );
}

}
