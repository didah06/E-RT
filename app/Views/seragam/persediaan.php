<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Persediaan Seragam
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Persediaan Seragam</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Persediaan Seragam</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <!-- modal pengambilan seragam -->
                    <div class="modal fade" id="ModalAmbilSeragam" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Pengambilan Seragam</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('pengeluaran_save'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="id_pemesanan">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pengambilan</label>
                                                <input type="date" class="form-control" name="tgl_pengambilan_seragam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Terima Seragam</label>
                                                <input type="text" class="form-control divide" name="jumlah_diterima" id="jml_diterima" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Ambil Seragam</label>
                                                <input type="text" class="form-control divide" name="jumlah_ambil_seragam" id="jml_diambil">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Stok Seragam</label>
                                                <input type="text" class="form-control divide" name="stok_seragam" id="stok" readonly>
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
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <!-- <button class="btn btn-danger mb-3" id="delete-selected">Delete</button> -->
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th> -->
                                        <th class="text-center" width="10%">#</th>
                                        <th>Status</th>
                                        <th>Jenis Seragam</th>
                                        <th>Vendor</th>
                                        <th>Ukuran</th>
                                        <th>Biaya</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Jumlah Diambil</th>
                                        <th>Stok Seragam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($persediaan as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <?php if ($table->status_stok == 'stok tersedia') : ?>
                                                    <span class="badge badge-info btn-ambil" style="align-items: center; justify-content: center; width: 95px; height: 35px" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalAmbilSeragam" type="button">
                                                        Ambil Seragam
                                                    </span>
                                                <?php else : ?>
                                                    <span class="disable"></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status_stok === 'stok habis' ? 'badge badge-danger' : ($table->status_stok === 'stok tersedia' ? 'badge badge-success' : ''); ?>">
                                                    <?= $table->status_stok === 'stok habis' ? 'stok habis' : ($table->status_stok === 'stok tersedia' ? 'stok tersedia' : ''); ?></span>
                                            </td>
                                            <td><?= $table->jenis_seragam; ?></td>
                                            <td><?= $table->vendor; ?></td>
                                            <td><?= $table->ukuran; ?></td>
                                            <td><?= $table->biaya; ?></td>
                                            <td><?= $table->tgl_diterima; ?></td>
                                            <td><?= $table->jumlah_diterima; ?></td>
                                            <td><?= ($table->jumlah_diambil !== null) ? $table->jumlah_diambil : '-'; ?></td>
                                            <td><?= ($table->stok_seragam !== null) ? $table->stok_seragam : $table->jumlah_diterima; ?></td>
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
        $('.btn-ambil').on('click', function() {
            $.getJSON("<?= base_url('get_pemesanan/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=id_pemesanan]').val(d['data'].id_pemesanan);
                    $('#jml_diterima, input[name=jumlah_diterima]').val(d['data'].jumlah_diterima);
                    $('#stok, input[name=stok_seragam]').val(d['data'].stok_seragam);
                }
            });
        });
        $('#jml_diambil').on('change', function() {
            hitungStok();
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
    })

    function hitungStok() {
        var stok_seragam = parseInt($('#stok').siblings('input').val());
        var jumlahAmbilSeragam = parseInt($('#jml_diambil').siblings('input').val());

        var stokSeragam = stok_seragam - jumlahAmbilSeragam;

        $('#stok').siblings('input').val(stokSeragam).trigger('change');
        $('#stok').val(stokSeragam);
    }
</script>