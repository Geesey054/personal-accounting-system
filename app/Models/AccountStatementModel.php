<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountStatementModel extends Model
{
    protected $table = 'transaction_lines';

    public function getAccounts()
    {
        return $this->db->table('accounts')
            ->select('id, account_name')
            ->orderBy('account_name', 'ASC')
            ->get()
            ->getResultArray();
    }

    public function getStatement($accountId)
    {
        return $this->db->table('transaction_lines tl')
            ->select("
                DATE(t.created_at) AS date,
                t.description AS details,
                tl.debit,
                tl.credit,
                SUM(tl.debit - tl.credit)
                    OVER (ORDER BY t.created_at, tl.id) AS balance
            ")
            ->join('transactions t', 't.id = tl.transaction_id')
            ->where('tl.account_id', $accountId)
            ->orderBy('t.created_at', 'ASC')
            ->get()
            ->getResultArray();
    }
}
