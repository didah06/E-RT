<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Booking Transport
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Booking Transport</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2><strong>Form </strong>Pengajuan Kendaraan</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <!-- Booking Tambah -->
                    <!-- modal -->
                    <div class="modal fade" id="ModalFormPengajuan" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Form Pengajuan Kendaraan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger alert-dismissible" id="time-alert" role="alert" style="display:none">
                                        <strong>Maaf !</strong> pada jam tersebut sudah ada yang booking!.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('transportasi'), ['class' => 'add-form']); ?>
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pemakaian</label>
                                                <input type="date" class="form-control" min="<?= date('Y-m-d', strtotime('-0 day')) ?>" name="tanggal_pemakaian" id="tanggal_pemakaian">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Keberangkatan</label>
                                                <select class="form-control select-only" name="jam_keberangkatan" id="jam_keberangkatan" onchange="checktime()">
                                                    <option value="" selected disabled>- Pilih Jam Keberangkatan -</option>
                                                    <?php foreach ($start_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Kembali</label>
                                                <select class="form-control select-only" name="jam_kembali" id="jam_kembali" onchange="checktime()">
                                                    <option value="" selected disabled>- Pilih Jam Kembali -</option>
                                                    <?php foreach ($end_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Cara Pemakaian</label>
                                                <select class="form-control select-only" name="cara_pemakaian">
                                                    <option value="" selected disabled>--Pilih Cara Pemakaian--</option>
                                                    <option value="Antar">Antar</option>
                                                    <option value="Jemput">Jemput</option>
                                                    <option value="Antar Jemput Ditunggu">Antar Jemput Ditunggu</option>
                                                    <option value="Antar Jemput Ditinggal">Antar Jemput Ditinggal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tipe Pemakaian</label>
                                                <select class="form-control select-only" name="type_pemakaian">
                                                    <option value="" selected disabled>--Pilih Tipe Pemakaian--</option>
                                                    <option value="1">Urgent</option>
                                                    <option value="2">Normal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Peserta</label>
                                                <input type="number" class="form-control divide" name="jumlah_peserta">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Anggaran</label>
                                                <input type="text" class="form-control divide" name="anggaran">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tujuan</label>
                                                <input type="text" class="form-control" name="tujuan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Acara Kegiatan</label>
                                                <input type="text" class="form-control" name="acara_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mr-auto">Depok,</div>
                                            <div class="pl-5"><b>Pemohon</b>
                                                <span class="signature-clear pl-5" style="color: red;" type="button">
                                                    <span class="zmdi zmdi-delete" style="font-size: 20px;"></span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="signature-wrapper signature-new text-start">
                                                <canvas id="signature-pad" class="signature-pad border" width="250" height=150></canvas>
                                            </div>
                                            <div class="card signature-old" hidden style="width: 250px; height: 150px">
                                                <div class="card-body">
                                                    <img class="img-sign" src="<?= base_url('public/assets/images/ttd/' . $user_login->ttd); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check mt-0 pl-4">
                                            <input class="form-check-input" type="checkbox" id="formCheck1" name="old_check" value="1">
                                            <label class="form-check-label" for="formCheck1">
                                                Gunakan signature tersimpan
                                            </label>
                                        </div>
                                        <input type="hidden" name="signature">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-success btn-round btn-save">Simpan</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
                    <div class="body">
                        <div class="row mb-5">
                            <button class="btn btn-info" data-toggle="modal" data-target="#ModalFormPengajuan"><i class="zmdi zmdi-plus">Form Pengajuan Kendaraan
                                </i></button>
                        </div>
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('/booking') ?>">
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
                                <thead>
                                    <tr>
                                        <th width="12%">#</th>
                                        <th>Status</th>
                                        <th>Tipe</th>
                                        <th>Kode Booking</th>
                                        <th>Tanggal Pemakaian</th>
                                        <th>Cara Pemakaian</th>
                                        <th>Tujuan</th>
                                        <th>Acara Kegiatan</th>
                                        <th>Nama</th>
                                        <th>Departemen</th>
                                        <th>Divisi</th>
                                        <th>Direktorat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($booking as $table) : ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href=" <?= base_url('details/' . $table->id_booking); ?>">
                                                    <span class="badge badge-info" style="align-items: center; justify-content: center; width: 40px; height: 35px;">
                                                        <span class="zmdi zmdi-assignment" style="font-size: 18px;"></span>
                                                    </span>
                                                    <!-- <button class="btn btn-info btn-icon hidden-sm-down float-right m-l-3" type="button">
                                                        <i class="zmdi zmdi-assignment"></i>
                                                    </button> -->
                                                </a>
                                                <?php if ($table->status === 'ditolak' || $table->status === 'baru') : ?>
                                                    <?php if (_session('user_id') === $table->created_id) : ?>
                                                        <span class="badge badge-warning btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_booking; ?>" data-toggle="modal" data-target="#ModalEdit" type="button">
                                                            <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                        </span>
                                                        <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;" data-id="<?= $table->id_booking; ?>" type="button">
                                                            <i class="zmdi zmdi-delete" style="font-size: 18px;"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status === 'baru' ? 'badge badge-primary' : ($table->status === 'diproses' ? 'badge badge-warning' : ($table->status === 'selesai' ? 'badge badge-success' : ($table->status === 'ditolak' ? 'badge badge-danger' : 'badge badge-info'))) ?>">
                                                    <?= $table->status === 'baru' ? 'Booking Baru' : ($table->status === 'approved kadep' && $table->status === 'approved kadiv' ? 'Booking disetujui' : ($table->status === 'diproses' ? 'Booking diproses' : ($table->status === 'selesai' ? 'Selesai' : ($table->status === 'ditolak' ? 'Booking ditolak' : $table->status)))) ?></span>
                                            </td>
                                            <td class="<?= $table->type_pemakaian == 1 ? 'btn-warning' : 'btn-info'; ?>"><?= $table->type_pemakaian == 1 ? 'Urgent' : 'Normal' ?>
                                            </td>
                                            <td><?= $table->kode_booking; ?></td>
                                            <td><?= $table->tanggal_pemakaian; ?></td>
                                            <td><?= $table->cara_pemakaian; ?></td>
                                            <td><?= $table->tujuan; ?></td>
                                            <td><?= $table->acara_kegiatan; ?>
                                            <td><?= $table->nama; ?></td>
                                            <td><?= $table->departemen ? $table->departemen : '-'; ?></td>
                                            <td><?= $table->divisi ? $table->divisi : '-'; ?></td>
                                            <td><?= $table->direktorat ? $table->direktorat : '-'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Booking Edit -->
                    <!-- modal -->
                    <div class="modal fade" id="ModalEdit" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Edit Form Pengajuan Kendaraan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger alert-dismissible" id="time-alert" role="alert" style="display:none">
                                        <strong>Maaf !</strong> pada jam tersebut sudah ada yang booking!.
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('transportasi/booking_update'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_booking">
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Pemakaian</label>
                                                <input type="date" class="form-control" name="e_tanggal_pemakaian" id="tanggal_pemakaian" onchange="checktime()">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Keberangkatan</label>
                                                <select class="form-control select-only" name="e_jam_keberangkatan" id="jam_keberangkatan" onchange="checktime()">
                                                    <option value="" selected disabled>- Pilih Jam Keberangkatan -</option>
                                                    <?php foreach ($start_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Kembali</label>
                                                <select class="form-control select-only" name="e_jam_kembali" id="jam_kembali" onchange="checktime()">
                                                    <option value="" selected disabled>- Pilih Jam Kembali -</option>
                                                    <?php foreach ($start_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Cara Pemakaian</label>
                                                <select class="form-control select-only" name="e_cara_pemakaian">
                                                    <option value="" selected disabled>--Pilih Cara Pemakaian--</option>
                                                    <option value="Antar">Antar</option>
                                                    <option value="Jemput">Jemput</option>
                                                    <option value="Antar Jemput Ditunggu">Antar Jemput Ditunggu</option>
                                                    <option value="Antar Jemput Ditinggal">Antar Jemput Ditinggal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Tipe Pemakaian</label>
                                                <select class="form-control select-only" name="e_type_pemakaian">
                                                    <option value="" selected disabled>--Pilih Tipe Pemakaian--</option>
                                                    <option value="1">Urgent</option>
                                                    <option value="2">Normal</option>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Peserta</label>
                                                <input type="number" class="form-control" name="e_jumlah_peserta">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Anggaran</label>
                                                <input type="text" class="form-control" name="e_anggaran">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Tujuan</label>
                                                <input type="text" class="form-control" name="e_tujuan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Acara Kegiatan</label>
                                                <input type="text" class="form-control" name="e_acara_kegiatan">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center mb-3">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
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
    $('.divide').divide();
    $(document).ready(function() {
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        $('#tb-notif').DataTable({
            responsive: true,
            ordering: false,
            scrollX: true,
            dom: "<'row'<'col-sm-12 col-md-12'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 text-center col-md-12'p>>"
        });
        $('.signature-clear').on('click', function(event) {
            signaturePad.clear();
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
        $('input[name="tanggal_pemakaian"]').on('change', function() {
            checktime();
            if ($(this).val) {
                $('select[name="jam_keberangkatan"]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name="jam_keberangkatan"]').selectpicker('refresh');
                $.get("<?= base_url('select_jadwal_start'); ?>/" + $(this).val(), function(d) {
                    $('select[name="jam_keberangkatan"]').html(d);
                    $('select[name="jam_keberangkatan"]').selectpicker('refresh');
                });
                $('select[name="jam_kembali"]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name="jam_kembali"]').selectpicker('refresh');
                $.get("<?= base_url('select_jadwal_end'); ?>/" + $(this).val(), function(d) {
                    $('select[name="jam_kembali"]').html(d);
                    $('select[name="jam_kembali"]').selectpicker('refresh');
                });
            }
        })
        $('input[name="e_tanggal_pemakaian"]').on('change', function() {
            checktime();
            if ($(this).val) {
                $('select[name="e_jam_keberangkatan"]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name="e_jam_keberangkatan"]').selectpicker('refresh');
                $.get("<?= base_url('select_jadwal_start'); ?>/" + $(this).val() + "?id_booking=" + $('input[name="e_id_booking"]').val(), function(d) {
                    $('select[name="e_jam_keberangkatan"]').html(d);
                    $('select[name="e_jam_keberangkatan"]').selectpicker('refresh');
                });
                $('select[name="e_jam_kembali"]').html('<option value="" selected disabled>Loading...</option>');
                $('select[name="e_jam_kembali"]').selectpicker('refresh');
                $.get("<?= base_url('select_jadwal_end'); ?>/" + $(this).val() + "?id_booking=" + $('input[name="e_id_booking"]').val(), function(d) {
                    $('select[name="e_jam_kembali"]').html(d);
                    $('select[name="e_jam_kembali"]').selectpicker('refresh');
                });
            }
        })
        $('select[name="e_jam_keberangkatan"]').change(function() {
            $.get("<?= base_url('select_jadwal_jam_berangkat'); ?>", {
                tanggal_pemakaian: $('input[name="e_tanggal_pemakaian"]').val(),
                id_booking: $('input[name="e_id_booking"]').val()
            }, function(data) {
                $('select[name="e_jam_keberangkatan"]').html(data);
                $('select[name="e_jam_keberangkatan"]').selectpicker('refresh');
            });
        });
        $('select[name="e_jam_kembali"]').change(function() {
            $.get("<?= base_url('select_jadwal_jam_kembali'); ?>", {
                tanggal_pemakaian: $('input[name="e_tanggal_pemakaian"]').val(),
                id_booking: $('input[name="e_id_booking"]').val()
            }, function(data) {
                $('select[name="e_jam_kembali"]').html(data);
                $('select[name="e_jam_kembali"]').selectpicker('refresh');
            });
        });
        $('.add-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var signatureData = signaturePad.toDataURL();
            // Set the signature data in the hidden input field
            $('input[name=signature').val(signatureData);
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
                        $('input[name=rscript]').val(d['rscript']);
                        $('#ModalFormPengajuan').modal('hide');
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                        Swal.fire('Tambah data gagal', d['msg'], 'error');
                    }
                }
            })
        });
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('booking_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_booking]').val(d['data'].id_booking);
                    // $('input[name=e_tanggal_pemakaian]').val(d['data'].tanggal_pemakaian);
                    $('input[name=e_tanggal_pemakaian]').val(d['data'].tanggal_pemakaian).trigger('change');
                    $('select[name=e_jam_keberangkatan]').val(d['data'].jam_keberangkatan).trigger('change');
                    $('select[name=e_jam_kembali]').val(d['data'].jam_kembali).trigger('change');
                    $('select[name=e_cara_pemakaian').val(d['data'].cara_pemakaian).trigger('change');
                    $('select[name=e_type_pemakaian]').val(d['data'].type_pemakaian).trigger('change');
                    $('input[name=e_jumlah_peserta]').val(d['data'].jumlah_peserta);
                    $('input[name=e_anggaran]').val(d['data'].anggaran);
                    $('input[name=e_tujuan]').val(d['data'].tujuan);
                    $('input[name=e_acara_kegiatan]').val(d['data'].acara_kegiatan);
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
            var bookingId = $(this).data('id');
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
                        url: "<?= base_url('transportasi/delete/'); ?>/" + bookingId,
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

    function checktime() {
        var tanggal_pemakaian = $('#tanggal_pemakaian').val(); // Get the date
        var jam_keberangkatan = $('#jam_keberangkatan').val(); // Get the start time
        var jam_kembali = $('#jam_kembali').val();
        if (tanggal_pemakaian != null && jam_keberangkatan != null && jam_kembali != null) {
            $.getJSON("<?= base_url('validasi_jadwal'); ?>/" + tanggal_pemakaian + "/" + jam_keberangkatan + "/" + jam_kembali, function(d) {
                if (d['status'] === true) {
                    $('#time-alert').show();
                    // alert('Maaf! pada jam tersebut sudah ada yang booking!');
                }
            })
        }
    }
</script>