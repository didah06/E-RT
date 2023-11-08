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
                                    <?= form_open(base_url('transaksi'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Departemen</label>
                                                <select class="form-control select-only" name="id_dept">
                                                    <?php foreach ($departemen as $item) : ?>
                                                        <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">jenis user</label>
                                                <select class="form-control select-only" name="jenis_user">
                                                    <option value="internal">User Internal</option>
                                                    <option value="eksternal">User Eksternal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">kebutuhan transaksi</label>
                                                <select class="form-control select-only" name="kebutuhan_transaksi">
                                                    <option value="fotocopy">Fotocopy</option>
                                                    <option value="Laminating">Laminating</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Halaman</label>
                                                <input type="text" name="jml_halaman" id="jml" class="form-control divide">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Harga Perhalaman</label>
                                                <input type="text" name="harga_perhalaman" id="harga" class="form-control divide">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Total Harga</label>
                                                <input type="text" name="total_harga" id="total_harga" class="form-control divide">
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
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Transaksi Fotokopi
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
                                        <th>Kebutuhan Transaksi</th>
                                        <th>Departemen</th>
                                        <th>Jenis User</th>
                                        <th>Jumlah Halaman</th>
                                        <th>Harga Perhalaman</th>
                                        <th>Total Harga</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaksi as $table) : ?>
                                        <tr>
                                            <td class="text-center"></td>
                                            <td><span class="<?= $table->kebutuhan_transaksi === 'fotocopy' ? 'badge badge-info' : 'badge badge:warning'; ?>">
                                                    <?= $table->kebutuhan_transaksi === 'fotocopy' ? 'fotocopy' : 'laminating'; ?></span></td>
                                            <td><?= $table->departemen; ?></td>
                                            <td><?= $table->jenis_user; ?></td>
                                            <td><?= $table->jml_halaman; ?></td>
                                            <td><?= $table->harga_perhalaman; ?></td>
                                            <td><?= $table->total_harga; ?></td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/fotocopy/transaksi/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
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
</section>
<script>
    $('.divide').divide();
    $(document).ready(function() {
        $('#harga').on('change', function() {
            hitungHargaFotocopy();
        });
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
    })

    function hitungHargaFotocopy() {
        var jumlahHalaman = parseInt($('#jml').siblings('input').val());
        var HargaPerhalaman = parseInt($('#harga').siblings('input').val());

        var totalharga = jumlahHalaman * HargaPerhalaman;

        $('#total_harga').siblings('input').val(totalharga).trigger('change');
        $('#total_harga').val(totalharga);
    }
</script>