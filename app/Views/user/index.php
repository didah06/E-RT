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
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="zmdi zmdi-plus-circle"></i>Tambah User</button>
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
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>No Hp</th>
                                        <th>role</th>
                                        <th>Jabatan</th>
                                        <th>Departemen</th>
                                        <th>Divisi</th>
                                        <th>Direktorat</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $table) : ?>
                                        <tr>
                                            <td>
                                                <button class="btn btn-warning btn-icon hidden-sm-down float-right m-l-3 btn-edit" data-id="<?= $table->user_id; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit"></i>
                                                </button>
                                            </td>
                                            <td><?= $table->nama; ?></td>
                                            <td><?= $table->username; ?></td>
                                            <td><?= $table->jk; ?></td>
                                            <td><?= $table->hp ? $table->hp : '-' ?>
                                            <td><?= $table->role; ?>
                                            <td><?= $table->jabatan; ?></td>
                                            <td><?= $table->departemen ? $table->departemen : '-'; ?></td>
                                            <td><?= $table->divisi ? $table->divisi : '-'; ?></td>
                                            <td><?= $table->direktorat ? $table->direktorat : '-'; ?></td>
                                            <td>
                                                <span class="<?= $table->is_aktif == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
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
    <!-- User add -->
    <!-- modal -->
    <div class="modal fade" id="myModal" data-backdrop="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Tambah Master User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-area"></div>
                    <?= form_open(base_url('user'), ['class' => 'add-form']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">User</label>
                            <select class="form-control select-only" name="user_id">
                                <option value="" selected disabled>- Pilih User -</option>
                                <?php foreach ($ms_user as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Role</label>
                            <select class="form-control show-tick" name="role">
                                <option value="" selected disabled>- Pilih Role -</option>
                                <?php foreach ($role as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Direktorat</label>
                            <select class="form-control show-tick" name="id_direktorat">
                                <option value="" selected disabled>- Pilih Direktorat -</option>
                                <?php foreach ($direktorat as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Divisi</label>
                            <select class="form-control show-tick" name="id_divisi">
                                <option value="" selected disabled>- Pilih Divisi -</option>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Departemen</label>
                            <select class="form-control show-tick" name="id_dept">
                                <option value="" selected disabled>- Pilih Departemen -</option>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="nama">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Jabatan</label>
                            <input class="form-control" type="text" name="jabatan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control select-only" name="jk">
                                <option value="" selected disabled>-Pilih Jenis Kelamin-</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>No Hp</label>
                            <input class="form-control" type="text" name="hp">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tempat Lahir</label>
                            <input class="form-control" type="text" name="tmpt_lahir">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input class="form-control" type="date" name="tgl_lahir">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
    <!-- User Edit -->
    <!-- modal -->
    <div class="modal fade" id="ModalEdit" data-backdrop="false" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Master User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error-area"></div>
                    <?= form_open(base_url('user'), ['class' => 'update-form']); ?>
                    <input type="hidden" name="_method" value="PUT" />
                    <input type="hidden" name="e_user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Role</label>
                            <select class="form-control show-tick" name="e_role">
                                <option value="" selected disabled>- Pilih Role -</option>
                                <?php foreach ($role as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Direktorat</label>
                            <select class="form-control show-tick" name="e_id_direktorat">
                                <option value="" selected disabled>- Pilih Direktorat -</option>
                                <?php foreach ($direktorat as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>

                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Divisi</label>
                            <select class="form-control show-tick" name="e_id_divisi">
                                <option value="" selected disabled>- Pilih Divisi -</option>
                                <?php foreach ($divisi as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Departemen</label>
                            <select class="form-control show-tick" name="e_id_dept">
                                <option value="" selected disabled>- Pilih Departemen -</option>
                                <?php foreach ($departemen as $item) : ?>
                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama</label>
                            <input class="form-control" type="text" name="e_nama">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Jabatan</label>
                            <input class="form-control" type="text" name="e_jabatan">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Jenis Kelamin</label>
                            <select class="form-control select-only" name="e_jk">
                                <option value="" selected disabled>-Pilih Jenis Kelamin-</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>No Hp</label>
                            <input class="form-control" type="text" name="e_hp">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tempat Lahir</label>
                            <input class="form-control" type="text" name="e_tmpt_lahir">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal Lahir</label>
                            <input class="form-control" type="date" name="e_tgl_lahir">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="text-center mb-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal -->
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
                    if (d['success'] > 0) {
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                    }
                }
            })
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
                    if (d['success'] > 0) {
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                    }
                }
            })
        });
        $('.btn-delete').on('click', function() {
            var userId = $(this).data('id');
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
                        url: "<?= base_url('user/delete'); ?>",
                        data: {
                            user_id: userId
                        },
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
        $('select[name=user_id]').on('change', function() {
            $.getJSON("<?= base_url('select_user'); ?>/" + $(this).val(), function(d) {
                if (d['status'] === true) {
                    $('input[name=nama]').val(d['data'].nama);
                    $('input[name=jabatan]').val(d['data'].jabatan);
                    $('input[name=hp').val(d['data'].hp);
                    $('select[name=jk]').val(d['data'].jk).trigger('change');
                    $('input[name=tmpt_lahir]').val(d['data'].tmpt_lahir);
                    $('input[name=tgl_lahir]').val(d['data'].tgl_lahir);
                    if (d['data'].jabatan.indexOf("Direktur") >= 0 || d['data'].jabatan.indexOf("Pembina") >= 0 || d['data'].jabatan.indexOf("Pengawas") >= 0) {
                        $('select[name=id_divisi]').attr('disabled', 'disabled');
                        $('select[name=id_divisi]').selectpicker('refresh');
                        $('select[name=id_dept]').attr('disabled', 'disabled');
                        $('select[name=id_dept]').selectpicker('refresh');
                    } else if (d['data'].jabatan.indexOf("Kepala Divisi") >= 0 || d['data'].jabatan.indexOf("Waka. Pengasuh") >= 0 || d['data'].jabatan.indexOf("Kepala Departemen QA/QC") >= 0) {
                        $('select[name=id_dept]').attr('disabled', 'disabled');
                        $('select[name=id_dept]').selectpicker('refresh');
                    }
                } else {
                    $('select[name=id_divisi]').removeAttr('disabled')
                    $('select[name=id_divisi]').selectpicker('refresh')
                    $('select[name=id_dept]').removeAttr('disabled')
                    $('select[name=id_dept]').selectpicker('refresh')
                }
            });
        });
        $('select[name=id_direktorat]').on('change', function() {
            if ($(this).val() > 0) {
                $('select[name=id_divisi]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name=id_divisi]').selectpicker('refresh');
                $.get("<?= base_url('select_divisi'); ?>/" + $(this).val(), function(d) {
                    $('select[name=id_divisi]').html(d);
                    $('select[name=id_divisi]').selectpicker('refresh');
                });
            }
        });
        $('select[name=id_divisi]').on('change', function() {
            if ($(this).val() > 0) {
                $('select[name=id_dept]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name=id_dept]').selectpicker('refresh');
                $.get("<?= base_url('select_departemen'); ?>/" + $(this).val(), function(d) {
                    $('select[name=id_dept]').html(d);
                    $('select[name=id_dept]').selectpicker('refresh');
                });
            }
        });
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('user_edit'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_user_id]').val(d['data'].user_id);
                    $('select[name=e_role]').val(d['data'].role).trigger('change');
                    $('select[name=e_id_direktorat]').val(d['data'].id_direktorat).trigger('change');
                    $('select[name=e_id_divisi').val(d['data'].id_divisi).trigger('change');
                    $('select[name=e_id_dept]').val(d['data'].id_dept).trigger('change');
                    $('input[name=e_nama]').val(d['data'].nama);
                    $('input[name=e_jabatan]').val(d['data'].jabatan);
                    $('input[name=e_hp]').val(d['data'].hp);
                    $('select[name=e_jk]').val(d['data'].jk).trigger('change');
                    $('input[name=e_tmpt_lahir]').val(d['data'].tmpt_lahir);
                    $('input[name=e_tgl_lahir]').val(d['data'].tgl_lahir);
                    if (d['data'].jabatan.indexOf("Direktur") >= 0 || d['data'].jabatan.indexOf("Pembina") >= 0 || d['data'].jabatan.indexOf("Pengawas") >= 0) {
                        $('select[name=e_id_divisi]').attr('disabled', 'disabled');
                        $('select[name=e_id_divisi]').selectpicker('refresh');
                        $('select[name=e_id_dept]').attr('disabled', 'disabled');
                        $('select[name=e_id_dept]').selectpicker('refresh');
                    } else if (d['data'].jabatan.indexOf("Kepala Divisi") >= 0 || d['data'].jabatan.indexOf("Waka. Pengasuh") >= 0 || d['data'].jabatan.indexOf("Kepala Departemen QA/QC") >= 0) {
                        $('select[name=e_id_dept]').attr('disabled', 'disabled');
                        $('select[name=e_id_dept]').selectpicker('refresh');
                    }
                } else {
                    $('select[name=e_id_divisi]').removeAttr('disabled')
                    $('select[name=e_id_divisi]').selectpicker('refresh')
                    $('select[name=e_id_dept]').removeAttr('disabled')
                    $('select[name=e_id_dept]').selectpicker('refresh')
                }
            });
        });
    });
</script>