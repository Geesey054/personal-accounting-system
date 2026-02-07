<?php
namespace App\Controllers;

use App\Models\ExpenseAccountingModel;

class ExpenseAccounting extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new ExpenseAccountingModel();
    }

    public function index()
    {
        $data = [
            'accounts' => $this->model->getAccounts(),
            'joinRows' => $this->model->getJoinRows(),
            'totals'   => $this->model->getTotals(),
        ];

        return view('template/include/header')
            . view('Expense_accounting', $data)
            . view('template/include/footer');
    }

    public function save()
    {
        $saved = $this->model->saveTransaction(
            $this->request->getPost('debit'),
            $this->request->getPost('credit'),
            $this->request->getPost('amount'),
            $this->request->getPost('description')
        );

        if ($saved) {
            return redirect()->to(site_url('ExpenseAccounting'))
                ->with('success', '✅ Transaction saved successfully');
        }

        return redirect()->back()
            ->with('error', '❌ Transaction failed');
    }
}
