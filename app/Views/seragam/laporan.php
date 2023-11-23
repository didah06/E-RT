<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Laporan
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Laporan</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Laporan</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('laporan_seragam') ?>">
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
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <!-- <button class="btn btn-danger mb-3" id="delete-selected">Delete</button> -->
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th> -->
                                        <th>Jenis Seragam</th>
                                        <th>Departemen</th>
                                        <th>Vendor</th>
                                        <th>Tanggal Pemesanan</th>
                                        <th>Ukuran</th>
                                        <th>Jumlah Pesanan</th>
                                        <th>Biaya</th>
                                        <!-- created pemesanan seragam -->
                                        <th>Tanggal Pengiriman</th>
                                        <th>Jumlah Dikirim</th>
                                        <th>Sisa Pesanan</th>
                                        <th>created pengiriman by</th>
                                        <th>created pengiriman at</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>created diterima by</th>
                                        <th>created diterima at</th>
                                        <th>Tanggal Pengambilan Seragam</th>
                                        <th>Jumlah Diambil</th>
                                        <th>stok seragam</th>
                                        <!-- created pengambilan seragam -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($laporan as $table) : ?>
                                        <tr>
                                            <td><?= $table->jenis_seragam; ?></td>
                                            <td><?= $table->departemen; ?></td>
                                            <td><?= $table->vendor; ?></td>
                                            <td><?= $table->tgl_pemesanan; ?></td>
                                            <td><?= $table->ukuran; ?></td>
                                            <td><?= $table->jumlah_pesanan; ?></td>
                                            <td><?= $table->biaya; ?></td>
                                            <!-- created pemesanan seragam -->
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->tgl_pengiriman : '-'; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->jumlah_dikirim : '-'; ?></td>
                                            <td><?= $table->sisa_pesanan; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->created_pengiriman_by : '-'; ?></td>
                                            <td><?= ($table->tgl_pengiriman !== null && $table->jumlah_dikirim !== null) ? $table->created_pengiriman_at : '-'; ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->tgl_diterima : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->jumlah_diterima : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->created_terima_by : '-' ?></td>
                                            <td><?= ($table->tgl_diterima !== null && $table->jumlah_diterima !== null) ? $table->created_terima_at : '-' ?></td>
                                            <td><?= $table->tgl_pengambilan_seragam; ?></td>
                                            <td><?= $table->jumlah_ambil_seragam; ?></td>
                                            <td><?= $table->stok_seragam; ?></td>
                                            <!-- created pengambilan seragam -->
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