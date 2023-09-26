<section class="content invoice">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Detail Form Pengajuan Kendaraan
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Form Pengajuan Kendaraan</a></li>
                    <li class="breadcrumb-item active">Detail Form Pengajuan Kendaraan</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Detail</strong> Form Pengajuan Kendaraan</h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li><a href="javascript:void(0);">Print Invoices</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li><a href="javascript:void(0);">Export to XLS</a></li>
                                    <li><a href="javascript:void(0);">Export to CSV</a></li>
                                    <li><a href="javascript:void(0);">Export to XML</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <h4 class="m-b-0">Kode Booking: <strong class="text-primary"><?= $booking->kode_booking; ?></strong></h4>
                        <ul class="nav nav-tabs">
                            <li class="nav-item inlineblock"><a class="nav-link active" data-toggle="tab" href="#details" aria-expanded="true">Pesetujuan Booking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane in active" id="details" aria-expanded="true">
                        <div class="card" id="details">
                            <div class="body">
                                <div class="row pl-2">
                                    <a href="<?= base_url('booking'); ?>" type="button" class="btn btn-warning">Kembali</a>
                                </div>
                                <div class="row pt-5">
                                    <div class="col-md-6 col-sm-6">
                                        <address>
                                            <strong>Diajukan Oleh :</strong><br>
                                            <?= $booking->nama; ?>, <?= $booking->tanggal_pemakaian; ?><br>
                                            <?= $booking->direktorat; ?><br>
                                            <?= $booking->divisi; ?><br>
                                            <?= $booking->departemen; ?><br>
                                        </address>
                                        <address>
                                            <strong>Tujuan : </strong><br>
                                            <?= $booking->tujuan; ?><br>
                                        </address>
                                        <address>
                                            <strong>Acara Kegiatan: </strong><br>
                                            <?= $booking->acara_kegiatan; ?>
                                        </address>
                                    </div>
                                    <div class="col-md-6 col-sm-6 pl-5">
                                        <p class="m-b-0"><strong>Status: </strong>
                                            <span class="<?= $booking->status === 'baru' ? 'btn-info' : ($booking->status === 'diproses' ? 'btn-warning' : ($booking->status === 'selesai' ? 'btn-success' : ($booking->status === 'ditolak' ? 'btn-danger' : 'btn-primary'))) ?>">
                                                <?= $booking->status === 'baru' ? 'Baru' : ($booking->status === 'diproses' ? 'diproses' : ($booking->status === 'selesai' ? 'Selesai' : ($booking->status === 'ditolak' ? 'ditolak' : $booking->status))) ?></span>
                                        </p>
                                        <p class="m-b-0"><strong>Tipe: </strong><span class="<?= $booking->type_pemakaian == 1 ? 'btn-warning' : 'btn-info'; ?>"><?= $booking->type_pemakaian == 1 ? 'Urgent' : 'Normal' ?></span></p>
                                        <p class="pt-3"> <strong>Hari & Tanggal Pemakaian: </strong><br>
                                            <?= $booking->tanggal_pemakaian; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if ($booking->status == 'approved kadiv') : ?>
                                        <?= form_open(base_url('details_save'), ['class' => 'add-form']); ?>
                                        <input type="hidden" name="id_booking" value="<?= $booking->id_booking; ?>">
                                        <div class="row pl-2">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">jumlah kendaraan</label>
                                                    <input type="text" class="form-control divide" name="jumlah_kendaraan">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kendaraan</label>
                                                    <select class="form-control select-only" name="id_kendaraan" id="id_kendaraan">
                                                        <option value="" selected disabled>- Pilih Jenis Kendaraan -</option>
                                                        <?php foreach ($kendaraan as $item) : ?>
                                                            <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-success">simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <?php if ($booking->status === 'diproses') : ?>
                                                                Booking Selesai
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>
                                                            <?php if (_session('role') == 'Kadep' || _session('jenis') == 'Admin') : ?>
                                                                <?php if ($booking->status === 'baru') : ?>
                                                                    Approved Kadep
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>
                                                            <?php if (_session('role') == 'Kadiv' || _session('jenis') == 'Admin') : ?>
                                                                <?php if ($booking->status === 'approved kadep') : ?>
                                                                    Approved Kadiv
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>
                                                            <?php if (_session('role') == 'RT' || _session('jenis') == 'Admin') : ?>
                                                                <?php if ($booking->status === 'approved kadiv') : ?>
                                                                    Approved RT
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>Cara Pemakaian</th>
                                                        <th>Jam Keberangkatan</th>
                                                        <th>jam kembali</th>
                                                        <th>Jumlah Peserta</th>
                                                        <th>Jumlah Kendaraan</th>
                                                        <th>Jenis Kendaraan</th>
                                                        <th>Anggaran</th>
                                                        <th>Alasan di Tolak</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($booking_list as $list) : ?>
                                                        <tr>
                                                            <td>
                                                                <?php if ($booking->status === 'diproses') : ?>
                                                                    <a href="<?= base_url('booking_selesai'); ?>" class="btn btn-success">Selesai</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if (_session('role') == 'Kadep') : ?>
                                                                    <?php if ($booking->status === 'baru') : ?>
                                                                        <button class="btn btn-light btn-approve">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger btn-confirm-rejection">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.btn-approve').on('click', function() {
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di approved',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, approved',
                                                                                    confirmButtonColor: '#66b2ff',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_kadep/' . $list->id_booking); ?>",
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            $('.btn-unapprove').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('.btn-confirm-rejection').on('click', function() {
                                                                                var keterangan = $('textarea[name="ditolak_ket"]').val();
                                                                                if (!keterangan) {
                                                                                    return;
                                                                                }
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di Tolak',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, tolak',
                                                                                    confirmButtonColor: '#FF4949',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: {
                                                                                                ditolak_ket: keterangan
                                                                                            },
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            })
                                                                        });
                                                                    </script>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <!-- approve kadiv -->
                                                                <?php if (_session('role') == 'Kadiv') : ?>
                                                                    <?php if ($booking->status === 'approved kadep') : ?>
                                                                        <button class="btn btn-light btn-approve-kadiv">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove-kadiv">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger btn-confirm-rejection">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.btn-approve-kadiv').on('click', function() {
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di approved',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, approved',
                                                                                    confirmButtonColor: '#66b2ff',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_kadiv/' . $list->id_booking); ?>",
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            $('.btn-unapprove-kadiv').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('.btn-confirm-rejection').on('click', function() {
                                                                                var keterangan = $('textarea[name="ditolak_ket"]').val();
                                                                                if (!keterangan) {
                                                                                    return;
                                                                                }
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di Tolak',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, tolak',
                                                                                    confirmButtonColor: '#FF4949',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: {
                                                                                                ditolak_ket: keterangan
                                                                                            },
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            })
                                                                        });
                                                                    </script>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if (_session('role') == 'RT'   || _session('jenis') == 'Admin') : ?>
                                                                    <?php if ($booking->status === 'approved kadiv') : ?>
                                                                        <button class="btn btn-light btn-approve-rt">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove-rt">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger btn-confirm-rejection">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            $('.btn-approve-rt').on('click', function() {
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di approved',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, approved',
                                                                                    confirmButtonColor: '#66b2ff',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_RT/' . $list->id_booking); ?>",
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            $('.btn-unapprove-rt').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('.btn-confirm-rejection').on('click', function() {
                                                                                var keterangan = $('textarea[name="ditolak_ket"]').val();
                                                                                if (!keterangan) {
                                                                                    return;
                                                                                }
                                                                                Swal.fire({
                                                                                    title: 'Apa anda yakin?',
                                                                                    text: 'kode booking <?= $list->kode_booking; ?> akan di Tolak',
                                                                                    icon: 'warning',
                                                                                    showCancelButton: true,
                                                                                    confirmButtonText: 'Ya, tolak',
                                                                                    confirmButtonColor: '#FF4949',
                                                                                    cancelButtonText: 'Batal',
                                                                                }).then((result) => {
                                                                                    if (result.value) {
                                                                                        processStart();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: {
                                                                                                ditolak_ket: keterangan
                                                                                            },
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    location.reload();
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            })
                                                                        });
                                                                    </script>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= $list->cara_pemakaian; ?></td>
                                                            <td><?= $list->jam_keberangkatan; ?></td>
                                                            <td><?= $list->jam_kembali; ?></td>
                                                            <td><?= $list->jumlah_peserta; ?></td>
                                                            <td><?= $list->jumlah_kendaraan; ?></td>
                                                            <td><?= $list->jenis_kendaraan; ?></td>
                                                            <td><?= $list->anggaran; ?></td>
                                                            <td>
                                                                <?php if ($booking->status === 'ditolak') : ?>
                                                                    <?= $list->ditolak_ket; ?>
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
                    if (d['success'] > 0) {
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