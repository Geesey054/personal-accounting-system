<?php
namespace App\Controllers;

use App\Models\AccountGroupSummaryModel;

class AccountGroupSummary extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new AccountGroupSummaryModel();
    }

    public function index()
    {
        $data['summary'] = $this->model->getGroupTotals();
        return view('account_group_summary', $data);
    }
}
