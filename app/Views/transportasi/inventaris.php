<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Transportasi
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Transportasi</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Transportasi</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>Jenis Kendaraan</th>
                                        <th>Merk</th>
                                        <th>Brand</th>
                                        <th>Warna</th>
                                        <th>Tanggal Pajak</th>
                                        <th>No Asuransi</th>
                                        <th>Tanggal Terakhir Steam</th>
                                        <th>Tanggal Terakhir Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($inventaris_transport as $table) : ?>
                                        <tr>
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