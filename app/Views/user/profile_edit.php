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
                        <?= form_open_multipart(base_url('profile_update')) ?>
                        <div class="row clearfix">
                            <div class="col-md-1">
                                <div class="avatar-xl mb-3">
                                    <img src="<?= _siteURL('master/assets/img/profile/thumb/' . $user->foto); ?>" alt="" class="img-fluid rounded-circle d-block h-150 w-100 user-photo">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label">Foto</label>
                                    <input class="form-control <?= session()->getFlashdata('foto') ? 'is-invalid' : ''; ?>" type="file" name="foto" accept="image/jpg, image/jpeg, image/png">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('foto'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input class="form-control <?= session()->getFlashdata('nama') ? 'is-invalid' : ''; ?>" type="text" name="nama" value="<?= old('nama') ?? $user->nama; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('nama'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input class="form-control <?= session()->getFlashdata('jabatan') ? 'is-invalid' : ''; ?>" type="text" name="jabatan" value="<?= old('jabatan') ?? $user->jabatan; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('jabatan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="choices-single-default" class="form-label font-size-13 text-muted">Jenis Kelamin</label>
                                    <select class="form-control show-tick" name="jk">
                                        <option value="" selected disabled>- Pilih Jenis Kelamin -</option>
                                        <option value="Laki-Laki" <?= $user->jk == 'Laki-Laki' ? 'selected' : ''; ?>>Laki-Laki</option>
                                        <option value="Perempuan" <?= $user->jk == 'Perempuan' ? 'selected' : ''; ?>>Perempuan</option>
                                        <div class="invalid-feedback">
                                            <?= session()->getFlashdata('jk'); ?>
                                        </div>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">No. Handphone</label>
                                    <input class="form-control <?= session()->getFlashdata('hp') ? 'is-invalid' : ''; ?>" type="number" name="hp" value="<?= old('hp') ?? str_replace('+62', '0', $user->hp); ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('hp'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input class="form-control <?= session()->getFlashdata('tmpt_lahir') ? 'is-invalid' : ''; ?>" type="text" name="tmpt_lahir" value="<?= old('tmpt_lahir') ?? $user->tmpt_lahir; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('tmpt_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control datepicker-basic <?= session()->getFlashdata('tgl_lahir') ? 'is-invalid' : ''; ?>" name="tgl_lahir" value="<?= old('tgl_lahir') ?? $user->tgl_lahir; ?>">
                                    <div class="invalid-feedback">
                                        <?= session()->getFlashdata('tgl_lahir'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12 text-center pt-5">
                                    <button type="submit" class="btn btn-primary btn-round btn-save">Simpan</button>
                                    <a type="button" class="btn btn-round btn-simple" href="<?= base_url('profile'); ?>">Batal</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>