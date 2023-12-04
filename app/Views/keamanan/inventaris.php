<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Inventaris
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Inventaris</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Inventaris</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <!-- modal -->
                    <div class="modal fade" id="FormInventaris" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Form Inventaris</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('inventaris_keamanan'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Barang</label>
                                                <select class="form-control select-only" name="id_barang">
                                                    <option value="" selected disabled>- Pilih Barang -</option>
                                                    <?php foreach ($barang as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pengadaan Barang</label>
                                                <input type="date" class="form-control" name="tgl_pengadaan_barang">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kondisi</label>
                                                <select class="form-control select-only" name="id_kondisi">
                                                    <option value="" selected disabled>- Pilih Kondisi -</option>
                                                    <?php foreach ($kondisi as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tempat Barang Disimpan</label>
                                                <input type="text" class="form-control" name="tempat_barang_disimpan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Posisi Barang</label>
                                                <select class="form-control select-only" name="posisi_barang">
                                                    <option value="" selected disabled>- Pilih Posisi Barang -</option>
                                                    <option value="tersedia">Tersedia</option>
                                                    <option value="dipinjam">Dipinjam</option>
                                                    <option value="dipakai">Dipakai</option>
                                                </select>
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
                        <div class="row mb-5">
                            <button class="btn btn-info" data-toggle="modal" data-target="#FormInventaris"><i class="zmdi zmdi-plus">Inventaris
                                </i></button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="12%">#</th>
                                        <th>Nama Barang</th>
                                        <th>Tanggal Pengadaan Barang</th>
                                        <th>Kondisi</th>
                                        <th>Tempat Barang Disimpan</th>
                                        <th>Posisi Barang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventaris as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_inventaris; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                                <?php if ($table->kondisi === 'Rusak') : ?>
                                                    <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_inventaris; ?>" type="button">
                                                        <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $table->nama_barang; ?></td>
                                            <td><?= $table->tgl_pengadaan_barang; ?></td>
                                            <td><?= $table->kondisi; ?></td>
                                            <td><?= $table->tempat_barang_disimpan; ?></td>
                                            <td><?= $table->posisi_barang; ?></td>
                                            <td><?= $table->is_aktif == 1 ? 'Aktif' : '' ?></td>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Inventaris Barang Keamanan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('inventaris_keamanan'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_inventaris">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Barang</label>
                                                <select class="form-control select-only" name="e_id_barang">
                                                    <option value="" selected disabled>- Pilih Barang -</option>
                                                    <?php foreach ($barang as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pengadaan Barang</label>
                                                <input type="date" class="form-control" name="e_tgl_pengadaan_barang">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Kondisi</label>
                                                <select class="form-control select-only" name="e_id_kondisi">
                                                    <option value="" selected disabled>- Pilih Kondisi -</option>
                                                    <?php foreach ($kondisi as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tempat Barang Disimpan</label>
                                                <input type="text" class="form-control" name="e_tempat_barang_disimpan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Posisi Barang</label>
                                                <select class="form-control select-only" name="e_posisi_barang">
                                                    <option value="" selected disabled>- Pilih Posisi Barang -</option>
                                                    <option value="tersedia">Tersedia</option>
                                                    <option value="dipinjam">Dipinjam</option>
                                                    <option value="dipakai">Dipakai</option>
                                                </select>
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
            $.getJSON("<?= base_url('inventaris_keamanan_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_inventaris]').val(d['data'].id_inventaris);
                    $('select[name=e_id_barang]').val(d['data'].id_barang).trigger('change');
                    $('input[name=e_tgl_pengadaan_barang]').val(d['data'].tgl_pengadaan_barang);
                    $('select[name=e_id_kondisi]').val(d['data'].id_kondisi).trigger('change');
                    $('input[name=e_tempat_barang_disimpan]').val(d['data'].tempat_barang_disimpan);
                    $('select[name=e_posisi_barang').val(d['data'].posisi_barang).trigger('change');
                    $('input[name=e_keterangan]').val(d['data'].keterangan);
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
            var inventarisId = $(this).data('id');
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
                        url: "<?= base_url('inventaris_keamanan'); ?>/" + inventarisId,
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
