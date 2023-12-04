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
                    <div class="body">
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('laporan_fotocopy') ?>">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="mb-2">
                                            <label class="form-label">Kebutuhan Transaksi</label>
                                            <select class="form-control select-only" name="kebutuhan_transaksi">
                                                <option value="fotocopy">Fotocopy</option>
                                                <option value="laminating">Laminating</option>
                                            </select>
                                        </div>
                                    </div>
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
                            <table id="datatables" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <!-- delete old menu if menu is not menu current date -->
                                <!-- delete based on checklist -->
                                <!-- <button class="btn btn-danger mb-3" id="delete-selected">Delete</button> -->
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center"><i class="zmdi zmdi-delete" style="font-size: 18px; color: red;"></i></th> -->
                                        <th>Kebutuhan Transaksi</th>
                                        <th>Departemen</th>
                                        <th>Jenis User</th>
                                        <th>Jumlah Halaman</th>
                                        <th>Pemakaian Kertas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($laporan_transaksi as $table) : ?>
                                        <tr>
                                            <td><span class="<?= $table->kebutuhan_transaksi === 'fotocopy' ? 'badge badge-info' : 'badge badge:warning'; ?>">
                                                    <?= $table->kebutuhan_transaksi === 'fotocopy' ? 'fotocopy' : 'laminating'; ?></span></td>
                                            <td><?= $table->departemen; ?></td>
                                            <td><?= $table->jenis_user; ?></td>
                                            <td><?= $table->jml_halaman; ?></td>
                                            <td><?= $table->pemakaian_kertas; ?></td>
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
    </div>
</section>
