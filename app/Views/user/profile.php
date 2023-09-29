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

            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#about">Profile Details</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#friends">Rekan Departemen</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane body active" id="about">
                        <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->jk ?></p>
                        <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->tmpt_lahir; ?></p>
                        <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->tgl_lahir; ?></p>
                        <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->jabatan; ?></p>
                        <p><i class="zmdi zmdi-caret-right"></i>&nbsp;<?= $user_login->role; ?></p>
                    </div>
                    <div class="tab-pane body" id="friends">
                        <?php if (count($rekan) == 0) : ?>
                            <p class="card-title-desc text-center">--Tidak ada--</p>
                        <?php endif; ?>
                        <?php foreach ($rekan as $team) : ?>
                            <div class="row">
                                <div class="column pl-2 pr-3">
                                    <img src="<?= _siteURL('master/assets/img/profile/thumb/' . $team->foto); ?>" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="column">
                                    <p><?= strlen($team->nama) > 20 ? trim(substr($team->nama, 0, 20)) . '...' : $team->nama; ?></p>
                                    <small><?= $team->jabatan; ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="card">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#timeline">Notifications</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#usersettings">Signature</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="timeline">
                    <div class="card">
                        <div class="header">
                            <strong>Notification</strong>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="usersettings">
                    <div class="card">
                        <div class="header text-center">
                            <strong>Signature</strong>
                        </div>
                        <div class="body text-center">
                            <button class="btn btn-info btn-round">Edit Signature</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function() {
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