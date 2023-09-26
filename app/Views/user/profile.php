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
                                    <input type="password" class="form-control" name="password" value="<?= old('password'); ?>" placeholder="Enter Password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="zmdi zmdi-eye icon"></i></div>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <label for="exampleInputPassword1">Password Baru</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" name="new_password" value="<?= old('password'); ?>" placeholder="Enter New Password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="zmdi zmdi-eye icon"></i></div>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <label for="exampleInputPassword1">Konfirmasi Password</label>
                            <div class="form-group">
                                <div class="input-group mb-2">
                                    <input type="password" class="form-control" name="confirm_password" placeholder=" Enter Konfirmasi Password">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="zmdi zmdi-eye icon"></i></div>
                                    </div>
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
                    <ul class="cbp_tmtimeline">
                        <li>
                            <time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden">25/12/2017</span> <span class="large">Now</span></time>
                            <div class="cbp_tmicon"><i class="zmdi zmdi-account"></i></div>
                            <div class="cbp_tmlabel empty"> <span>No Activity</span> </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-11-04T03:45"><span>03:45 AM</span> <span>Today</span></time>
                            <div class="cbp_tmicon bg-info"><i class="zmdi zmdi-label"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Art Ramadani</a> <span>posted a status update</span></h2>
                                <p>Tolerably earnestly middleton extremely distrusts she boy now not. Add and offered prepare how cordial two promise. Greatly who affixed suppose but enquire compact prepare all put. Added forth chief trees but rooms think may.</p>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-11-03T13:22"><span>01:22 PM</span> <span>Yesterday</span></time>
                            <div class="cbp_tmicon bg-green"> <i class="zmdi zmdi-case"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Job Meeting</a></h2>
                                <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
                            <div class="cbp_tmicon bg-blush"><i class="zmdi zmdi-pin"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Arlind Nushi</a> <span>checked in at</span> <a href="javascript:void(0);">New York</a></h2>
                                <blockquote>
                                    <p class="blockquote blockquote-primary">
                                        "It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout."
                                        <br>
                                        <small>
                                            - Isabella
                                        </small>
                                    </p>
                                </blockquote>
                                <div class="row clearfix">
                                    <div class="col-lg-12">
                                        <div class="map m-t-10">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d193595.91477011208!2d-74.11976308802028!3d40.69740344230033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sin!4v1508039335245" frameborder="0" style="border:0; width: 100%;" allowfullscreen=""></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Two weeks ago</span></time>
                            <div class="cbp_tmicon bg-orange"><i class="zmdi zmdi-camera"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Eroll Maxhuni</a> <span>uploaded</span> 4 <span>new photos to album</span> <a href="javascript:void(0);">Summer Trip</a></h2>
                                <blockquote>Pianoforte principles our unaffected not for astonished travelling are particular.</blockquote>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"><img src="<?= base_url(); ?>/public/assets/images/image1.jpg" alt="" class="img-fluid img-thumbnail m-t-30"></a> </div>
                                    <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="<?= base_url(); ?>/public/assets/images/image2.jpg" alt="" class="img-fluid img-thumbnail m-t-30"></a> </div>
                                    <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="<?= base_url(); ?>/public/assets/images/image3.jpg" alt="" class="img-fluid img-thumbnail m-t-30"> </a> </div>
                                    <div class="col-lg-3 col-md-6 col-6"><a href="javascript:void(0);"> <img src="<?= base_url(); ?>/public/assets/images/image4.jpg" alt="" class="img-fluid img-thumbnail m-t-30"> </a> </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-11-03T13:22"><span>01:22 PM</span> <span>Two weeks ago</span></time>
                            <div class="cbp_tmicon bg-green"> <i class="zmdi zmdi-case"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Job Meeting</a></h2>
                                <p>You have a meeting at <strong>Laborator Office</strong> Today.</p>
                            </div>
                        </li>
                        <li>
                            <time class="cbp_tmtime" datetime="2017-10-22T12:13"><span>12:13 PM</span> <span>Month ago</span></time>
                            <div class="cbp_tmicon bg-blush"><i class="zmdi zmdi-pin"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);">Arlind Nushi</a> <span>checked in at</span> <a href="javascript:void(0);">Laborator</a></h2>
                                <blockquote>Great place, feeling like in home.</blockquote>
                            </div>
                        </li>
                    </ul>
                </div>
                <div role="tabpanel" class="tab-pane" id="usersettings">
                    <div class="card">
                        <div class="header">
                            <h2><strong>Security</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Enter Password" name="password" value="<?= old('password'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Enter Password" name="new password" value="<?= old('password'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Enter Password" name="confirm_password" value="<?= old('password'); ?>">
                                </div>
                                <button class="btn btn-info btn-round" type="submit">Save Changes</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Country">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea rows="4" class="form-control no-resize" placeholder="Address Line 1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkbox">
                                        <input id="procheck1" type="checkbox">
                                        <label for="procheck1">Profile Visibility For Everyone</label>
                                    </div>
                                    <div class="checkbox">
                                        <input id="procheck2" type="checkbox">
                                        <label for="procheck2">New task notifications</label>
                                    </div>
                                    <div class="checkbox">
                                        <input id="procheck3" type="checkbox">
                                        <label for="procheck3">New friend request notifications</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-round">Save Changes</button>
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
    });
</script>