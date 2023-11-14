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
                                    <a href="<?= base_url('booking'); ?>" type="button" class="btn btn-danger">Kembali</a>
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
                                        <p class="pt-3"> <strong>Tanggal Pemakaian: </strong><br>
                                            <?= $booking->tanggal_pemakaian; ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="error-area"></div>
                                    <?php if ($booking->status == 'approved kadiv') : ?>
                                        <?= form_open(base_url('details'), ['class' => 'add-form']); ?>
                                        <input type="hidden" name="id_booking" value="<?= $booking->id_booking; ?>">
                                        <div class="row pl-2">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">jumlah kendaraan</label>
                                                    <input type="text" class="form-control divide" name="jumlah_kendaraan">
                                                    <div class="invalid-feedback"></div>
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
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Driver</label>
                                                    <select class="form-control select-only" name="user_id" id="user_id">
                                                        <option value="" selected disabled>- Pilih Driver -</option>
                                                        <?php foreach ($driver as $item) : ?>
                                                            <option value="<?= $item->id; ?>"><?= $item->text; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Saldo Awal E-Tol</label>
                                                    <input type="text" class="form-control divide" name="saldo_awal_etol">
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
                                    <!-- Signature Edit -->
                                    <!-- modal -->
                                    <div class="modal fade" id="ModalSignatureEdit" data-backdrop="false" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLongTitle">Silahkan masukkan tanda tangan</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="error-area"></div>
                                                    <form id="signature-edit">
                                                        <div class="d-flex">
                                                            <div class="mr-auto p-2">Digital Signature</div>
                                                            <div class="p-2">
                                                                <span class="btn-delete signature-clear" style="color: red;" type="button">
                                                                    <span class="zmdi zmdi-delete" style="font-size: 20px;"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="signature-wrapper signature-new text-start">
                                                            <canvas id="signature-pad" class="signature-pad border" width="250" height=150></canvas>
                                                        </div>
                                                        <div class="card signature-old m-0" hidden>
                                                            <div class="card-body p-1">
                                                                <img class="img-sign" src="<?= base_url('public/assets/images/ttd/' . $user_login->ttd); ?>" width="100%">
                                                            </div>
                                                        </div>
                                                        <div class="form-check mt-0">
                                                            <input class="form-check-input" type="checkbox" id="formCheck1" name="old_check" value="1">
                                                            <label class="form-check-label" for="formCheck1">
                                                                Gunakan signature tersimpan
                                                            </label>
                                                        </div>
                                                        <input type="hidden" name="signature">
                                                        <div class="invalid-feedback"></div>
                                                        <button class="btn btn-light" type="submit">Lanjut Approve</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- Signature Edit ditolak -->
                                    <!-- modal -->
                                    <div class="modal fade" id="ModalSignatureEditditolak" data-backdrop="false" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h6 class="modal-title" id="exampleModalLongTitle">Silahkan masukkan tanda tangan</h6>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="error-area"></div>
                                                    <form id="signature-edit-ditolak">
                                                        <div class="d-flex">
                                                            <div class="mr-auto p-2">Digital Signature</div>
                                                            <div class="p-2">
                                                                <span class="btn-delete signature-clear" style="color: red;" type="button">
                                                                    <span class="zmdi zmdi-delete" style="font-size: 20px;"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="signature-wrapper signature-new text-start">
                                                            <canvas id="signature-pad" class="signature-pad border" width="250" height=150></canvas>
                                                        </div>
                                                        <div class="card signature-old m-0" hidden>
                                                            <div class="card-body p-1">
                                                                <img class="img-sign" src="<?= base_url('public/assets/images/ttd/' . $user_login->ttd); ?>" width="100%">
                                                            </div>
                                                        </div>
                                                        <div class="form-check mt-0">
                                                            <input class="form-check-input" type="checkbox" id="formCheck1" name="old_check" value="1">
                                                            <label class="form-check-label" for="formCheck1">
                                                                Gunakan signature tersimpan
                                                            </label>
                                                        </div>
                                                        <input type="hidden" name="signature">
                                                        <div class="invalid-feedback"></div>
                                                        <button class="btn btn-light" type="submit">Lanjut Approve</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <?php if (_session('role') == 'Kadep') : ?>
                                                                <?php if ($booking->status === 'baru') : ?>
                                                                    Approved Kadep
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>
                                                            <?php if (_session('role') == 'Kadiv') : ?>
                                                                <?php if ($booking->status === 'approved kadep') : ?>
                                                                    Approved Kadiv
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </th>
                                                        <th>
                                                            <?php if (_session('role') == 'RT') : ?>
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
                                                        <th>Driver</th>
                                                        <th>Saldo Awal E-Tol</th>
                                                        <th>
                                                            <?php if ($booking->status === 'ditolak') : ?>
                                                                Alasan di Tolak
                                                            <?php endif; ?>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($booking_list as $list) : ?>
                                                        <tr>
                                                            <td>
                                                                <?php if (_session('role') == 'Kadep') : ?>
                                                                    <?php if ($booking->status === 'baru') : ?>
                                                                        <button class="btn btn-light" data-toggle="modal" data-target="#ModalSignatureEdit">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger " data-toggle="modal" data-target="#ModalSignatureEditditolak">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
                                                                            // approved kadep
                                                                            $('#signature-edit').submit(function(e) {
                                                                                e.preventDefault();
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = $(this).serialize();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_kadep/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                processDone();
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEdit').modal('hide');
                                                                                                    location.reload();
                                                                                                    Swal.fire('Approve Sukses', d['msg'], 'success')
                                                                                                } else {
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error')
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            // unapproved kadep
                                                                            $('.btn-unapprove').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('#signature-edit-ditolak').submit(function(e) {
                                                                                e.preventDefault();
                                                                                var form = $(this);
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = form.serialize();
                                                                                        formData += '&ditolak_ket=' + encodeURIComponent(keterangan);
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEdit').modal('hide');
                                                                                                    location.reload();
                                                                                                    Swal.fire('Booking Ditolak', d['msg'], 'success')
                                                                                                } else {
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
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
                                                                        <button class="btn btn-light" data-toggle="modal" data-target="#ModalSignatureEdit">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove-kadiv">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalSignatureEditditolak">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
                                                                            // approved kadiv
                                                                            $('#signature-edit').submit(function(e) {
                                                                                e.preventDefault();
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = $(this).serialize();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_kadiv/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEdit').modal('hide')
                                                                                                    location.reload();
                                                                                                    Swal.fire('Approve Sukses', d['msg'], 'success')
                                                                                                } else {
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error');
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            // unapproved kadiv
                                                                            $('.btn-unapprove-kadiv').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('#signature-edit-ditolak').submit(function(e) {
                                                                                e.preventDefault();
                                                                                var form = $(this);
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = form.serialize();
                                                                                        formData += '&ditolak_ket=' + encodeURIComponent(keterangan);
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEditditolak').modal('hide')
                                                                                                    location.reload();
                                                                                                    Swal.fire('Booking Ditolak', d['msg'], 'success')
                                                                                                } else {
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
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
                                                                <?php if (_session('role') == 'RT') : ?>
                                                                    <?php if ($booking->status === 'approved kadiv') : ?>
                                                                        <button class="btn btn-light" data-toggle="modal" data-target="#ModalSignatureEdit">Approve</button>
                                                                        <button class="btn btn-danger btn-unapprove-rt">Tolak</button>
                                                                        <div class="hidden-reason" style="display: none;">
                                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalSignatureEditditolak">Konfirmasi Penolakan</button>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                    <script>
                                                                        $(document).ready(function() {
                                                                            var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
                                                                            // approved RT
                                                                            $('#signature-edit').submit(function(e) {
                                                                                e.preventDefault();
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = $(this).serialize();
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('approved_RT/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEdit').modal('hide')
                                                                                                    location.reload();
                                                                                                    Swal.fire('Approve Sukses', d['msg'], 'success')
                                                                                                } else {
                                                                                                    processDone();
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('Approve gagal', d['msg'], 'error');
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                });
                                                                            });
                                                                            // unapproved RT
                                                                            $('.btn-unapprove-rt').on('click', function() {
                                                                                $('.hidden-reason').show();
                                                                            });
                                                                            $('#signature-edit-ditolak').submit(function() {
                                                                                var form = $(this);
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
                                                                                        $('input[name=signature]').val(signaturePad.toDataURL());
                                                                                        var formData = form.serialize();
                                                                                        formData += '&ditolak_ket=' + encodeURIComponent(keterangan);
                                                                                        $.ajax({
                                                                                            type: 'post',
                                                                                            dataType: 'json',
                                                                                            url: "<?= base_url('unapproved/' . $list->id_booking); ?>",
                                                                                            data: formData,
                                                                                            success: function(d) {
                                                                                                if (d['success']) {
                                                                                                    $('input[name=rscript]').val(d['rscript']);
                                                                                                    $('#ModalSignatureEdit').modal('hide')
                                                                                                    location.reload();
                                                                                                    Swal.fire('Booking ditolak', d['msg'], 'success')
                                                                                                } else {
                                                                                                    invalidError(d);
                                                                                                    Swal.fire('unapprove gagal', d['msg'], 'error');
                                                                                                }
                                                                                            },
                                                                                            error: function(xhr, status, error) {
                                                                                                processDone();
                                                                                                Swal.fire('Error', 'Terjadi kesalahan saat mengirim data.', 'error');
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
                                                            <td><?= $list->driver; ?></td>
                                                            <td><?= $list->saldo_awal_etol; ?></td>
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
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
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
                    }
                }
            })
        });
        $('#tb-notif').DataTable({
            responsive: true,
            ordering: false,
            scrollX: true,
            dom: "<'row'<'col-sm-12 col-md-12'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 text-center col-md-12'p>>"
        });
        $('.signature-clear').on('click', function(event) {
            signaturePad.clear();
        });
        $('#ModalSignatureEdit').on('hidden.modal', function(e) {
            signaturePad.clear();
            $('.alert').remove();
        });
        $('input[name=old_check]').change(function() {
            signaturePad.clear();
            if (this.checked) {
                $('.signature-new').attr('hidden', 'hidden');
                $('.signature-old').removeAttr('hidden');
            } else {
                $('.signature-old').attr('hidden', 'hidden');
                $('.signature-new').removeAttr('hidden');
            }
        });

    });
</script>