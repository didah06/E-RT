<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Tambah User
                    <small class="text-muted">Welcome to <?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> <?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Tambah User</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Form User </h2>
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
                        <div class="row clearfix">
                            <div class="col-md-6">
                                <label>User</label>
                                <select class="form-control select-only" name="user_id">
                                    <option value="" selected disabled>--Pilih User--</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label>User</label>
                                <select class="form-control select-only" name="user_id">
                                    <option value="" selected disabled>--Pilih User--</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="col-sm-6">
                                <label>Nama</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Jenis Kelamin</label>
                                <select class="form-control show-tick">
                                    <option value="">- Pilih Jenis Kelamin -</option>
                                    <option value="10">Laki-Laki</option>
                                    <option value="20">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Jabatan</label>
                                <select class="form-control show-tick">
                                    <option value="">- Pilih Jabatan -</option>
                                    <option value="10">SATPAM</option>
                                    <option value="20">Office Boy</option>
                                </select>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-12 text-right pt-5">
                                <button type="<?= base_url('user/security_save'); ?>" class="btn btn-primary btn-round">Simpan</button>
                                <a type="button" class="btn btn-round btn-simple" href="<?= base_url('user/user_security'); ?>">Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>