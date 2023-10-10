<!-- new -->

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
    <!-- <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/bootstrap-select/css/bootstrap-select.min.css" /> -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/main.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/color_skins.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <!-- calendar -->
    <link rel="stylesheet" href="<?= base_url(); ?>/public/assets/plugins/fullcalendar/fullcalendar.min.css">

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/custom.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/toastr.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/bundles/datatablescripts.bundle.js"></script>
    <script src="<?= base_url(); ?>/public/assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>/public/assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <!-- jQuery Number -->
    <script src="<?= base_url(); ?>/public/assets/plugins/jquery-number/jquery.number.js"></script>
    <!-- Number Devider -->
    <script src="<?= base_url(); ?>/public/assets/plugins/number-divider/number-divider.js"></script>
    <script src="<?= base_url(); ?>/public/assets/plugins/signature-pad/signature_pad.js"></script>

</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></div>
            <p>Please wait...</p>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="col-12">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?= base_url(); ?>"><i class="zmdi zmdi-settings"></i><span class="m-l-10"><?= appName(); ?></span></a>
            </div>
            <ul class="nav navbar-nav navbar-left">
                <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
                <li class="hidden-sm-down">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-search"></i>
                        </span>
                    </div>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-notifications"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right slideDown">
                        <li class="header">NOTIFICATIONS</li>
                        <li class="body">
                            <ul class="menu list-unstyled">
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-blue"><i class="zmdi zmdi-account"></i></div>
                                        <div class="menu-info">
                                            <h4>8 New Members joined</h4>
                                            <p><i class="zmdi zmdi-time"></i> 14 mins ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-amber"><i class="zmdi zmdi-shopping-cart"></i></div>
                                        <div class="menu-info">
                                            <h4>4 Sales made</h4>
                                            <p> <i class="zmdi zmdi-time"></i> 22 mins ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-red"><i class="zmdi zmdi-delete"></i></div>
                                        <div class="menu-info">
                                            <h4><b>Nancy Doe</b> Deleted account</h4>
                                            <p> <i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-green"><i class="zmdi zmdi-edit"></i></div>
                                        <div class="menu-info">
                                            <h4><b>Nancy</b> Changed name</h4>
                                            <p> <i class="zmdi zmdi-time"></i> 2 hours ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-grey"><i class="zmdi zmdi-comment-text"></i></div>
                                        <div class="menu-info">
                                            <h4><b>John</b> Commented your post</h4>
                                            <p> <i class="zmdi zmdi-time"></i> 4 hours ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-purple"><i class="zmdi zmdi-refresh"></i></div>
                                        <div class="menu-info">
                                            <h4><b>John</b> Updated status</h4>
                                            <p> <i class="zmdi zmdi-time"></i> 3 hours ago </p>
                                        </div>
                                    </a> </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="icon-circle bg-light-blue"><i class="zmdi zmdi-settings"></i></div>
                                        <div class="menu-info">
                                            <h4>Settings Updated</h4>
                                            <p> <i class="zmdi zmdi-time"></i> Yesterday </p>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"> <a href="javascript:void(0);">View All Notifications</a> </li>
                    </ul>
                </li>
                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="zmdi zmdi-flag"></i>
                        <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right slideDown">
                        <li class="header">TASKS</li>
                        <li class="body">
                            <ul class="menu tasks list-unstyled">
                                <li> <a href="javascript:void(0);">
                                        <div class="progress-container progress-primary">
                                            <span class="progress-badge">Footer display issue</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                                    <span class="progress-value">86%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="progress-container progress-info">
                                            <span class="progress-badge">Answer GitHub questions</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" style="width: 35%;">
                                                    <span class="progress-value">35%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="progress-container progress-success">
                                            <span class="progress-badge">Solve transition issue</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%;">
                                                    <span class="progress-value">72%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li><a href="javascript:void(0);">
                                        <div class="progress-container">
                                            <span class="progress-badge"> Create new dashboard</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                                    <span class="progress-value">45%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li> <a href="javascript:void(0);">
                                        <div class="progress-container progress-warning">
                                            <span class="progress-badge">Panding Project</span>
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;">
                                                    <span class="progress-value">29%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="javascript:void(0);">View All</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:void(0);" class="fullscreen hidden-sm-down" data-provide="fullscreen" data-close="true"><i class="zmdi zmdi-fullscreen"></i></a>
                </li>
                <li><a href="<?= base_url('logout'); ?>" class="mega-menu" data-close="true"><i class="zmdi zmdi-power"></i></a></li>
            </ul>
        </div>
    </nav>

    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info">
                        <div class="image"><img src="<?= _siteURL('master/assets/img/profile/thumb/' . $user_login->foto); ?>" alt="User" height="70px"></div>
                        <div class="detail">
                            <h4><?= $user_login->nama; ?></h4>
                            <small><?= $user_login->jabatan; ?></small>
                        </div>
                        <a href="<?= base_url('profile'); ?>" title="Contact List"><i class="zmdi zmdi-account"></i></a>
                        <a href="<?= base_url('logout'); ?>" title="Sign out"><i class="zmdi zmdi-power"></i></a>
                    </div>
                </li>
                <li class="<?= is_menu_active('') ?>"> <a href="<?= base_url(); ?>" class="load-click"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                <li class="<?= is_menu_active('profile') ?>"> <a href="<?= base_url('profile'); ?>" class="load-click"><i class="zmdi zmdi-account"></i><span>Profile</span></a></li>

                <?php $menu = _userMenu('sistem_manajemen') ?>
                <?php if ($menu) : ?>
                    <li class="header" data-key="t-menu">RUMAH TANGGA</li>

                    <?php foreach ($menu as $userMenu) :
                        $arrow      = $userMenu->is_sub == 0 ? 'has-arrow' : 'menu-toggle';
                        $href_menu  = $userMenu->is_sub == 1 ? 'javascript: void(0);' : base_url($userMenu->url); ?>

                        <li class="<?= is_menu_active($userMenu->url); ?>">
                            <a href="<?= $href_menu; ?>" class="<?= $arrow; ?>">
                                <i class="<?= $userMenu->icon; ?>"></i>
                                <span data-key="t-<?= $userMenu->menu; ?>"><?= $userMenu->menu; ?></span>
                            </a>
                            <?php if ($userMenu->is_sub == 1) : ?>
                                <ul class="ml-menu">
                                    <?php foreach (_userSubMenu($userMenu->id) as $userSubMenu) : ?>
                                        <li class="<?= is_menu_active($userSubMenu->url); ?>">
                                            <a href="<?= base_url($userSubMenu->url); ?>" class="load-click">
                                                <span data-key="t-<?= $userSubMenu->sub_menu; ?>"><?= $userSubMenu->sub_menu; ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php $menu = _userMenu('user_pengguna') ?>
                <?php if ($menu) : ?>
                    <li class="header" data-key="t-menu">USER PENGGUNA</li>

                    <?php foreach ($menu as $userMenu) :
                        $arrow      = $userMenu->is_sub == 0 ? 'has-arrow' : 'menu-toggle';
                        $href_menu  = $userMenu->is_sub == 1 ? 'javascript: void(0);' : base_url($userMenu->url); ?>

                        <li class="<?= is_menu_active($userMenu->url); ?>">
                            <a href="<?= $href_menu; ?>" class="<?= $arrow; ?>">
                                <i class="<?= $userMenu->icon; ?>"></i>
                                <span data-key="t-<?= $userMenu->menu; ?>"><?= $userMenu->menu; ?></span>
                            </a>
                            <?php if ($userMenu->is_sub == 1) : ?>
                                <ul class="ml-menu">
                                    <?php foreach (_userSubMenu($userMenu->id) as $userSubMenu) : ?>
                                        <li class="<?= is_menu_active($userSubMenu->url); ?>">
                                            <a href="<?= base_url($userSubMenu->url); ?>" class="load-click">
                                                <span data-key="t-<?= $userSubMenu->sub_menu; ?>"><?= $userSubMenu->sub_menu; ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </aside>

    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat"><i class="zmdi zmdi-comments"></i></a></li>
            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#activity">Activity</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active slideRight" id="setting">
                <div class="slim_scroll">
                    <div class="card">
                        <h6>Skins</h6>
                        <ul class="choose-skin list-unstyled">
                            <li data-theme="purple">
                                <div class="purple"></div>
                            </li>
                            <li data-theme="blue">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan" class="active">
                                <div class="cyan"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush">
                                <div class="blush"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>Left Menu</h6>
                        <ul class="list-unstyled theme-light-dark">
                            <li>
                                <div class="t-light btn btn-default btn-simple btn-round">Light</div>
                            </li>
                            <li>
                                <div class="t-dark btn btn-default btn-round">Dark</div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>General Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox1" type="checkbox">
                                    <label for="checkbox1">Report Panel Usage</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox2" type="checkbox" checked="">
                                    <label for="checkbox2">Email Redirect</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox3" type="checkbox" checked="">
                                    <label for="checkbox3">Notifications</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox4" type="checkbox" checked="">
                                    <label for="checkbox4">Auto Updates</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>Account Settings</h6>
                        <ul class="setting-list list-unstyled">
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox5" type="checkbox" checked="">
                                    <label for="checkbox5">Offline</label>
                                </div>
                            </li>
                            <li>
                                <div class="checkbox">
                                    <input id="checkbox6" type="checkbox" checked="">
                                    <label for="checkbox6">Location Permission</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane right_chat pullUp" id="chat">
                <div class="slim_scroll">
                    <div class="card">
                        <div class="search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-addon">
                                    <i class="zmdi zmdi-search"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <h6>Recent</h6>
                        <ul class="list-unstyled">
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar9.jpg" alt="">
                                        <div class="media-body">
                                            <span class="name">Sophia</span>
                                            <span class="message">There are many variations of passages of Lorem Ipsum available</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar5.jpg" alt="">
                                        <div class="media-body">
                                            <span class="name">Grayson</span>
                                            <span class="message">All the Lorem Ipsum generators on the</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="">
                                        <div class="media-body">
                                            <span class="name">Isabella</span>
                                            <span class="message">Contrary to popular belief, Lorem Ipsum</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="me">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar1.jpg" alt="">
                                        <div class="media-body">
                                            <span class="name">John</span>
                                            <span class="message">It is a long established fact that a reader</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar3.jpg" alt="">
                                        <div class="media-body">
                                            <span class="name">Alexander</span>
                                            <span class="message">Richard McClintock, a Latin professor</span>
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>Contacts</h6>
                        <ul class="list-unstyled">
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar10.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar6.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar7.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar8.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar9.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar5.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar3.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="online inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="offline inlineblock">
                                <a href="javascript:void(0);">
                                    <div class="media">
                                        <img class="media-object " src="<?= base_url(); ?>/public/assets/images/xs/avatar1.jpg" alt="">
                                        <div class="media-body">
                                            <span class="badge badge-outline status"></span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-pane slideRight" id="activity">
                <div class="slim_scroll">
                    <div class="card">
                        <h6>Recent Activity</h6>
                        <ul class="list-unstyled activity">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-cake bg-blue"></i>
                                    <div class="info">
                                        <h4>Admin Birthday</h4>
                                        <small>Will be Jan 01</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-file-text bg-red"></i>
                                    <div class="info">
                                        <h4>Heart Surgeries</h4>
                                        <small>Will be Jan 02</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-account-box-phone bg-green"></i>
                                    <div class="info">
                                        <h4>Medical Treatment</h4>
                                        <small>Will be Jan 12</small>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="zmdi zmdi-email bg-amber"></i>
                                    <div class="info">
                                        <h4>New Email</h4>
                                        <small>Will be Jan 18</small>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <h6>Project Status</h6>
                        <div class="progress-container progress-primary">
                            <span class="progress-badge">Heart Surgeries</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100" style="width: 86%;">
                                    <span class="progress-value">86%</span>
                                </div>
                            </div>
                            <ul class="list-unstyled team-info">
                                <li class="m-r-15"><small>Team</small></li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar3.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar4.jpg" alt="Avatar">
                                </li>
                            </ul>
                        </div>
                        <div class="progress-container">
                            <span class="progress-badge">Medical</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
                                    <span class="progress-value">45%</span>
                                </div>
                            </div>
                            <ul class="list-unstyled team-info">
                                <li class="m-r-15"><small>Team</small></li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar10.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar9.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar8.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar7.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar6.jpg" alt="Avatar">
                                </li>
                            </ul>
                        </div>
                        <div class="progress-container progress-warning">
                            <span class="progress-badge">Pharmacy</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="29" aria-valuemin="0" aria-valuemax="100" style="width: 29%;">
                                    <span class="progress-value">29%</span>
                                </div>
                            </div>
                            <ul class="list-unstyled team-info">
                                <li class="m-r-15"><small>Team</small></li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar5.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="Avatar">
                                </li>
                                <li>
                                    <img src="<?= base_url(); ?>/public/assets/images/xs/avatar7.jpg" alt="Avatar">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Chat-launcher -->
    <div class="chat-launcher"></div>
    <div class="chat-wrapper">
        <div class="card">
            <div class="header">
                <ul class="list-unstyled team-info margin-0">
                    <li class="m-r-15">
                        <h2>Doctor Team</h2>
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>/public/assets/images/xs/avatar3.jpg" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" alt="Avatar">
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>/public/assets/images/xs/avatar6.jpg" alt="Avatar">
                    </li>
                    <li>
                        <a href="javascript:void(0);" title="Add Member"><i class="zmdi zmdi-plus-circle"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="chat-widget">
                    <ul class="chat-scroll-list clearfix">
                        <li class="left float-left">
                            <img src="<?= base_url(); ?>/public/assets/images/xs/avatar3.jpg" class="rounded-circle" alt="">
                            <div class="chat-info">
                                <a class="name" href="#">Alexander</a>
                                <span class="datetime">6:12</span>
                                <span class="message">Hello, John </span>
                            </div>
                        </li>
                        <li class="right">
                            <div class="chat-info"><span class="datetime">6:15</span> <span class="message">Hi, Alexander<br> How are you!</span> </div>
                        </li>
                        <li class="right">
                            <div class="chat-info"><span class="datetime">6:16</span> <span class="message">There are many variations of passages of Lorem Ipsum available</span> </div>
                        </li>
                        <li class="left float-left"> <img src="<?= base_url(); ?>/public/assets/images/xs/avatar2.jpg" class="rounded-circle" alt="">
                            <div class="chat-info"> <a class="name" href="#">Elizabeth</a> <span class="datetime">6:25</span> <span class="message">Hi, Alexander,<br> John <br> What are you doing?</span> </div>
                        </li>
                        <li class="left float-left"> <img src="<?= base_url(); ?>/public/assets/images/xs/avatar1.jpg" class="rounded-circle" alt="">
                            <div class="chat-info"> <a class="name" href="#">Michael</a> <span class="datetime">6:28</span> <span class="message">I would love to join the team.</span> </div>
                        </li>
                        <li class="right">
                            <div class="chat-info"><span class="datetime">7:02</span> <span class="message">Hello, <br>Michael</span> </div>
                        </li>
                    </ul>
                </div>
                <div class="input-group p-t-15">
                    <input type="text" class="form-control" placeholder="Enter text here...">
                    <span class="input-group-addon">
                        <i class="zmdi zmdi-mail-send"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>