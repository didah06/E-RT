<section class="content invoice">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Detail Jadwal Transport
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Jadwal Transport</a></li>
                    <li class="breadcrumb-item active">Detail Jadwal Transport</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Detail</strong> Jadwal Transport</h2>
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
                        <div class="row pl-2 mb-5">
                            <a href="<?= base_url('jadwal'); ?>" type="button" class="btn btn-danger">Kembali</a>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Diajukan Oleh :</strong><br>
                                <?= $booking->nama; ?>, <?= $booking->tanggal_pemakaian; ?><br>
                                <?= $booking->direktorat; ?><br>
                                <?= $booking->divisi; ?><br>
                                <?= $booking->departemen; ?><br>
                            </div>
                            <div class="col-md-6">
                                <p class="m-b-0"><strong>Status: </strong>
                                    <span class="<?= $booking->status === 'baru' ? 'btn-info' : ($booking->status === 'diproses' ? 'btn-warning' : ($booking->status === 'selesai' ? 'btn-success' : ($booking->status === 'ditolak' ? 'btn-danger' : 'btn-primary'))) ?>">
                                        <?= $booking->status === 'baru' ? 'Baru' : ($booking->status === 'diproses' ? 'diproses' : ($booking->status === 'selesai' ? 'Selesai' : ($booking->status === 'ditolak' ? 'ditolak' : $booking->status))) ?></span>
                                </p>
                                <p class="m-b-0"><strong>Tipe: </strong><span class="<?= $booking->type_pemakaian == 1 ? 'btn-warning' : 'btn-info'; ?>"><?= $booking->type_pemakaian == 1 ? 'Urgent' : 'Normal' ?></span></p>
                                <div class="row pt-3">
                                    <strong>Driver : </strong>
                                    <?= $booking->driver; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5 mb-5">
                            <div class="col-md-6">
                                <strong>Acara Kegiatan :</strong>
                                <?= $booking->acara_kegiatan; ?><br><br>
                                <strong>Tujuan :</strong>
                                <?= $booking->tujuan; ?><br><br>
                                <strong>Tipe Pemakaian : </strong>
                                <?= $booking->type_pemakaian === 1 ? 'Urgent' : 'Normal' ?><br><br>
                                <strong>Jumlah Peserta :</strong>
                                <?= $booking->jumlah_peserta; ?><br><br>
                                <strong>Jumlah Kendaraan :</strong>
                                <?= $booking->jumlah_kendaraan; ?><br><br>
                                <strong>Jenis Kendaraan :</strong>
                                <?= $booking->jenis_kendaraan; ?><br><br>
                                <strong>Anggaran : </strong>
                                <?= $booking->anggaran; ?>
                            </div>
                        </div>
                        <div class="row pl-2">
                        <?php if (_session('role') == 'RT') : ?>
                            <?php if ($booking->status === 'diproses') : ?>
                                <a href="<?= base_url('booking_selesai'); ?>" data-id="<?= $booking->id_booking; ?>" data-toggle="modal" data-target="#Modaladd" class="btn btn-success">Booking Selesai</a>
                            <?php endif; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                    <!-- Booking Edit -->
                    <!-- modal -->
                    <div class="modal fade" id="Modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="exampleModalLongTitle">Form Pengeluaran Kendaraan</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('jadwal_save'), ['class' => 'add-form']); ?>
                                    <input type="hidden" name="id_booking" value="<?= $booking->id_booking; ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Berangkat</label>
                                                <select class="form-control select-only" name="jam_berangkat" id="jam_berangkat">
                                                    <option value="" selected disabled>- Pilih Jam Berangkat -</option>
                                                    <?php foreach ($start_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">KM Berangkat</label>
                                                <input type="text" class="form-control" name="km_berangkat">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">jam_pulang</label>
                                                <select class="form-control select-only" name="jam_pulang" id="jam_pulang">
                                                    <option value="" selected disabled>- Pilih Jam Pulang -</option>
                                                    <?php foreach ($end_time as $item) : ?>
                                                        <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">KM kembali</label>
                                                <input type="text" class="form-control" name="km_kembali">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Tanggal Berangkat</label>
                                                <input type="date" class="form-control" name="tgl_berangkat" id="tgl_berangkat">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Saldo Awal E-tol</label>
                                                <input type="text" class="form-control divide" name="saldo_awal_etol" value="<?= $booking->saldo_awal_etol; ?>" id="saldo_awal_etol">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Biaya E-Tol</label>
                                                <input type="text" class="form-control divide" name="biaya_etol" id="biaya_etol">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Top Up E-Tol</label>
                                                <input type="text" class="form-control divide" name="top_up" id="top_up">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Saldo Akhir E-tol</label>
                                                <input type="text" class="form-control divide" name="saldo_akhir_etol" id="saldo_akhir_etol" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bensin</label>
                                                <input type="text" class="form-control divide" name="bensin" id="bensin">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Total Pengeluaran</label>
                                                <input type="text" class="form-control divide" name="total_pengeluaran" id="total_pengeluaran" readonly>
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-between">
                                            <div class="col-md-6">
                                                <div class="col-md-12">
                                                    <div class="mr-auto">Ditugaskan Oleh</div>
                                                    <div class="mr-auto"><b>Plt. Kadept. Rumah Tangga</b>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="card signature-old-kadep" style="width: 250px; height: 150px">
                                                        <div class="card-body">
                                                            <img class="img-sign" name="old_check_kadep" src="<?= base_url('public/assets/images/ttd/' . $booking->approved_rt_ttd); ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="col-md-12 pt-4">
                                                    <div class="mr-auto"><b>Digital Signature</b>
                                                        <span class="signature-clear" style="color: red;" type="button">
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
                                        </div>
                                        <div class="col-md-12 pt-2">
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
        $('#biaya_etol, #top_up').on('change', function() {
            calculateSaldo();
        })
        $('#biaya_etol, #bensin').on('change', function() {
            calculateTotal();
        })
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
        $('.add-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var signature = signaturePad.toDataURL();
            // Set the signature data in the hidden input field
            $('input[name=signature').val(signature);
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
                        window.location.href = '<?= base_url('/record'); ?>';
                    } else {
                        processDone();
                        invalidError(d);
                        Swal.fire('Tambah data gagal', d['msg'], 'error');
                    }
                }
            })
        });
    })

    function calculateSaldo() {
        var saldo_awal_etol = parseInt($('#saldo_awal_etol').siblings('input').val());
        var biaya_etol = parseInt($('#biaya_etol').siblings('input').val());
        var top_up = parseInt($('#top_up').siblings('input').val());

        var saldo_akhir = saldo_awal_etol - biaya_etol + top_up;

        $('#saldo_akhir_etol').siblings('input').val(saldo_akhir).trigger('change');
        $('#saldo_akhir_etol').val(saldo_akhir);
    }

    function calculateTotal() {
        var biaya_etol = parseInt($('#biaya_etol').siblings('input').val());
        var bensin = parseInt($('#bensin').siblings('input').val());

        var total = biaya_etol + bensin;
        $('#total_pengeluaran').siblings('input').val(total).trigger('change');
        $('#total_pengeluaran').val(total);
    }
</script>
