<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Daftar Menu
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Daftar Menu</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Daftar Menu</h2>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Pemesanan Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('pemesanan'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Seragam</label>
                                                <select class="form-control select-only" name="id_seragam">
                                                    <option value="" selected disabled>- Pilih Seragam -</option>
                                                    <?php foreach ($seragam as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Vendor</label>
                                                <select class="form-control select-only" name="id_vendor">
                                                    <option value="" selected disabled>- Pilih Vendor -</option>
                                                    <?php foreach ($vendor as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pemesanan</label>
                                                <input type="date" class="form-control" name="tgl_pemesanan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Ukuran</label>
                                                <select class="form-control select-only" name="ukuran">
                                                    <option value="" selected disabled>- Pilih Ukuran -</option>
                                                    <option value="S">S</option>
                                                    <option value="M">M</option>
                                                    <option value="L">L</option>
                                                    <option value="XL">XL</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Pesanan</label>
                                                <input type="text" class="form-control divide" name="jumlah_pesanan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Biaya</label>
                                                <input type="text" class="form-control divide" name="biaya">
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Pemesanan Seragam
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
                                        <th class="text-center" width="15%">#</th>
                                        <th>Status</th>
                                        <th>Jenis Seragam</th>
                                        <th>Vendor</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Ukuran</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Biaya</th>
                                        <th>Tanggal Pengiriman</th>
                                        <th>Jumlah Dikirim</th>
                                        <th>created pengiriman by</th>
                                        <th>created pengiriman at</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>created diterima by</th>
                                        <th>created diterima at</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pemesanan as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if ($table->status === 'dipesan') : ?>
                                                    <span class="badge badge-info btn-edit" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalEditStatusDikirim" style="align-items: center; justify-content: center; width: 40px; height: 35px;">
                                                        <span class="zmdi zmdi-truck" style="font-size: 18px;"></span>
                                                    </span>
                                                <?php endif; ?>
                                                <?php if ($table->status === 'dikirim') : ?>
                                                    <span class="badge badge-info btn-edit" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalEditStatusDiterima" style="align-items: center; justify-content: center; width: 40px; height: 35px;">
                                                        <span class="zmdi zmdi-check" style="font-size: 18px;"></span>
                                                    </span>
                                                <?php endif; ?>
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                                <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pemesanan; ?>" type="button">
                                                    <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status === 'dipesan' ? 'badge badge-info' : ($table->status === 'dikirim' ? 'badge badge-warning' : 'badge badge-success'); ?>">
                                                    <?= $table->status === 'dipesan' ? 'dipesan' : ($table->status === 'dikirim' ? 'dikirim' : ($table->status === 'diterima' ? 'diterima' : $table->status)); ?></span>
                                            </td>
                                            <td><?= $table->jenis_seragam; ?></td>
                                            <td><?= $table->vendor; ?></td>
                                            <td><?= $table->tgl_pemesanan; ?></td>
                                            <td><?= $table->ukuran; ?></td>
                                            <td><?= $table->jumlah_pesanan; ?></td>
                                            <td><?= $table->biaya; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->tgl_pengiriman : '-'; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->jumlah_dikirim : '-'; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->created_pengiriman_by : '-'; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->created_pengiriman_at : '-'; ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->tgl_diterima : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->jumlah_diterima : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->created_terima_by : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->created_terima_at : '-' ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- update status dikirim -->
                    <!-- modal -->
                    <div class="modal fade" id="ModalEditStatusDikirim" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Pengiriman Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('update_status'), ['class' => 'update-dikirim']); ?>
                                    <input type="hidden" name="id_pemesanan">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pengiriman</label>
                                                <input type="date" class="form-control" name="tgl_pengiriman">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Dikirim</label>
                                                <input type="text" class="form-control divide" name="jumlah_dikirim">
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
                    <!-- update status diterima -->
                    <!-- modal -->
                    <div class="modal fade" id="ModalEditStatusDiterima" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Penerimaan Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('update_diterima'), ['class' => 'update-diterima']); ?>
                                    <input type="hidden" name="id_pemesanan">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Diterima</label>
                                                <input type="date" class="form-control" name="tgl_diterima">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Diterima</label>
                                                <input type="text" class="form-control divide" name="jumlah_diterima">
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
            $.getJSON("<?= base_url('update_status/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=id_pemesanan]').val(d['data'].id_pemesanan);
                }
            });
        });
        $('.update-dikirim').on('submit', function(e) {
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
        $('.update-diterima').on('submit', function(e) {
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
    });
</script>