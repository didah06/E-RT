<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Jadwal Transport
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Jadwal Transportasi</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Jadwal Transport</h2>
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
                                        <th class="text-center">#</th>
                                        <th width="10%">Status</th>
                                        <th width="30%">Jam Berangkat</th>
                                        <th width="30%">Jam Pulang</th>
                                        <th width="35%">Kode_booking</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jadwal_transport as $table) : ?>
                                        <tr>
                                            <td>
                                                <a href="<?= base_url('details_jadwal/' . $table->id_booking); ?>">
                                                    <button class="btn btn-info btn-icon hidden-sm-down float-right m-l-3" type="button">
                                                        <i class="zmdi zmdi-assignment"></i>
                                                    </button>
                                                </a>
                                            </td>
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
</section>
