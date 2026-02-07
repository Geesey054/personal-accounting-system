<?php
namespace App\Models;

use CodeIgniter\Model;

class AccountGroupSummaryModel extends Model
{
    protected $table = 'transaction_lines';
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getGroupTotals()
    {
        $builder = $this->db->table('transaction_lines tl');
        $builder->select('ag.account_type, SUM(tl.debit + tl.credit) AS Total');
        $builder->join('accounts ac', 'ac.id = tl.account_id');
        $builder->join('account_groups ag', 'ag.id = ac.group_id');
        $builder->groupBy('ag.account_type');
        $builder->orderBy('ag.account_type', 'ASC');

        $query = $builder->get();
        return $query->getResultArray();
    }
}
