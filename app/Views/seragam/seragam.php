<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Seragam
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Seragam</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Seragam</h2>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('seragam'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Departemen</label>
                                                <select class="form-control select-only" name="id_dept">
                                                    <option value="" selected disabled>- Pilih Departemen -</option>
                                                    <?php foreach ($departemen as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Seragam</label>
                                                <input type="text" class="form-control" name="jenis_seragam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="gambar" accept="image/png, image/jpeg, image/jpg">
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Seragam
                                </i></button>
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Departemen</th>
                                        <th>Jenis Seragam</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($seragam as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_seragam; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->departemen; ?></td>
                                            <td><?= $table->jenis_seragam; ?></td>
                                            <td>
                                                <?php if ($table->gambar != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/seragam/gambar/' . $table->gambar) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
                                                <?php else : ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- modal edit -->
                    <div class="modal fade" id="ModalEdit" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('seragam_update'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="e_id_seragam">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Departemen</label>
                                                <select class="form-control select-only" name="e_id_dept">
                                                    <option value="" selected disabled>- Pilih Departemen -</option>
                                                    <?php foreach ($departemen as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jenis Seragam</label>
                                                <input type="text" class="form-control" name="e_jenis_seragam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="e_gambar" accept="image/png, image/jpeg, image/jpg">
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
        $('#datatables').on('click', '.btn-edit', function() {
            $.getJSON("<?= base_url('seragam_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_seragam]').val(d['data'].id_seragam);
                    $('input[name=e_jenis_seragam]').val(d['data'].jenis_seragam);
                    $('select[name=e_id_dept]').val(d['data'].id_dept).trigger('change');
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
    });
</script>
