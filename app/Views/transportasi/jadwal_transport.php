<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Master User
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Master User</li>
                </ul>
            </div>
            <div class="btn-user pt-3 pl-3">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="zmdi zmdi-plus-circle"></i>Form Pengajuan Kendaraan</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="10%">#</th>
                                        <th>Kode Booking</th>
                                        <th>Tanggal Pemakaian</th>
                                        <th>Tujuan</th>
                                        <th>Acara Kegiatan</th>
                                        <th>Departemen</th>
                                        <th>Divisi</th>
                                        <th>Direktorat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($booking as $table) : ?>
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning btn-icon btn-round hidden-sm-down float-right m-l-3 btn-edit" data-id="<?= $table->id_booking; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-icon btn-round hidden-sm-down float-right  m-l-3 btn-delete" data-id="<?= $table->id_booking; ?>" type="button">
                                                    <i class="zmdi zmdi-delete"></i>
                                                </button>
                                            </td>
                                            <td><?= $table->kode_booking; ?></td>
                                            <td><?= $table->tgl_pemakaian; ?></td>
                                            <td><?= $table->tujuan; ?></td>
                                            <td><?= $table->acara_kegiatan; ?>
                                            <td><?= $table->departemen ? $table->departemen : '-'; ?></td>
                                            <td><?= $table->divisi ? $table->divisi : '-'; ?></td>
                                            <td><?= $table->direktorat ? $table->direktorat : '-'; ?></td>
                                            <td>
                                                <span class="badge badge-soft-<?= $table->is_aktif == 1 ? 'success' : 'danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                            </td>
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