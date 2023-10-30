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
                                    <?= form_open(base_url('pengeluaran'), ['class' => 'add-form']); ?>
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
                                                <label class="form-label">Jumlah Ambil Seragam</label>
                                                <input type="text" class="form-control divide" name="jumlah_ambil_seragam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control divide" name="foto" accept="image/png, image/jpeg, image/jpg">
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
                                        <th class="text-center" width="20%">#</th>
                                        <th>Jenis Seragam</th>
                                        <th>Vendor</th>
                                        <th>Ukuran</th>
                                        <th>Biaya</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Stok Seragam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($persediaan as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <button class="btn badge badge-info btn-ambil" style="align-items: center; justify-content: center; width: 100px; height: 35px;" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalAmbilSeragam">
                                                    Ambil Seragam
                                                </button>
                                                <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pemesanan; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                    <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                </span>
                                                <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pemesanan; ?>" type="button">
                                                    <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                </span>
                                            </td>
                                            <td><?= $table->jenis_seragam; ?></td>
                                            <td><?= $table->vendor; ?></td>
                                            <td><?= $table->ukuran; ?></td>
                                            <td><?= $table->biaya; ?></td>
                                            <td><?= $table->tgl_diterima; ?></td>
                                            <td><?= $table->jumlah_diterima; ?></td>
                                            <td><?= $table->jumlah_diterima; ?></td>
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
    $('.btn-ambil').on('click', function() {
        $.getJSON("<?= base_url('pengeluaran/'); ?>/" + $(this).data('id'), function(d) {
            if (d['status'] === true) {
                $('input[name=id_pemesanan]').val(d['data'].id_pemesanan);
            }
        });
    });
</script>