<section class="content profile-page">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Profile
                    <small class="text-muted">Welcome to <?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> <?= appName(); ?></a></li>
                    <li class="breadcrumb-item active"> Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-lg-4 col-md-12">
            <div class="card member-card">
                <div class="header" style="min-height: 30px;">
                    <ul class="header-dropdown">
                        <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                <li><a href="<?= base_url('profile_edit'); ?>">Edit Profile</a></li>
                                <li><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                        Ganti Password
                                    </button></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <?php if (session()->getFlashdata('success')) : ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <div class="header l-cyan">
                        <h4 class="m-t-10"><?= $user_login->nama; ?></h4>
                    </div>
                    <div class="member-img">
                        <a href="profile.html">
                            <img src="<?= _siteURL('master/assets/img/profile/thumb/' . $user_login->foto); ?>" class="rounded-circle" alt="profile-image" height="130px">
                        </a>
                    </div>
                    <div class="d-flex flex-wrap text-center">
                        <ul class="profile-detail pt-3">
                            <li>
                                <?= $user_login->role; ?>
                            </li>
                        </ul>
                        <ul class="profile-detail pt-3">
                            <li><?= $user_login->username; ?></li>
                        </ul>
                        <div class="profile-detail pl-4">
                            <p class="text-muted">Terakhir login <?= date('d-m-Y H:i:s', $user_login->last_login); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="myModal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLongTitle">Ganti Password</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?= form_open(base_url('change_password'), ['class' => 'form_update']); ?>
                            <label for="exampleInputPassword1">Password</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="password" id="password" name="password" value="<?= old('password'); ?>" placeholder="Enter Password" class="form-control" />
                                    <span class="input-group-addon pl-2">
                                        <div class="zmdi zmdi-eye icon" id="show-password"></div>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <label for="exampleInputPassword1">Password Baru</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="password" id="new_password" name="new_password" value="<?= old('password'); ?>" placeholder="Enter New Password" class="form-control" />
                                    <span class="input-group-addon pl-2">
                                        <div class="zmdi zmdi-eye icon-new" id="show-password"></div>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <label for="exampleInputPassword1">Konfirmasi Password</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter Konfirmasi Password" class="form-control" />
                                    <span class="input-group-addon pl-2">
                                        <div class="zmdi zmdi-eye icon-confirm" id="show-password"></div>
                                    </span>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal -->

            <div class="card" style="width: 100%;">
                <ul class="nav nav-tabs">
                    <!-- <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#signature">Signature</a></li> -->
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#signature">Signature</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#friends">Rekan Departemen</a></li> -->
                </ul>
                <div class="tab-content">
                    <div class="tab-pane body active" id="signature">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-3">Signature</h5>

                                <div class="card">
                                    <div class="card-body p-1 text-center">
                                        <img class="img-sign" src="<?= base_url('public/assets/images/ttd/' . $user_login->ttd); ?>" width="100%">
                                    </div>
                                    <div class="card-footer text-center p-2">
                                        <button class="btn btn-rounded btn-success waves-effect waves-light" data-toggle="modal" data-target="#ModalSignature">Edit Signature</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Signature Edit -->
                            <!-- modal -->
                            <div class="modal fade" id="ModalSignature" data-backdrop="false" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title" id="exampleModalLongTitle">Edit Signature</h6>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="error-area"></div>
                                            <?= form_open(base_url('signature'), ['class' => 'signature-form']); ?>
                                            <div class="mb-3 text-center">
                                                <div class="signature-wrapper">
                                                    <canvas id="signature-pad" class="signature-pad border" width="250" height=150></canvas>
                                                </div>
                                            </div>
                                            <div class="mb-3 text-center">
                                                <button class="btn btn-light waves-effect waves-light me-1" data-dismiss="modal" type="button">Batal</button>
                                                <button class="btn btn-danger waves-effect waves-light signature-clear me-1" type="button">Hapus</button>
                                                <button class="btn btn-primary waves-effect waves-light load-click" type="submit">Simpan</button>
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
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user">Profile Details</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Notifications</a></li> -->
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="user">
                    <div class="card" style="height: 100%;">
                        <div class="header" style="padding-bottom: 63%;">
                            <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->jk ?></p>
                            <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->tmpt_lahir; ?></p>
                            <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->tgl_lahir; ?></p>
                            <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->jabatan; ?></p>
                            <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->role; ?></p>
                        </div>
                    </div>
                </div>
                <!-- <div role="tabpanel" class="tab-pane" id="usersettings">
                    <div class="card">
                        <div class="header">
                            <strong>Notifications</strong>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    </div>
</section>
<script>
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

        $('#ModalSignature').on('hidden.modal', function(e) {
            signaturePad.clear();
            $('.alert').remove();
        });
        $('.signature-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            var f_data = new FormData(this);
            f_data.append('signature', signaturePad.toDataURL());
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: f_data,
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
                    processDone();
                    if (d['success'] > 0) {
                        $('input[name=rscript]').val(d['rscript']);
                        $('#ModalSignature').modal('hide');
                        $('.img-sign').attr('src', d['signature']);
                        notification('Signature berhasil diubah');
                    } else {
                        invalidError(d);
                    }
                }
            })
        });
        $('.form_update').on('submit', function(e) {
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
                    processDone();
                    if (d['success'] > 0) {
                        $('input[name=rscript]').val(d['rscript']);
                        $('#myModal').modal('hide');
                        toastr.success('Password anda berhasil diubah');
                    } else {
                        invalidError(d);
                    }
                }
            });
        });
        $('.icon').click(function() {
            if ($('#password').attr('type') == 'text') {
                $('#password').attr('type', 'password');
            } else {
                $('#password').attr('type', 'text');
            }
        });
        $('.icon-new').click(function() {
            if ($('#new_password').attr('type') == 'text') {
                $('#new_password').attr('type', 'password');
            } else {
                $('#new_password').attr('type', 'text');
            }
        });
        $('.icon-confirm').click(function() {
            if ($('#confirm_password').attr('type') == 'text') {
                $('#confirm_password').attr('type', 'password');
            } else {
                $('#confirm_password').attr('type', 'text');
            }
        });
    });
</script>