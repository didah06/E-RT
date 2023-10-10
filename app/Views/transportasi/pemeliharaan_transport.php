<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="pt-3 pl-3">
                <h2>Pemeliharaan Transportasi</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="row">
                            <a href="<?= base_url('inventaris'); ?>" class="btn btn-danger" type="button">kembali</a>
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kendaraan</th>
                                                <th>Merk</th>
                                                <th>Warna</th>
                                                <th>Tahun Kendaraan</th>
                                                <th>No Polisi</th>
                                                <th>Tanggal STNK</th>
                                                <th>No Asuransi</th>
                                                <th>Tanggal Pajak</th>
                                                <th>Tanggal Terakhir Steam</th>
                                                <th>Tanggal Terakhir Service</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($inventaris_transport as $table) : ?>
                                                <tr>
                                                    <td><?= $table->jenis_kendaraan; ?></td>
                                                    <td><?= $table->merk; ?></td>
                                                    <td><?= $table->warna; ?></td>
                                                    <td><?= $table->no_polisi; ?></td>
                                                    <td><?= $table->tahun_kendaraan; ?></td>
                                                    <td><?= $table->tgl_stnk; ?></td>
                                                    <td><?= $table->no_asuransi; ?></td>
                                                    <td><?= $table->tgl_pajak; ?></td>
                                                    <td><?= $table->tgl_terakhir_steam; ?></td>
                                                    <td><?= $table->tgl_service_terakhir; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-6">
                                <div class="row">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#ModalAsuransi"><i class="zmdi zmdi-plus"> Asuransi Kendaraan</i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No Asuransi</th>
                                                <th>Asuransi</th>
                                                <th>Masa Berlaku Asuransi</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($asuransi as $table) : ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-warning btn-edit-asuransi" style="align-items: center; justify-content: center;" data-id="<?= $table->id_asuransi; ?>" data-toggle="modal" data-target="#ModalEditAsuransi" type="button">
                                                            <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                            </button>
                                                    </td>
                                                    <td><?= $table->no_asuransi; ?></td>
                                                    <td><?= $table->asuransi; ?></td>
                                                    <td><?= $table->masa_berlaku_asuransi; ?></td>
                                                    <td>
                                                        <span class="<?= $table->is_aktif == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                                    </td>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#ModalPajak"><i class="zmdi zmdi-plus"> Pajak Kendaraan</i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Pajak</th>
                                                <th>foto</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($pajak as $table) : ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-warning btn-edit-pajak" style="align-items: center; justify-content: center;" data-id="<?= $table->id_pajak; ?>" data-toggle="modal" data-target="#ModalEditPajak" type="button">
                                                            <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                            </button>
                                                    </td>
                                                    <td><?= $table->tgl_pajak; ?></td>
                                                    <td><?= $table->foto_pajak; ?></td>
                                                    <td>
                                                        <span class="<?= $table->is_aktif == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                                    </td>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- modal -->
                        <div class="modal fade" id="ModalAsuransi" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Tambah Asuransi Transport</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('asuransi_save'), ['class' => 'add-form']); ?>
                                        <input type="hidden" name="id_kendaraan" value="<?= $ms_transport->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">No Asuransi</label>
                                                <input type="text" class="form-control" name="no_asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Asuransi</label>
                                                <input type="text" class="form-control" name="asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Masa Berlaku Asuransi</label>
                                                <input type="date" class="form-control" name="masa_berlaku_asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="modal fade" id="ModalEditAsuransi" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Edit Pemeliharaan Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('asuransi_update'), ['class' => 'update-form']); ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="e_id_asuransi">
                                        <input type="hidden" name="id_kendaraan" value="<?= $asuransi_tp->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">No Asuransi</label>
                                                <input type="text" class="form-control" name="e_no_asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">asuransi</label>
                                                <input type="text" class="form-control" name="e_asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Masa Berlaku Asuransi</label>
                                                <input type="date" class="form-control" name="e_masa_berlaku_asuransi">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <!-- modal -->
                        <div class="modal fade" id="ModalPajak" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Tambah Pajak Transport</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('pajak_save'), ['class' => 'add-multipart']); ?>
                                        <input type="hidden" name="id_kendaraan" value="<?= $ms_transport->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Pajak</label>
                                                <input type="date" class="form-control" name="tgl_pajak">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto_pajak" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="modal fade" id="ModalEditPajak" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Edit Pemeliharaan Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('pajak_update'), ['class' => 'update-multipart']); ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="e_id_pajak">
                                        <input type="hidden" name="id_kendaraan" value="<?= $pajak_tp->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Pajak</label>
                                                <input type="date" class="form-control" name="e_tgl_pajak">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="e_foto_pajak" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="row pt-5">
                            <div class="col-md-6">
                                <div class="row">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#ModalService"><i class="zmdi zmdi-plus"> Service Kendaraan</i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Terakhir Service</th>
                                                <th>Nota Service</th>
                                                <th>Tempat Service</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($service as $table) : ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-warning btn-edit-service" style="align-items: center; justify-content: center;" data-id="<?= $table->id_service; ?>" data-toggle="modal" data-target="#ModalEditService" type="button">
                                                            <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                            </button>
                                                    </td>
                                                    <td><?= $table->tgl_service_terakhir; ?></td>
                                                    <td><?= $table->nota_service; ?></td>
                                                    <td><?= $table->tempat_service; ?></td>
                                                    <td>
                                                        <span class="<?= $table->is_aktif == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                                    </td>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <button class="btn btn-info" data-toggle="modal" data-target="#ModalSteam"><i class="zmdi zmdi-plus"> Steam Kendaraan</i></button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Tanggal Terakhir Steam</th>
                                                <th>Nota Steam</th>
                                                <th>Tempat Steam</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($steam as $table) : ?>
                                                <tr>
                                                    <td>
                                                        <span class="badge badge-warning btn-edit-steam" style="align-items: center; justify-content: center;" data-id="<?= $table->id_steam; ?>" data-toggle="modal" data-target="#ModalEditSteam" type="button">
                                                            <i class="zmdi zmdi-edit" style="font-size: 18px;"></i>
                                                            </button>
                                                    </td>
                                                    <td><?= $table->tgl_terakhir_steam; ?></td>
                                                    <td><?= $table->nota_steam; ?></td>
                                                    <td><?= $table->tempat_steam; ?></td>
                                                    <td>
                                                        <span class="<?= $table->is_aktif == 1 ? 'badge badge-success' : 'badge badge-danger'; ?>"><?= $table->is_aktif == 1 ? 'Aktif' : 'Tidak Aktif'; ?></span>
                                                    </td>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="ModalService" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Tambah Service Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('service_save'), ['class' => 'add-multipart']); ?>
                                        <input type="hidden" name="id_kendaraan" value="<?= $ms_transport->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Service Terakhir</label>
                                                <input type="date" class="form-control" name="tgl_service_terakhir">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nota Service</label>
                                                <input type="file" class="form-control" name="nota_service" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat Service</label>
                                                <input type="text" class="form-control" name="tempat_service">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="modal fade" id="ModalEditService" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Edit Pemeliharaan Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('service_update'), ['class' => 'update-multipart']); ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="e_id_service">
                                        <input type="hidden" name="id_kendaraan" value="<?= $service_tp->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Service Terakhir</label>
                                                <input type="date" class="form-control" name="e_tgl_service_terakhir">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nota Service</label>
                                                <input type="file" class="form-control" name="e_nota_service" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat Service</label>
                                                <input type="text" class="form-control" name="e_tempat_service">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="modal fade" id="ModalSteam" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Tambah Steam Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('steam_save'), ['class' => 'add-multipart']); ?>
                                        <input type="hidden" name="id_kendaraan" value="<?= $ms_transport->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Steam Terakhir</label>
                                                <input type="date" class="form-control" name="tgl_terakhir_steam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nota Steam</label>
                                                <input type="file" class="form-control" name="nota_steam" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat Steam</label>
                                                <input type="text" class="form-control" name="tempat_steam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                        </div>
                        <div class="modal fade" id="ModalEditSteam" data-backdrop="false" role="dialog">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="exampleModalLongTitle">Edit Pemeliharaan Kendaraan</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="error-area"></div>
                                        <?= form_open(base_url('steam_update'), ['class' => 'update-multipart']); ?>
                                        <input type="hidden" name="_method" value="PUT" />
                                        <input type="hidden" name="e_id_steam">
                                        <input type="hidden" name="id_kendaraan" value="<?= $steam_tp->id_kendaraan; ?>">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="form-label">Tanggal Steam Terakhir</label>
                                                <input type="date" class="form-control" name="e_tgl_terakhir_steam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nota Steam</label>
                                                <input type="file" class="form-control" name="e_nota_steam" accept="image/png, image/jpeg, image/jpg">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat Steam</label>
                                                <input type="text" class="form-control" name="e_tempat_steam">
                                                <div class="invalid-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-success">simpan</button>
                                            <button type="button" class="btn btn-secondary btn-round" data-dismiss="modal">Batal</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end modal -->
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
        $('.add-multipart').on('submit', function(e) {
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
                        location.reload();
                    } else {
                        processDone();
                        invalidError(d);
                    }
                }
            })
        });
        $('.btn-edit-asuransi').on('click', function() {
            $.getJSON("<?= base_url('asuransi_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_asuransi]').val(d['data'].id_asuransi);
                    $('input[name=e_no_asuransi]').val(d['data'].no_asuransi);
                    $('input[name=e_asuransi]').val(d['data'].asuransi);
                    $('input[name=e_masa_berlaku_asuransi]').val(d['data'].masa_berlaku_asuransi);
                }
            });
        });
        $('.update-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            $.ajax({
                url: e.target.action,
                data: $(this).serialize(),
                type: 'post',
                dataType: 'json',
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
        $('.btn-edit-pajak').on('click', function() {
            $.getJSON("<?= base_url('pajak_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_pajak]').val(d['data'].id_pajak);
                    $('input[name=e_tgl_pajak]').val(d['data'].tgl_pajak);
                }
            });
        });
        $('.btn-edit-service').on('click', function() {
            $.getJSON("<?= base_url('service_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_service]').val(d['data'].id_service);
                    $('input[name=e_tgl_service_terakhir]').val(d['data'].tgl_service_terakhir);
                    $('input[name=e_tempat_service').val(d['data'].tempat_service);
                }
            });
        });
        $('.btn-edit-steam').on('click', function() {
            $.getJSON("<?= base_url('steam_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_steam]').val(d['data'].id_pajak);
                    $('input[name=e_tgl_terakhir_steam]').val(d['data'].tgl_terakhir_steam);
                    $('input[name=e_tempat_steam').val(d['data'].tempat_steam);
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
    });
</script>