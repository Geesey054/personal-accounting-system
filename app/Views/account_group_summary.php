<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Account Group Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container mt-5">
    <h2>Account Group Summary</h2>
    <table class="table table-bordered table-striped mt-3">
        <thead class="table-light">
            <tr>
                <th>Account Type</th>
                <th class="text-end">Total (Debit + Credit)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($summary)): ?>
                <?php foreach ($summary as $row): ?>
                    <tr>
                        <td><?= esc($row['account_type']) ?></td>
                        <td class="text-end"><?= number_format($row['Total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="text-center">No data found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>
