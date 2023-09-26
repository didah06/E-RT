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
                    <div class="body">
                        <div class="alert alert-danger alert-dismissible" id="time-alert" role="alert" style="display:none">
                            <strong>Maaf !</strong> pada jam tersebut sudah ada yang booking!.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?= form_open(base_url('transportasi'), ['class' => 'add-form']); ?>
                        <div class="row clearfix">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pemakaian</label>
                                    <input type="date" class="form-control" min="<?= date('Y-m-d', strtotime('-0 day')) ?>" name="tanggal_pemakaian" id="tanggal_pemakaian" onchange="checktime()">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Jam Kembali</label>
                                    <select class="form-control select-only" name="jam_kembali" id="jam_kembali" onchange="checktime()">
                                        <option value="" selected disabled>- Pilih Jam Kembali -</option>
                                        <?php foreach ($start_time as $item) : ?>
                                            <option value="<?= $item->text; ?>"><?= $item->text; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-2">
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
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Jumlah Peserta</label>
                                    <input type="number" class="form-control divide" name="jumlah_peserta">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Anggaran</label>
                                    <input type="text" class="form-control divide" name="anggaran">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Tujuan</label>
                                    <input type="text" class="form-control" name="tujuan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Acara Kegiatan</label>
                                    <input type="text" class="form-control" name="acara_kegiatan">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-success btn-round btn-save">Simpan</button>
                        </div>
                        </form>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th width="10%">#</th>
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
                                                        <span class="zmdi zmdi-assignment" style="font-size: 18px;" data-id="<?= $table->id_booking; ?>"></span>
                                                    </span>
                                                </a>
                                                <?php if ($table->status === 'ditolak' || $table->status === 'baru') : ?>
                                                    <span class="badge badge-primary btn-edit" style="align-items: center; justify-content: center; width: 40px; height: 35px;">
                                                        <span class="zmdi zmdi-edit" style="font-size: 18px;" data-id="<?= $table->id_booking; ?>"></span>
                                                    </span>
                                                    <span class="badge badge-danger btn-delete" style="align-items: center; justify-content: center; width: 40px; height: 35px;">
                                                        <span class="zmdi zmdi-delete" style="font-size: 18px;" data-id="<?= $table->id_booking; ?>"></span>
                                                    </span>
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
                    if (d['success']) {
                        var urlToReload = '<?= base_url('booking'); ?>';
                        window.location.href = urlToReload;
                    } else {
                        processDone();
                        invalidError(d);
                        Swal.fire('Tambah data gagal', d['msg'], 'error');
                    }
                }
            })
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