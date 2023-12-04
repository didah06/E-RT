<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Pengaduan dan Saran
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Pengaduan dan Saran</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Pengaduan dan Saran</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <a href="<?= base_url('pengaduan'); ?>" type="button" class="btn btn-danger">Kembali</a>
            </div>
            <div class="col-md-12">
                <div class="card patients-list" style="padding-bottom: 100%;">
                    <div class="body">
                        <h5><?= $seragam->departemen; ?> <?php echo ' - '; ?> <?= $seragam->jenis_seragam; ?></h5>
                        <?php foreach ($pengaduan as $table) : ?>
                            <div class="card-deck">
                                <div class="card">
                                    <div class="card-body">
                                       <p class="card-text"><?= $table->pengaduan; ?>, <?= $table->tgl_pengaduan; ?> </p>
                                        <p class="card-text"><?= $table->saran; ?></p>
                                        <p class="card-text"><small class="text-muted"><?= $table->created_by; ?></small></p>
                                        <p class="card-text"><small class="text-muted"><?= $table->created_at; ?></small></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
</section>
