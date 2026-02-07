<?php
namespace App\Models;

use CodeIgniter\Model;

class ExpenseAccountingModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getAccounts()
    {
        return $this->db->table('accounts')
            ->select('id, account_name')
            ->orderBy('account_name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function saveTransaction($debit, $credit, $amount, $description)
    {
        if ($debit == $credit || $amount <= 0) {
            return false;
        }

        $this->db->transStart();

        $this->db->table('transactions')->insert([
            'description' => $description,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        $tid = $this->db->insertID();

        $this->db->table('transaction_lines')->insert([
            'transaction_id' => $tid,
            'account_id'     => $debit,
            'debit'          => $amount,
            'credit'         => 0
        ]);

        $this->db->table('transaction_lines')->insert([
            'transaction_id' => $tid,
            'account_id'     => $credit,
            'debit'          => 0,
            'credit'         => $amount
        ]);

        $this->db->transComplete();
        return $this->db->transStatus();
    }

    public function getJoinRows()
    {
        return $this->db->query("
            SELECT 
                tl.transaction_id,
                a.account_name,
                g.account_type,
                tl.debit,
                tl.credit,
                (tl.debit + tl.credit) AS amount
            FROM transaction_lines tl
            JOIN accounts a ON a.id = tl.account_id
            JOIN account_groups g ON g.id = a.group_id
            ORDER BY tl.transaction_id DESC
        ")->getResultArray();
    }

    public function getTotals()
    {
        return $this->db->query("
            SELECT 
                SUM(debit)  AS total_debit,
                SUM(credit) AS total_credit,
                SUM(debit - credit) AS balance
            FROM transaction_lines
        ")->getRowArray();
    }
}
