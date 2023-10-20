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
                    <div class="modal fade" id="Modaladd" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Daftar Menu</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('menu'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Menu</label>
                                                <input type="date" class="form-control" name="tgl_menu">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 1</label>
                                                <input type="text" class="form-control" name="menu_1">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 2</label>
                                                <input type="text" class="form-control" name="menu_2">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 3</label>
                                                <input type="text" class="form-control" name="menu_3">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 4</label>
                                                <input type="text" class="form-control" name="menu_4">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Sesi Menu</label>
                                                <select class="form-control select-only" name="id_sesi_menu">
                                                    <option value="" selected disabled>- Pilih Sesi Menu -</option>
                                                    <?php foreach ($sesi_menu as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Daftar Menu
                                </i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <!-- <button class="btn btn-danger mb-3" id="delete-selected">Delete</button> -->
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th> -->
                                        <th class="text-center">#</th>
                                        <th>Tanggal Menu</th>
                                        <th>Menu 1</th>
                                        <th>Menu 2</th>
                                        <th>Menu 3</th>
                                        <th>Menu 4</th>
                                        <th>Sesi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($daftar_menu as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_menu; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                                <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_menu; ?>" type="button">
                                                    <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->tgl_menu; ?></td>
                                            <td><?= $table->menu_1; ?></td>
                                            <td><?= $table->menu_2; ?></td>
                                            <td><?= $table->menu_3; ?></td>
                                            <td><?= $table->menu_4; ?></td>
                                            <td><?= $table->sesi_menu; ?></td>
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
                                    <?= form_open(base_url('menu'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_menu">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Menu</label>
                                                <input type="date" class="form-control" name="e_tgl_menu">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 1</label>
                                                <input type="text" class="form-control" name="e_menu_1">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 2</label>
                                                <input type="text" class="form-control" name="e_menu_2">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 3</label>
                                                <input type="text" class="form-control" name="e_menu_3">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu 4</label>
                                                <input type="text" class="form-control" name="e_menu_4">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Sesi Menu</label>
                                                <select class="form-control select-only" name="e_id_sesi_menu">
                                                    <option value="" selected disabled>- Pilih Sesi Menu -</option>
                                                    <?php foreach ($sesi_menu as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('menu_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_menu]').val(d['data'].id_menu);
                    $('input[name=e_tgl_menu]').val(d['data'].tgl_menu);
                    $('input[name=e_menu_1]').val(d['data'].menu_1);
                    $('input[name=e_menu_2]').val(d['data'].menu_2);
                    $('input[name=e_menu_3]').val(d['data'].menu_3);
                    $('input[name=e_menu_4]').val(d['data'].menu_4);
                    $('select[name=e_id_sesi_menu').val(d['data'].id_sesi_menu).trigger('change');
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
        $('.btn-delete').on('click', function() {
            var menuId = $(this).data('id');
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
                        url: "<?= base_url('menu_delete'); ?>/" + menuId,
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