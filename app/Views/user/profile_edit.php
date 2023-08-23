<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Edit Profile
                    <small class="text-muted">Welcome to <?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> <?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Edit Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Form Edit Profile</h2>
                        <ul class="header-dropdown">
                            <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                <ul class="dropdown-menu dropdown-menu-right slideUp float-right">
                                    <li><a href="javascript:void(0);">Edit</a></li>
                                    <li><a href="javascript:void(0);">Delete</a></li>
                                    <li><a href="javascript:void(0);">Report</a></li>
                                </ul>
                            </li>
                            <li class="remove">
                                <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <?= form_open_multipart(base_url('user/profile_edit'), ['class' => 'form-submit']); ?>
                        <div class="row clearfix">
                            <div class="col-md-1">
                                <div class="avatar-xl mb-3">
                                    <img src="<?= _siteURL('master/assets/img/profile/thumb/' . $user->foto); ?>" alt="" class="img-fluid rounded-circle d-block h-100 w-100 user-photo">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input class="form-control" type="file" name="photo" accept="image/jpg, image/jpeg, image/png">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input class="form-control" type="text" name="nama" value="<?= $user->nama; ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input class="form-control" type="text" name="jabatan" value="<?= $user->jabatan; ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="choices-single-default" class="form-label font-size-13 text-muted">Jenis Kelamin</label>
                                    <select class="form-control show-tick" name="jk">
                                        <option value="" selected disabled>- Pilih Jenis Kelamin -</option>
                                        <option value="Laki-Laki" <?= $user->jk == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= $user->jk == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                        <div class="invalid-feedback"></div>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">No. Handphone</label>
                                    <input class="form-control" type="number" name="hp" value="<?= str_replace('+62', '0', $user->hp); ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input class="form-control" type="text" name="tmpt_lahir" value="<?= $user->tmpt_lahir; ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker-basic" name="tgl_lahir" value="<?= $user->tgl_lahir; ?>">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12 text-right pt-5">
                                <button type="<?= base_url('user/security_save'); ?>" class="btn btn-primary btn-round">Simpan</button>
                                <a type="button" class="btn btn-round btn-simple" href="<?= base_url('user/index'); ?>">Batal</a>
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
        $('.form-submit').on('submit', function(e) {
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
                    processDone();
                    if (d['success'] > 0) {
                        window.location.href = '<?= base_url('user/index'); ?>';
                    } else {
                        invalidError(d);
                    }
                }
            });
        })
    });
</script>