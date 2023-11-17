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
                        <div class="modal fade" id="Modaladd" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Pembelian/Perawatan Barang Fotokopi</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('pembelian_perawatan'), ['class' => 'add-form']); ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Nama Barang</label>
                                                    <input type="text" class="form-control" name="nama_barang">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Merk</label>
                                                    <input type="text" class="form-control" name="merk">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">No Serial</label>
                                                    <input type="text" class="form-control" name="no_serial">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Jenis Pengajuan</label>
                                                    <select class="form-control select-only" name="jenis_pengajuan">
                                                        <option value="" selected disabled>- Pilih Pengajuan -</option>
                                                        <option value="perawatan">Perawatan</option>
                                                        <option value="pembelian">Pembelian</option>
                                                    </select>
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Tanggal Pengajuan</label>
                                                    <input type="date" class="form-control" name="tanggal">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Jumlah Barang</label>
                                                    <input type="text" class="form-control" name="jml_barang">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="text" class="form-control divide" name="harga">
                                                    <div class="invalid-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row text-center">
                                            <div class="col-md-12">
                                                <button class="btn btn-success" type="submit">pengajuan pembelian</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <button class="btn btn-info" data-toggle="modal" data-target="#Modaladd"><i class="zmdi zmdi-plus">Pengajuan Pembelian Barang
                                </i></button>
                        </div>
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
                        <div class="modal fade" id="ModalPembelianPerawatan" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Pembelian/Perawatan Barang Fotokopi</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('selesai_pembelian'), ['class' => 'update-multipart']); ?>
                                        <input type="hidden" name="e_kode_barang" value="<? $pembelian_perawatan->kode_barang; ?>">
                                        <div class="col-md_12">
                                            <label class="form-label">Tanggal Pembelian</label>
                                            <input type="date" class="form-control" name="tgl_pembelian">
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col-md_12">
                                            <div class="mb-3">
                                                <label class="form-label">Struk</label>
                                                <input type="file" class="form-control" name="struk" accept=".png, .jpg, .jpeg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <button class="btn btn-light" type="submit">selesai</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                                                        <button class="btn btn-success btn-approve" type="button" data-toggle="modal" data-target="#ModalSignatureEdit">Approve</button>
                                                        <button class="btn btn-danger btn-tolak" type="button">Tolak</button>
                                                        <div class="hidden-reason" style="display: none;">
                                                            <textarea id="rejectionReason" placeholder="Masukkan alasan penolakan" name="ditolak_ket"></textarea>
                                                            <button class="btn btn-danger" data-toggle="modal" data-target="#ModalSignatureEditditolak">Konfirmasi Penolakan</button>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if ($table->status === 'approved') : ?>
                                                        <span class="badge badge-danger btn-proses" style="align-items: center; justify-content: center; width: 40px; height: 35px;" type="button">
                                                            <i class="zmdi zmdi-shopping-cart" style="font-size: 20px;"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if ($table->status === 'pembelian' || $table->status === 'perawatan') : ?>
                                                        <span class="badge badge-danger btn-selesai" data-id="<?= $table->kode_barang; ?>" data-toggle="modal" data-target="#ModalPembelianPerawatan" style="align-items: center; justify-content: center; width: 40px; height: 35px;" type="button">
                                                            <i class="zmdi zmdi-check" style="font-size: 20px;"></i>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="<?= $table->status === 'pengajuan' ? 'badge badge-danger' : 'badge badge-warning'; ?>">
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
        var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
        $('#signature-edit').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Apa anda yakin?',
                text: 'ID Pembelian Barang <?= $table->id_pembelian_barang; ?> akan di approved',
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
                        url: "<?= base_url('approve/' . $table->id_pembelian_barang); ?>",
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
        $('.btn-tolak').on('click', function() {
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
                text: 'kode booking <?= $table->id_pembelian_barang; ?> akan di Tolak',
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
                        url: "<?= base_url('tolak/' . $table->id_pembelian_barang); ?>",
                        data: formData,
                        success: function(d) {
                            if (d['success']) {
                                $('input[name=rscript]').val(d['rscript']);
                                $('#ModalSignatureEditditolak').modal('hide')
                                location.reload();
                                Swal.fire('Pengajuan ditolak', d['msg'], 'success')
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
        $('.btn-proses').on('click', function() {
            processStart();
            var formData = $(this).serialize();
            $.ajax({
                type: 'post',
                dataType: 'json',
                url: "<?= base_url('proses_pembelian/' . $table->kode_barang); ?>", // Adjust the URL as needed
                data: formData,
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
            $.getJSON("<?= base_url('get_pembelian_perawatan/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_kode_barang]').val(d['data'].kode_barang);
                }
            });
        });
        $('.update-multipart').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var f_data = new FormData(this);
            $.ajax({
                url: e.target.action,
                data: f_data,
                type: 'post',
                dataType: 'json',
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
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
        })
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
    })
</script>