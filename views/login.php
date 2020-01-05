<?php
require_once "../config/config.php";
if (@$_SESSION['Operator'] || @$_SESSION['Pendamping1'] || @$_SESSION['Pendamping2'] || @$_SESSION['Pendamping3']) {
    echo "<script>window.location='" . base_url() . "';</script>";
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Login</title>

        <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    </head>

    <body style="background:#6989A4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-2 mt-2"><b>LOGIN</b></h1>
                                        </div>
                                        <?php
                                            if (isset($_SESSION['message'])) : ?>
                                            <div class="alert alert-<?= $_SESSION['msg_type'] ?> text-center" role="alert">
                                                <?php
                                                        echo $_SESSION['message'];
                                                        unset($_SESSION['message']);
                                                        ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif ?>
                                        <hr>
                                        <form class="user mt-4 mb-2" id="Form-login" action="<?= base_url('models/Auth/Login.php'); ?>" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <a href="#" class="text-dark" id="icon-click">
                                                                <i class="fas fa-eye" id="icon"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" id="captcha" class="form-control" name="vercode" size="10" placeholder="Validasi" required>
                                                    <div class="input-group-prepend col-3">
                                                        <div class="input-group-text"><img src="<?= base_url('models/Auth/Captcha.php'); ?>" class="imgcaptcha"></div>
                                                    </div>
                                                    <input type="button" value="Refresh" onClick="document.location.reload(true)" class="btn-sm btn-secondary">
                                                </div>
                                            </div>
                                            <div id="loading">
                                            </div>
                                            <div>
                                                <input type="submit" name="submit" value="Login" class="btn btn-primary btn-block mt-4">
                                            </div>
                                        </form>
                                        <hr>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function reload() {
                location.reload()
            }
        </script>
        <script src="<?= base_url('assets/vendor/jquery/jquery.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
        <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
        <script src="<?= base_url('assets/js/sb-admin-2.min.js') ?>"></script>
        <!-- Show Hide Pass -->
        <script type="text/javascript">
            $(document).ready(function() {

                $("#icon-click").click(function() {
                    $("#icon").toggleClass('fa-eye-slash');

                    var input = $("#password");
                    if (input.attr("type") === "password") {
                        input.attr("type", "text");
                    } else {
                        input.attr("type", "password");
                    }
                });
            });
        </script>
    </body>

    </html>
<?php
}
?>