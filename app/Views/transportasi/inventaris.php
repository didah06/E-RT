<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Transportasi
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Transportasi</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Transportasi</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="row">
                            <button class="btn btn-info" data-toggle="modal" data-target="#ModalAdd"><i class="zmdi zmdi-collection-plus"> Tambah Transport</i></button>
                        </div>
                        <div class="row pt-5">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Jenis Kendaraan</th>
                                            <th>Merk</th>
                                            <th>Brand</th>
                                            <th>Warna</th>
                                            <th>Tahun Kendaraan</th>
                                            <th>No Polisi</th>
                                            <th>Tanggal STNK</th>
                                            <th>Kapasitas</th>
                                            <th>Jumlah Kendaraan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($inventaris_transport as $table) : ?>
                                            <tr>
                                                <td>
                                                    <a href=" <?= base_url('pemeliharaan/' . $table->id_kendaraan); ?>">
                                                        <span class="badge badge-info" style="align-items: center; justify-content: center;">
                                                            <span class=" zmdi zmdi-assignment-check" style="font-size: 18px;"></span>
                                                        </span>
                                                    </a>
                                                    <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center;" data-id="<?= $table->id_kendaraan; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                        <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                        </button>
                                                </td>
                                                <td><?= $table->jenis_kendaraan; ?></td>
                                                <td><?= $table->merk; ?></td>
                                                <td><?= $table->brand; ?></td>
                                                <td><?= $table->warna; ?></td>
                                                <td><?= $table->tahun_kendaraan; ?></td>
                                                <td><?= $table->no_polisi; ?></td>
                                                <td><?= $table->tgl_stnk; ?></td>
                                                <td><?= $table->kapasitas; ?></td>
                                                <td><?= $table->jml_kendaraan; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="ModalAdd" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Tambah Data Transport</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('inventaris_save'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <label class="form-label">Jenis Kendaraan</label>
                                            <input type="text" class="form-control" name="jenis_kendaraan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Merk</label>
                                            <input type="text" class="form-control" name="merk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Brand</label>
                                            <input type="text" class="form-control" name="brand">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">warna</label>
                                            <input type="text" class="form-control" name="warna">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Kapasitas</label>
                                            <input type="text" class="form-control divide" name="kapasitas">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Jumlah Kendaraan</label>
                                            <input type="text" class="form-control divide" name="jml_kendaraan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No Polisi</label>
                                            <input type="text" class="form-control" name="no_polisi">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Tahun Kendaraan</label>
                                            <select class="form-control" name="tahun_kendaraan">
                                                <?php
                                                for ($year = (int)date('Y'); 1900 <= $year; $year--) : ?>
                                                    <option value="<?= $year; ?>"><?= $year; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Tanggal STNK</label>
                                            <input type="date" class="form-control" name="tgl_stnk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Foto STNK</label>
                                            <input type="file" class="form-control" accept="image/png, image/jpeg, image/jpg" name="foto_stnk" id="foto_stnk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success btn-round">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="ModalEdit" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Data Transport</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('/inventaris'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_kendaraan">
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                            <label class="form-label">Jenis Kendaraan</label>
                                            <input type="text" class="form-control" name="e_jenis_kendaraan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Merk</label>
                                            <input type="text" class="form-control" name="e_merk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Brand</label>
                                            <input type="text" class="form-control" name="e_brand">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">warna</label>
                                            <input type="text" class="form-control" name="e_warna">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Kapasitas</label>
                                            <input type="text" class="form-control" name="e_kapasitas">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Jumlah Kendaraan</label>
                                            <input type="text" class="form-control" name="e_jml_kendaraan">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">No Polisi</label>
                                            <input type="text" class="form-control" name="e_no_polisi">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Tahun Kendaraan</label>
                                            <select class="form-control" name="e_tahun_kendaraan">
                                                <?php
                                                for ($year = (int)date('Y'); 1900 <= $year; $year--) : ?>
                                                    <option value="<?= $year; ?>"><?= $year; ?></option>
                                                <?php endfor; ?>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Tanggal STNK</label>
                                            <input type="date" class="form-control" name="e_tgl_stnk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Foto STNK</label>
                                            <input type="file" class="form-control" accept="image/png, image/jpeg, image/jpg" name="e_foto_stnk">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success btn-round">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end modal -->
                    </div>
                </div>
            </div>
        </div>
</section>
<script>
    $('.divide').divide();
    $(document).ready(function() {
        $('.add-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var f_data = new FormData(this);
            $.ajax({
                url: e.target.action,
                data: f_data,
                type: 'post',
                dataType: 'json',
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                error: function(xhr) {
                    processDone();
                    invalidError({
                        'error': 'Error ' + xhr.status + ' : ' + xhr.statusText
                    });
                },
                success: function(d) {
                    if (d['success']) {
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                    }
                }
            })
        });
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('inventaris_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_kendaraan]').val(d['data'].id_kendaraan);
                    $('input[name=e_jenis_kendaraan]').val(d['data'].jenis_kendaraan);
                    $('input[name=e_merk]').val(d['data'].merk);
                    $('input[name=e_brand]').val(d['data'].brand);
                    $('input[name=e_warna]').val(d['data'].warna);
                    $('input[name=e_cara_pemakaian').val(d['data'].cara_pemakaian);
                    $('input[name=e_kapasitas]').val(d['data'].kapasitas);
                    $('input[name=e_jml_kendaraan]').val(d['data'].jml_kendaraan);
                    $('input[name=e_no_polisi]').val(d['data'].no_polisi);
                    $('select[name=e_tahun_kendaraan]').val(d['data'].tahun_kendaraan).trigger('change');;
                    $('input[name=e_tgl_stnk]').val(d['data'].tgl_stnk);
                }
            });
        });
        $('.update-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var f_data = new FormData(this);
            $.ajax({
                url: e.target.action,
                data: f_data,
                type: 'post',
                dataType: 'json',
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                error: function(xhr) {
                    processDone();
                    invalidError({
                        'error': 'Error ' + xhr.status + ' : ' + xhr.statusText
                    });
                },
                success: function(d) {
                    if (d['success']) {
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                    }
                }
            })
        });
    });
</script>