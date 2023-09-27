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
                            <a href="<?= base_url('jadwal'); ?>" type="button" class="btn btn-warning">Kembali</a>
                            <?php if ($booking->status === 'diproses') : ?>
                                <a href="<?= base_url('booking_selesai'); ?>" data-id="<?= $booking->id_booking; ?>" data-toggle="modal" data-target="#Modaladd" class="btn btn-success">Selesai</a>
                            <?php endif; ?>
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
                    </div>
                    <!-- Booking Edit -->
                    <!-- modal -->
                    <div class="modal fade" id="Modaladd" data-backdrop="false" role="dialog">
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
                                    <?= form_open(base_url('jadwal_update'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_booking">
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
                                                <label class="form-label">Biaya E-Tol</label>
                                                <input type="text" class="form-control divide" name="biaya_etol">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Top Up E-Tol</label>
                                                <input type="text" class="form-control divide" name="top_up">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Saldo Akhir E-Tol</label>
                                                <input type="text" class="form-control divide" name="saldo_akhir_etol">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Bensin</label>
                                                <input type="text" class="form-control divide" name="bensin">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label">Total Etol</label>
                                                <input type="text" class="form-control divide" name="total_etol">
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
</script>