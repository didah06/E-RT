<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>All Patients
                    <small class="text-muted">Welcome to Compass</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Compass</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Patients</a></li>
                    <li class="breadcrumb-item active">All Patients</li>
                </ul>
            </div>
            <div class="btn-user pt-3 pl-3">
                <a href="<?= base_url('user/security_add'); ?>" type="button" class="btn btn-info"><i class="zmdi zmdi-plus-circle"></i>Add User</a>
                <a href="<?= base_url('user/security_import'); ?>" type="button" class="btn btn-warning"><i class="zmdi zmdi-cloud-upload"></i>Import Data</a>
                <a href="<?= base_url('user/security_export'); ?>" type="button" class="btn btn-success"><i class="zmdi zmdi-cloud-download"></i>Export Data</a>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card patients-list">
            <div class="body">
                <div class="table-responsive" id="datatables">
                    <table id="datatables" class="table m-b-0 table-hover">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Jenis Kelamin</th>
                                <th>Jabatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($user as $table) : ?>
                                <tr>
                                    <td><?= $table->nama; ?></td>
                                    <td><?= $table->username; ?></td>
                                    <td><?= $table->jk; ?></td>
                                    <td><?= $table->jabatan; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({});
    })
</script>