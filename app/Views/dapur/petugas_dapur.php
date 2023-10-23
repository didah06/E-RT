<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Petugas Dapur
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Porsi Makanan</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Petugas Dapur</h2>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Tambah Petugas Dapur</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('petugas'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
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
                                            <label class="form-label">User</label>
                                            <select class="form-control select-only" name="id_shift">
                                                <option value="" selected disabled>- Pilih Shift -</option>
                                                <?php foreach ($shift as $item) : ?>
                                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" name="nama">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto" accept="image/png, image/jpeg, image/jpg">
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
                        <div class="row">
                            <div class="text-start">
                                <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Petugas Dapur
                                    </i></button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nama</th>
                                        <th>Shift</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($petugas_dapur as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_petugas_dapur; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->nama; ?></td>
                                            <td><?= $table->shift; ?></td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/dapur/petugas_dapur/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
                                            </td>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Porsi Makanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('petugas'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_petugas_dapur">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <label class="form-label">User</label>
                                            <select class="form-control select-only" name="e_user_id">
                                                <option value="" selected disabled>- Pilih User -</option>
                                                <?php foreach ($ms_user as $item) : ?>
                                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">User</label>
                                            <select class="form-control select-only" name="e_id_shift">
                                                <option value="" selected disabled>- Pilih Shift -</option>
                                                <?php foreach ($shift as $item) : ?>
                                                    <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" name="e_nama">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="e_foto" accept="image/png, image/jpeg, image/jpg">
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
            var formData = new FormData(this);
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: formData,
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
                        Swal.fire('Tambah data gagal', d['msg'], 'error');
                    }
                }
            })
        })
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('petugas_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_petugas_dapur]').val(d['data'].id_petugas_dapur);
                    $('select[name=e_user_id]').val(d['data'].user_id).trigger('change');
                    $('input[name=e_nama]').val(d['data'].nama);
                    $('select[name=e_id_shift]').val(d['data'].id_shift).trigger('change');
                }
            });
        });
        $('select[name=user_id]').on('change', function() {
            $.getJSON("<?= base_url('select_user'); ?>/" + $(this).val(), function(d) {
                if (d['status'] === true) {
                    $('input[name=nama]').val(d['data'].nama);
                }
            });
        });
        $('select[name=e_user_id]').on('change', function() {
            $.getJSON("<?= base_url('select_user'); ?>/" + $(this).val(), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_nama]').val(d['data'].nama);
                }
            });
        });
        $('.update-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var formData = new FormData(this);
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: formData,
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
        //filter datatable
        $('.form-filter').on('submit', function(e) {
            e.preventDefault();
            // Get values from the select elements
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            $('#dataTable').html(loadingPage());
            // Send an AJAX request to the filterData method
            $.ajax({
                url: e.target.action,
                type: 'POST',
                dataType: 'json',
                data: {
                    bulan: bulan,
                    tahun: tahun
                },
                success: function(data) {
                    // Display filtered data
                    $('#dataTable').html(data);
                }
            });
        });
        // delete table
        $('#delete-selected').on('click', function() {
            var idsToDelete = [];

            // Find the checkboxes that are checked
            $('.delete-checkbox:checked').each(function() {
                idsToDelete.push($(this).data('id'));
            });

            if (idsToDelete.length === 0) {
                alert('Please select items to delete.');
                return;
            }

            // Send an AJAX request to the CodeIgniter Controller to delete the selected items
            $.ajax({
                method: 'POST',
                url: "<?= base_url('porsi_delete'); ?>", // Send data as POST, not in the URL
                data: {
                    id_porsi_makanan: idsToDelete
                },
                error: function(xhr) {
                    Swal.fire('Hapus gagal', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
                },
                success: function(d) {
                    if (d.success) {
                        location.reload();
                    } else {
                        invalidError(d);
                        Swal.fire('Hapus gagal', d.msg, 'error');
                    }
                }
            });
        });
    })
</script>