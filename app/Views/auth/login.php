<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-light d-flex align-items-center" style="min-height:100vh;">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-6">

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <i class="bi bi-person-circle fs-1 text-primary"></i>
                        <h4 class="fw-semibold mt-2">Login</h4>
                        <small class="text-muted">Access your account</small>
                    </div>

                    <div id="error" class="alert alert-danger d-none"></div>

                    <form id="loginForm">

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope"></i>
                                </span>
                                <input type="email" name="email" class="form-control" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </button>

                    </form>

                </div>
            </div>

            <p class="text-center text-muted mt-3 small">
                © <?= date('Y') ?> Personal Expense 
            </p>

        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
$(function () {
    $('#loginForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('login') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(res){
                if(res.status === 'error'){
                    $('#error').removeClass('d-none').html(res.message);
                } else {
                    window.location.href = "<?= base_url('dashboard') ?>";
                }
            }
        });
    });
});
</script>

</body>
</html>
