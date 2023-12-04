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
                    <!-- modal -->
                    <div class="modal fade" id="Modaladd" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Pemantauan Kebersihan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('kebersihan'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pemantauan</label>
                                                <input type="date" class="form-control" name="tgl_pemantauan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Shift</label>
                                                <select class="form-control select-only" name="id_shift">
                                                    <option value="" selected disabled>- Pilih Shift -</option>
                                                    <?php foreach ($shift as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Area</label>
                                                <select class="form-control select-only" name="id_area">
                                                    <option value="" selected disabled>- Pilih Area -</option>
                                                    <?php foreach ($area as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" name="keterangan">
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
                                <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Pemantauan Kebersihan
                                    </i></button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('kebersihan') ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label">min date</label>
                                            <input type="date" class="form-control" name="start_date" id="min" value="<?= $start_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label">max date</label>
                                            <input type="date" class="form-control" name="end_date" id="max" value="<?= $end_date; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3">
                                            <button class="btn btn-warning" type="submit">filter</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <button class="btn btn-danger mb-3" id="delete-selected">Delete</button>
                                <thead>
                                    <tr>
                                        <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th>
                                        <th class="text-center">#</th>
                                        <th>Tanggal Pemantauan</th>
                                        <th>Shift</th>
                                        <th>Area</th>
                                        <th>Foto</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($kebersihan as $table) : ?>
                                        <tr>
                                            <td class="text-center"> <input type="checkbox" class="delete-checkbox" data-id="<?= $table->id_kebersihan_dapur; ?>"></td>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_kebersihan_dapur; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->tgl_pemantauan; ?></td>
                                            <td><?= $table->shift; ?></td>
                                            <td><?= $table->area; ?></td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/dapur/kebersihan_dapur/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $table->keterangan; ?></td>
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
                                    <?= form_open(base_url('kebersihan'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_kebersihan_dapur">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pemantauan</label>
                                                <input type="date" class="form-control" name="e_tgl_pemantauan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Shift</label>
                                                <select class="form-control select-only" name="e_id_shift">
                                                    <option value="" selected disabled>- Pilih Shift -</option>
                                                    <?php foreach ($shift as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Area</label>
                                                <select class="form-control select-only" name="e_id_area">
                                                    <option value="" selected disabled>- Pilih Area -</option>
                                                    <?php foreach ($area as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="e_foto" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Keterangan</label>
                                                <input type="text" class="form-control" name="e_keterangan">
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
       $('#dataTable').on('click', '.btn-edit', function() {
            $.getJSON("<?= base_url('kebersihan_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_kebersihan_dapur]').val(d['data'].id_kebersihan_dapur);
                    $('input[name=e_tgl_pemantauan]').val(d['data'].tgl_pemantauan);
                    $('select[name=e_id_shift]').val(d['data'].id_shift).trigger('change');
                    $('select[name=e_id_area]').val(d['data'].id_area).trigger('change');
                    $('input[name=e_keterangan]').val(d['data'].keterangan);
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
        $('#dataTable').on('click', '#delete-selected', function() {
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
                url: "<?= base_url('kebersihan_delete'); ?>", // Send data as POST, not in the URL
                data: {
                    id_kebersihan_dapur: idsToDelete
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
