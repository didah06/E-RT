<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Record Perjalanan
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Record Perjalanan</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Record Perjalanan</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="table-responsive">
                            <table id="datatables" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Kode_booking</th>
                                        <th>Tujuan</th>
                                        <th>Acara Kegiatan</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($record_perjalanan as $table) : ?>
                                        <tr>
                                            <td>
                                                <span class="<?= $table->status === 'selesai' ? 'badge badge-success' : '' ?>">
                                                    <?= $table->status === 'selesai' ? 'Selesai' : '' ?></span>
                                            </td>
                                            <td><?= $table->kode_booking; ?></td>
                                            <td><?= $table->tujuan; ?></td>
                                            <td><?= $table->acara_kegiatan; ?></td>
                                            <td><?= $table->nama; ?></td>
                                            <td><?= $table->departemen; ?></td>
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
</section>
