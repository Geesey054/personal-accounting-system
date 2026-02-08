<!DOCTYPE html>
<html>
<head>
    <title>Account Group Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container-fluid mt-4">
<div class="row">

    <!-- SIDEBAR (SIDII AAD RABTAY) -->
    <div class="col-md-2 p-0">
        <?= view('template/include/sidebar') ?>
    </div>

    <!-- CONTENT -->
    <div class="col-md-10">
    <div class="row">
    <div class="col-md-9 mx-auto">

        <div class="card shadow-sm border-0">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0 page-title">Account Group Summary</h4>
            </div>

            <div class="card-body px-4 py-4">

                <!-- ⚠️ TABLE-KAAGA SIDII UU AHAA -->
                <table class="table table-bordered table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Account Type</th>
                            <th class="text-end">Total</th>
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
                <!-- END TABLE -->

            </div>
        </div>

    </div>
    </div>
    </div>

</div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>
</html>
