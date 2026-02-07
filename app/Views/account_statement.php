<!DOCTYPE html>
<html>
<head>
    <title>Account Statement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">


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

<div class="card shadow-sm border-0">

<div class="card-header d-flex justify-content-between align-items-center">
<h4 class="mb-0 page-title">Account Statement</h4>
<span id="account_badge" class="badge bg-primary d-none"></span>
</div>

<div class="card-body px-4 py-4">

<div class="row mb-4">
<div class="col-md-6">
<select id="account_select" class="form-select form-select-lg">
<option value="">-- Select Account --</option>
<?php foreach ($accounts as $acc): ?>
<option value="<?= $acc['id'] ?>"><?= esc($acc['account_name']) ?></option>
<?php endforeach; ?>
</select>
</div>
</div>

<div id="statement_box" class="table-responsive" style="display:none;">
<table class="table table-bordered table-striped table-hover table-sm align-middle">
<thead class="table-light">
<tr>
<th>Date</th>
<th>Details</th>
<th class="text-end">Debit</th>
<th class="text-end">Credit</th>
<th class="text-end">Balance</th>
</tr>
</thead>
<tbody id="statement_body"></tbody>
</table>

<div class="text-muted small mt-2">
Total Records: <span id="total_rows">0</span>
</div>
</div>

</div>
</div>

</div>
</div>
</div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(document).ready(function () {

    $('#account_select').change(function () {

        let accountId   = $(this).val();
        let accountName = $('#account_select option:selected').text();

        if (accountId === '') {
            $('#statement_box').hide();
            $('#statement_body').html('');
            $('#account_badge').addClass('d-none');
            return;
        }

        $('#account_badge').removeClass('d-none').text(accountName);

        $.ajax({
            url: "<?= base_url('account-statement/ajax') ?>",
            type: "POST",
            dataType: "json",
            data: { account_id: accountId },
            beforeSend: function () {
                $('#statement_box').show();
                $('#statement_body').html(
                    '<tr><td colspan="5" class="text-center">Loading...</td></tr>'
                );
            },
            success: function (res) {

                let rows = '';

                if (res.length === 0) {
                    rows = `
                    <tr>
                        <td colspan="5" class="text-center text-warning">
                            No transactions found
                        </td>
                    </tr>`;
                } else {
                    $.each(res, function (i, row) {

                        let balanceClass =
                            parseFloat(row.balance) >= 0 ? 'text-success' : 'text-danger';

                        rows += `
                        <tr>
                            <td>${row.date}</td>
                            <td>${row.details}</td>
                            <td class="text-end">${row.debit > 0 ? parseFloat(row.debit).toFixed(2) : '-'}</td>
                            <td class="text-end">${row.credit > 0 ? parseFloat(row.credit).toFixed(2) : '-'}</td>
                            <td class="text-end fw-semibold ${balanceClass}">
                                ${parseFloat(row.balance).toFixed(2)}
                            </td>
                        </tr>`;
                    });
                }

                $('#statement_body').html(rows);
                $('#total_rows').text(res.length);
            }
        });
    });
});
</script>

</body>
</html>
