<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Kebersihan Dapur
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Kebersihan Dapur</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Kebersihan Dapur</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('penilaian'); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" name="today" value="<?= $today; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3">
                                            <button class="btn btn-warning" type="submit">search menu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="d-flex justify-content-around">
                                <div class="card-deck p-5">
                                    <?php foreach ($daftar_menu as $menu_today) : ?>
                                        <?php if ($menu_today->sesi_menu == 'pagi') : ?>
                                            <div class="card border-warning mb-3">
                                                <div class="card-header"><?= $menu_today->sesi_menu; ?></div>
                                                <div class="card-body text-warning">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <button class="btn btn-info">Penilaian & Saran</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($menu_today->sesi_menu == 'siang') : ?>
                                            <div class="card border-info mb-3">
                                                <div class="card-header"><?= $menu_today->sesi_menu; ?></div>
                                                <div class="card-body text-info">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <button class="btn btn-info">Penilaian & Saran</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($menu_today->sesi_menu == 'malam') : ?>
                                            <div class="card  border-success mb-3">
                                                <div class="card-header"><?= $menu_today->sesi_menu; ?></div>
                                                <div class="card-body text-success">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <button class="btn btn-info">Penilaian & Saran</button>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>