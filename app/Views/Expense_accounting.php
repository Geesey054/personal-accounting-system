<!DOCTYPE html>
<html>
<head>
    <title>Personal Expense Accounting</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background:#f8f9fa; }
        .page-title { font-weight:700; }
        .card { border-radius:.75rem; }
        .card-header { background:#fff; font-weight:600; }
        table th { white-space:nowrap; }
        .form-control,.form-select { border-radius:.5rem; }
    </style>
</head>

<body>

<div class="container-fluid mt-4">
<div class="row">

<!-- SIDEBAR -->
<div class="col-md-2 p-0">
    <?= view('template/include/sidebar') ?>
</div>

<!-- CONTENT -->
<div class="col-md-10">
<div class="row">
<div class="col-md-9 mx-auto">

<h3 class="text-center page-title mb-4">Personal Expense Accounting</h3>

<!-- FORM -->
<div class="card shadow-sm border-0 mb-4">
<div class="card-body">

<div id="msgBox"></div>

<form id="transactionForm">
<div class="row g-3">

<div class="col-md-3">
<label class="form-label">Debit</label>
<select name="debit" class="form-select" required>
<?php foreach($accounts as $a): ?>
<option value="<?= $a['id'] ?>"><?= esc($a['account_name']) ?></option>
<?php endforeach; ?>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Credit</label>
<select name="credit" class="form-select" required>
<?php foreach($accounts as $a): ?>
<option value="<?= $a['id'] ?>"><?= esc($a['account_name']) ?></option>
<?php endforeach; ?>
</select>
</div>

<div class="col-md-3">
<label class="form-label">Amount</label>
<input type="number" step="0.01" name="amount" class="form-control" required>
</div>

<div class="col-md-3">
<label class="form-label">Description</label>
<input type="text" name="description" class="form-control">
</div>

</div>

<div class="text-end mt-3">
<button class="btn btn-primary px-4">💾 Save Transaction</button>
</div>
</form>

</div>
</div>

<!-- TABLE -->
<div class="card shadow-sm border-0">
<div class="card-header">Transaction Data</div>

<div class="card-body p-0">
<table class="table table-bordered table-striped table-hover mb-0 align-middle">
<thead class="table-dark">
<tr>
<th>#</th>
<th>Account</th>
<th>Type</th>
<th>Debit</th>
<th>Credit</th>
<th>Amount</th>
</tr>
</thead>

<tbody>
<?php foreach($joinRows as $j): ?>
<tr>
<td><?= $j['transaction_id'] ?></td>
<td><?= esc($j['account_name']) ?></td>
<td><?= esc($j['account_type']) ?></td>
<td><?= number_format($j['debit'],2) ?></td>
<td><?= number_format($j['credit'],2) ?></td>
<td class="fw-bold"><?= number_format($j['amount'],2) ?></td>
</tr>
<?php endforeach; ?>
</tbody>

<tfoot class="table-light fw-bold">
<tr>
<td colspan="3" class="text-end">TOTAL</td>
<td><?= number_format($totals['total_debit'],2) ?></td>
<td><?= number_format($totals['total_credit'],2) ?></td>
<td><?= number_format($totals['balance'],2) ?></td>
</tr>
</tfoot>
</table>
</div>
</div>

</div>
</div>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function () {
    $('#transactionForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "<?= site_url('ExpenseAccounting/save') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function () {
                $('#msgBox').html('<div class="alert alert-info">Saving...</div>');
            },
            success: function (res) {
                if (res.status === 'success') {
                    $('#msgBox').html('<div class="alert alert-success">'+res.message+'</div>');
                    $('#transactionForm')[0].reset();
                    refreshTable();
                } else {
                    $('#msgBox').html('<div class="alert alert-danger">'+res.message+'</div>');
                }
            }
        });
    });

    function refreshTable(){
        $.get(window.location.href, function (html) {
            $('table tbody').html($(html).find('table tbody').html());
            $('table tfoot').html($(html).find('table tfoot').html());
        });
    }
});
</script>

</body>
</html>
