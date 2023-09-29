<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title><?= appName(); ?></title>
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?= base_url(); ?>/public/assets/images/logo.png">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/dropzone/dropzone.css">
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/authentication.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/color_skins.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
</head>

<body class="theme-cyan authentication sidebar-collapse">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-transparent">
        <div class="container">
            <div class="navbar-translate n_logo pt-4">
                <!-- <a class="navbar-brand" href="#" title="" target="_blank"><img src="<?= base_url(); ?>/public/assets/images/logo.png" width="20px"></a> -->
                <button class="navbar-toggler" type="button">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <div class="page-header">
        <div class="page-header-image"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-5" style="padding-top: 134px;">
                    <div class="card-plain">
                        <div class="header">
                            <div class="logo-container">
                                <img src="<?= base_url(); ?>/public/assets/images/logo.png" alt="">
                            </div>
                            <h5>Welcome</h5>
                            <p class="mt-1">Sign in to continue to <?= appName(); ?>.</p>
                        </div>
                        <div class="content">
                            <?php if (session()->getFlashdata('error')) : ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="padding-right: unset; width:322px;">
                                    <?= session()->getFlashdata('error'); ?>
                                    <i type="button" class="zmdi zmdi-close pl-4" data-dismiss="alert" aria-label="Close"></i>
                                </div>
                            <?php endif; ?>
                            <?php echo form_open(base_url('login')); ?>
                            <div class="input-group input-lg">
                                <input type="text" placeholder="Username" id="username" name="username" class="form-control <?= (session()->getFlashdata('username')) ? 'is-invalid' : ''; ?>" value="<?= old('username'); ?>">
                                <span class="input-group-addon pl-1">
                                    <i class="zmdi zmdi-account-circle"></i>
                                </span>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('username'); ?>
                                </div>
                            </div>
                            <div class="input-group input-lg">
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control <?= (session()->getFlashdata('password')) ? 'is-invalid' : ''; ?>" value="<?= old('password'); ?>" aria-label="Password" />
                                <span class="input-group-addon pl-2">
                                    <div class="zmdi zmdi-eye icon" id="show-password"></div>
                                </span>
                                <div class="invalid-feedback">
                                    <?= session()->getFlashdata('password'); ?>
                                </div>
                            </div>

                            <button class="btn l-cyan btn-round btn-lg btn-block waves-effect waves-light" type="submit">SIGN IN</button>
                            <?php echo form_close(); ?>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card patients-list">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="10%">Status</th>
                                            <th width="30%">Jam Berangkat</th>
                                            <th width="30%">Jam pulang</th>
                                            <th width="35%">Kode_booking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($jadwal_transport as $table) : ?>
                                            <tr>
                                                <td>
                                                    <span class="<?= $table->status === 'diproses' ? 'badge badge-warning' : '' ?>">
                                                        <?= $table->status === 'diproses' ? 'Booking diproses' : '' ?></span>
                                                </td>
                                                <td><?= $table->jam_keberangkatan; ?></td>
                                                <td><?= $table->jam_kembali; ?></td>
                                                <td><?= $table->kode_booking; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer class="footer">
    <div class="container">
        <!-- <nav>
                <ul>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </nav> -->
        <div class="copyright">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>,
            <span><a href="https://al-hamidiyah.sch.id/">Yayasan Islam Alhamidiyah</a></span>
            <span>Develop by <a href="#" target="_blank">Departemen IT</a></span>
        </div>
    </div>
</footer>
</div>

<!-- Jquery Core Js -->
<script src="<?= base_url(); ?>/public/assets/bundles/libscripts.bundle.js"></script>
<script src="<?= base_url(); ?>/public/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?= base_url(); ?>/public/assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?= base_url(); ?>/public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/js/pages/tables/jquery-datatable.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<script>
    $(".navbar-toggler").on('click', function() {
        $("html").toggleClass("nav-open");
    });
    //=============================================================================
    $('.form-control').on("focus", function() {
        $(this).parent('.input-group').addClass("input-group-focus");
    }).on("blur", function() {
        $(this).parent(".input-group").removeClass("input-group-focus");
    });
    $('.icon').click(function() {
        if ($('#password').attr('type') == 'text') {
            $('#password').attr('type', 'password');
        } else {
            $('#password').attr('type', 'text');
        }
    });
</script>
</body>

</html>