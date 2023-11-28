<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Inventaris Barang Fotocopy
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Inventaris Barang Fotocopy</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Inventaris Barang Fotocopy</h2>
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
                                    <h6 class="modal-title" id="exampleModalLongTitle">Inventaris Barang Fotokopi</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('inventaris_fotokopi'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Barang</label>
                                                <input type="text" class="form-control" name="nama_barang">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Merk</label>
                                                <input type="text" class="form-control" name="merk">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">No Serial</label>
                                                <input type="text" class="form-control" name="no_serial">
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
                                                <label class="form-label">kondisi</label>
                                                <select class="form-control select-only" name="kondisi">
                                                    <option value="baru">Baru</option>
                                                    <option value="perbaikan">Perbaikan</option>
                                                    <option value="rusak">Rusak</option>
                                                    <option value="habis">Habis</option>

                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi Penyimpanan</label>
                                                <input type="text" name="lokasi_penyimpanan" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg, image/jpg">
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Inventaris Barang Fotocopy
                                </i></button>
                        </div>
                        <div class="table-responsive">
                            <table id="datatables" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <!-- <button class="btn btn-danger mb-3" id="delete-selected">Delete</button> -->
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th> -->
                                        <th class="text-center">#</th>
                                        <th>Status</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Merk</th>
                                        <th>No Serial</th>
                                        <th>Tanggal Pengadaan Barang</th>
                                        <th>Kondisi</th>
                                        <th>Lokasi Penyimpanan</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventaris as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if (($table->kondisi === 'rusak' || $table->kondisi === 'perbaikan' || $table->kondisi === 'habis') && $table->status === 'inventaris') : ?>
                                                    <span class="badge badge-danger btn-edit-pembelian" style="align-items: center; justify-content: center; width: 120px; height: 35px;" data-id="<?= $table->id_inventaris_fotokopi; ?>" data-toggle="modal" data-target="#ModalPembelian" type="button">pengajuan</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status === 'inventaris' ? 'badge badge-info' : ($table->status === 'pengajuan' ? 'badge badge-primary' : ($table->status === 'approved' ? 'badge badge-warning' : ($table->status === 'perawatan' ? 'badge badge-success' : 'badge badge-success'))) ?>">
                                                    <?= $table->status === 'pengajuan' ? 'pengajuan' : ($table->status === 'approved' ? 'approved' : ($table->status === 'pembelian' ? 'pembelian' : ($table->status === 'perawatan' ? 'perawatan' : ($table->status)))); ?>
                                                </span>
                                            </td>
                                            <td><?= $table->kode_barang; ?></td>
                                            <td><?= $table->nama_barang; ?></td>
                                            <td><?= $table->merk; ?></td>
                                            <td><?= $table->no_serial; ?></td>
                                            <td><?= $table->tgl_pengadaan_barang; ?></td>
                                            <td>
                                                <span class="<?= $table->kondisi === 'rusak' ? 'badge badge-danger' : ($table->kondisi === 'perbaikan' ? 'badge badge-warning' : ($table->kondisi === 'normal' ? 'badge badge-info' : 'badge badge-info')) ?>">
                                                    <?= $table->kondisi === 'rusak' ? 'rusak' : ($table->kondisi === 'perbaikan' ? 'perbaikan' : ($table->kondisi === 'normal' ? 'normal' : 'baru')); ?></span>
                                            </td>
                                            <td><?= $table->lokasi_penyimpanan; ?></td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/fotocopy/barang/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
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
                    <div class="modal fade" id="ModalPembelian" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Pengajuan Barang Fotokopi</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('pengajuan'), ['class' => 'add-form']); ?>
                                    <input type="hidden" name="id_inventaris_fotokopi">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-5">
                                                <label class="form-label">Jenis Pengajuan</label>
                                                <select class="form-control select-only" name="jenis_pengajuan">
                                                    <option value="" selected disabled>- Pilih Pengajuan -</option>
                                                    <option value="perawatan">Perawatan</option>
                                                    <option value="pembelian">Pembelian</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-5">
                                                <label class="form-label">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-5">
                                                <label class="form-label">Jumlah Barang</label>
                                                <input type="text" name="jml_barang" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-5">
                                                <label class="form-label">Harga</label>
                                                <input type="text" name="harga" class="form-control divide">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-5">
                                                <label class="form-label">Foto</label>
                                                <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
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
                    </div>
                    <!-- end modal -->
                </div>
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
        });
        $('#datatables').on('click', '.btn-edit-pembelian', function() {
            $.getJSON("<?= base_url('get_inventaris/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=id_inventaris_fotokopi]').val(d['data'].id_inventaris_fotokopi);
                }
            });
        });
    })
</script>