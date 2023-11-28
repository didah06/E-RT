<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Porsi Makanan
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
                <h2>Porsi Makanan</h2>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Tambah Porsi Makanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('porsi'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Menu</label>
                                                <select class="form-control select-only" name="id_menu">
                                                    <option value="" selected disabled>- Pilih Menu -</option>
                                                    <?php foreach ($menu as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->date; ?><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Produksi</label>
                                                <input type="text" class="form-control divide" name="jumlah_produksi" id="jumlah_produksi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Pembagian</label>
                                                <input type="text" class="form-control divide" name="jumlah_pembagian" id="jumlah_pembagian">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Persediaan</label>
                                                <input type="text" class="form-control divide" name="jumlah_persediaan" id="jumlah_persediaan" readonly>
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
                                <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Porsi Makanan
                                    </i></button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('porsi') ?>">
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
                                        <th>Tanggal Produksi</th>
                                        <th>Sesi Menu</th>
                                        <th>Jumlah Produksi</th>
                                        <th>Jumlah Pembagian</th>
                                        <th>Jumlah Persediaan</th>
                                        <th>Keterangan</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($porsi as $table) : ?>
                                        <tr>
                                            <td class="text-center"> <input type="checkbox" class="delete-checkbox" data-id="<?= $table->id_porsi_makanan; ?>"></td>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_porsi_makanan; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->tgl_produksi; ?></td>
                                            <td><?= $table->sesi_menu; ?></td>
                                            <td><?= $table->jumlah_produksi; ?></td>
                                            <td><?= $table->jumlah_pembagian; ?></td>
                                            <td><?= $table->jumlah_persediaan; ?></td>
                                            <td><?= $table->keterangan; ?></td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/dapur/porsi_makanan/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
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
                                    <?= form_open(base_url('porsi'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_porsi_makanan">
                                    <div class="row clearfix">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Produksi</label>
                                                <input type="text" class="form-control" name="e_jumlah_produksi" id="e_jumlah_produksi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Pembagian</label>
                                                <input type="text" class="form-control" name="e_jumlah_pembagian" id="e_jumlah_pembagian">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Persediaan</label>
                                                <input type="text" class="form-control" name="e_jumlah_persediaan" id="e_jumlah_persediaan" readonly>
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
    $('.divide').divide();
    $(document).ready(function() {
        $('#jumlah_produksi, #jumlah_pembagian').on('change', function() {
            calculatePorsiPersediaan();
        })
        $('#e_jumlah_produksi, #e_jumlah_pembagian').on('change', function() {
            calculatePorsiPersediaanEdit();
        })
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
            $.getJSON("<?= base_url('porsi_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_porsi_makanan]').val(d['data'].id_porsi_makanan);
                    $('input[name=e_jumlah_produksi]').val(d['data'].jumlah_produksi);
                    $('input[name=e_jumlah_pembagian]').val(d['data'].jumlah_pembagian);
                    $('input[name=e_jumlah_persediaan]').val(d['data'].jumlah_persediaan);
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

    function calculatePorsiPersediaan() {
        var jumlah_produksi = parseInt($('#jumlah_produksi').siblings('input').val());
        var jumlah_pembagian = parseInt($('#jumlah_pembagian').siblings('input').val());

        var jumlah_persediaan = jumlah_produksi - jumlah_pembagian;

        $('#jumlah_persediaan').siblings('input').val(jumlah_persediaan).trigger('change');
        $('#jumlah_persediaan').val(jumlah_persediaan);
    }

    function calculatePorsiPersediaanEdit() {
        var jumlah_produksi = parseInt($('#e_jumlah_produksi').val());
        var jumlah_pembagian = parseInt($('#e_jumlah_pembagian').val());

        var e_jumlah_persediaan = jumlah_produksi - jumlah_pembagian;

        // $('#e_jumlah_persediaan').siblings('input').val(e_jumlah_persediaan).trigger('change');
        $('#e_jumlah_persediaan').val(e_jumlah_persediaan);
    }
</script>