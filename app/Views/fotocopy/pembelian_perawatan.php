<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Pembelian dan Perawatan
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Pembelian dan Perawatan</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Pembelian dan Perawatan</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="row mb-5">
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Pembelian Barang
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
                                        <th>Status</th>
                                        <th>Kode Barang</th>
                                        <th>Jenis Pengajuan</th>
                                        <th>Nama Barang</th>
                                        <th>Merk</th>
                                        <th>No Serial</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah Barang</th>
                                        <th>Harga</th>
                                        <th>Struk</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembelian_perawatan as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <!-- if role RT and Developer -->
                                                <?php if (_session('role') == 'RT' || _session('role') == 'Developer') : ?>
                                                    <?php if ($table->status === 'pengajuan') : ?>
                                                        <button class="btn btn-success btn-approve" style="align-items: center; justify-content: center; width: 120px; height: 35px;" data-id="<?= $table->id_pembelian_barang; ?>" type="button">Approve</button>
                                                        <button class="btn btn-danger btn-tolak" style="align-items: center; justify-content: center; width: 120px; height: 35px;" data-id="<?= $table->id_pembelian_barang; ?>" type="button">Tolak</button>
                                                    <?php endif; ?>
                                                    <?php if ($table->status === 'approved') : ?>
                                                        <span class="badge badge-danger btn-proses" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pembelian_barang; ?>" type="button">
                                                            <i class="zmdi zmdi-shopping-cart" style="font-size: 20px;"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($table->status === 'pembelian' || $table->status === 'perawatan') : ?>
                                                        <span class="badge badge-danger btn-selesai" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_pembelian_barang; ?>" type="button">
                                                            <i class="zmdi zmdi-check" style="font-size: 20px;"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status === 'pengajuan pembelian' ? 'badge badge-danger' : ($table->status === 'pengajuan perawatan' ? 'badge badge-warning' : 'badge badge-success'); ?>">
                                                    <?= $table->status === 'pengajuan' ? 'pengajuan' : ($table->status === 'approved' ? 'approved' : ($table->status === 'pembelian' ? 'pembelian' : ($table->status === 'perawatan' ? 'perawatan' : ($table->status)))); ?>
                                                </span>
                                            </td>
                                            <td><?= $table->kode_barang; ?></td>
                                            <td>
                                                <span class="<?= $table->jenis_pengajuan === 'pembelian' ? 'badge badge-info' : 'badge badge-warning'; ?>">
                                                    <?= $table->jenis_pengajuan === 'pembelian' ? 'pembelian' : 'perawatan'; ?>
                                                </span>
                                            </td>
                                            <td><?= $table->nama_barang; ?></td>
                                            <td><?= $table->merk; ?></td>
                                            <td><?= $table->no_serial; ?></td>
                                            <td><?= $table->tanggal != null ? $table->tanggal : '-'; ?></td>
                                            <td><?= $table->jml_barang != null ? $table->jml_barang : '-'; ?></td>
                                            <td>
                                                <?= $table->harga; ?>
                                            </td>
                                            <td>
                                                <?php if ($table->struk != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/fotocopy/struk/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
                                                <?php else : ?>
                                                    <?php echo '-'; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($table->foto != null) : ?>
                                                    <a href="<?= base_url('public/assets/images/fotocopy/foto/' . $table->foto) ?>" class="btn btn-light"><i class="zmdi zmdi-image-alt"></i></a>
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
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('.btn-approve').on('click', function() {
            var pembelianId = $(this).data('id');
            processStart();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?= base_url('approve'); ?>", // Adjust the URL as needed
                data: {
                    id_pembelian_barang: pembelianId
                },
                error: function(xhr) {
                    processDone();
                    Swal.fire('Approve gagal', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
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
        })
        $('.btn-tolak').on('click', function() {
            var pembelianId = $(this).data('id');
            processStart();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?= base_url('tolak'); ?>", // Adjust the URL as needed
                data: {
                    id_pembelian_barang: pembelianId
                },
                error: function(xhr) {
                    processDone();
                    Swal.fire('Tolak gagal', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
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
        })
        $('.btn-proses').on('click', function() {
            var pembelianId = $(this).data('id');
            processStart();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?= base_url('proses_pembelian'); ?>", // Adjust the URL as needed
                data: {
                    id_pembelian_barang: pembelianId
                },
                error: function(xhr) {
                    processDone();
                    Swal.fire('gagal diproses', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
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
        })
        $('.btn-selesai').on('click', function() {
            var pembelianId = $(this).data('id');
            processStart();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?= base_url('selesai_pembelian'); ?>", // Adjust the URL as needed
                data: {
                    id_pembelian_barang: pembelianId
                },
                error: function(xhr) {
                    processDone();
                    Swal.fire('gagal diselesaikan', 'Error ' + xhr.status + ' : ' + xhr.statusText, 'error');
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
        })
    })
</script>