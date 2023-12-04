<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Infomasi
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Informasi</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Informasi</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <!-- modal -->
                    <div class="modal fade" id="FormInformasi" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Form Informasi</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('keamanan'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" name="nama_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tipe Kegiatan</label>
                                                <select class="form-control select-only" name="type_kegiatan">
                                                    <option value="" selected disabled>- Pilih Tipe Kegiatan -</option>
                                                    <option value="internal">Internal</option>
                                                    <option value="eksternal">Eksternal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Kegiatan</label>
                                                <input type="date" class="form-control" min="<?= date('Y-m-d', strtotime('-0 day')) ?>" name="tgl_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Kegiatan</label>
                                                <input type="time" class="form-control" name="waktu_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tempat Kegiatan</label>
                                                <input type="text" class="form-control" name="tempat_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center pt-3 pb-3">
                                    <button type="submit" class="btn btn-success btn-round btn-save">Simpan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <div class="body">
                        <div class="row mb-5">
                            <button class="btn btn-info" data-toggle="modal" data-target="#FormInformasi"><i class="zmdi zmdi-plus">Informasi
                                </i></button>
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="12%">#</th>
                                        <th>Nama Kegiatan</th>
                                        <th>Tipe Kegiatan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Waktu Kegiatan</th>
                                        <th>Tempat Kegiatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($informasi as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_informasi; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                                <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_informasi; ?>" type="button">
                                                    <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->nama_kegiatan; ?></td>
                                            <td><?= $table->type_kegiatan; ?></td>
                                            <td><?= $table->tgl_kegiatan; ?></td>
                                            <td><?= $table->waktu_kegiatan; ?></td>
                                            <td><?= $table->tempat_kegiatan; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- modal -->
                    <div class="modal fade" id="ModalEdit" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Informasi</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('keamanan'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_informasi">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kegiatan</label>
                                                <input type="text" class="form-control" name="e_nama_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tipe Kegiatan</label>
                                                <select class="form-control select-only" name="e_type_kegiatan">
                                                    <option value="" selected disabled>- Pilih Tipe Kegiatan -</option>
                                                    <option value="internal">Internal</option>
                                                    <option value="eksternal">Eksternal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Kegiatan</label>
                                                <input type="date" class="form-control" min="<?= date('Y-m-d', strtotime('-0 day')) ?>" name="e_tgl_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Waktu Kegiatan</label>
                                                <input type="time" class="form-control" name="e_waktu_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tempat Kegiatan</label>
                                                <input type="text" class="form-control" name="e_tempat_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center pt-3 pb-3">
                                    <button type="submit" class="btn btn-success btn-round btn-save">Simpan</button>
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
    $(document).ready(function() {
        $('.add-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
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
                        Swal.fire('Tambah data gagal', d['msg'], 'error');
                    }
                }
            })
        })
        $('#datatables').on('click', '.btn-edit', function() {
            $.getJSON("<?= base_url('informasi_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_informasi]').val(d['data'].id_informasi);
                    $('input[name=e_nama_kegiatan]').val(d['data'].nama_kegiatan);
                    $('input[name=e_tgl_kegiatan]').val(d['data'].tgl_kegiatan);
                    $('input[name=e_waktu_kegiatan]').val(d['data'].waktu_kegiatan);
                    $('input[name=e_tempat_kegiatan]').val(d['data'].tempat_kegiatan);
                    $('select[name=e_type_kegiatan').val(d['data'].type_kegiatan).trigger('change');
                }
            });
        });
        $('.update-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
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
        $('#datatables').on('click', '.btn-delete', function() {
            var informasiId = $(this).data('id');
            Swal.fire({
                title: 'Apa anda yakin?',
                text: 'Data ini akan dihapus dan tidak bisa dikembalikan lagi!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                confirmButtonColor: '#fd625e',
                cancelButtonText: 'Batal',
            }).then(function(result) {
                if (result.value) {
                    processStart();
                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                       url: "<?= base_url('keamanan/delete'); ?>/" + informasiId,
                        error: function(xhr) {
                            processDone();
                            Swal.fire('Hapus gagal', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
                        },
                        success: function(d) {
                            if (d['success'] > 0) {
                                location.reload();
                            } else {
                                processDone();
                                invalidError(d);
                                Swal.fire('Hapus gagal', d['msg'], 'error');
                            }
                        }
                    })
                }
            });
        });
    })
</script>
