<!-- Main Content -->
<style>
    .star {
        font-size: 24px;
        cursor: pointer;
        color: #ddd;
        /* Default star color */
    }

    .star.active {
        color: #FFD700;
        /* Active star color (e.g., yellow) */
    }
</style>
<section class="content page-calendar">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Dashboard
                    <small class="text-muted">Welcome to Compass</small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Compass</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">App</a></li>
                    <li class="breadcrumb-item active">Calendar</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card widget_2">
            <ul class="row clearfix list-unstyled m-b-0">
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Baru</h5>
                                <p class="text-small">Total Booking Baru</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="baru-value"><?= $baru; ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-amber" id="baru" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Diproses</h5>
                                <p class="text-small">Total Booking Diproses</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="proses-value"><?= $diproses; ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-parpl" id="diproses" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Selesai</h5>
                                <p class="text-small">Total Booking Selesai</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="selesai-value"><?= $selesai; ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-turquoise" id="selesai" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Ditolak</h5>
                                <p class="text-small">Total Booking Ditolak</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="ditolak-value"><?= $ditolak; ?></h2>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-turquoise" id="ditolak" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 col-lg-8">
                <div class="card visitors-map">
                    <div class="header">
                        <h2><strong>Jadwal</strong> Booking Transportasi</h2>
                    </div>
                    <div class="body">
                        <!-- <div id="world-map-markers" class="jvector-map m-b-5"></div> -->
                        <div class="row clearfix">
                            <div class="col-lg-6 col-sm-10">
                                <div id="calendar"></div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <h5>Keterangan</h5>
                                <div class="progress-container">
                                    <span class="progress-badge">booking baru</span>
                                    <div class="progress" style="height: 15px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-badge">booking Approved</span>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-badge">booking Proses</span>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="progress-badge">booking Selesai</span>
                                    <div class="progress" style="height: 20px;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>Infomasi Kegiatan</strong> Security</h2>
                    </div>
                    <div class="body">
                        <!-- <div id="donut_chart" class="dashboard-donut-chart"></div> -->
                        <table class="table m-b-0">
                            <tbody>
                                <h6>Informasi</h6>
                                <?php
                                $currentDate = date('Y-m-d');
                                $foundInformation = false; // Flag to check if matching information was found

                                foreach ($informasi as $table) :
                                    if ($table->tgl_kegiatan == $currentDate) :
                                        $foundInformation = true;
                                ?>
                                        <tr>
                                            <td><?= $table->nama_kegiatan; ?></td>
                                            <td><?= $table->waktu_kegiatan; ?></td>
                                            <td><?= $table->tempat_kegiatan; ?></td>
                                        </tr>
                                    <?php
                                    endif;
                                endforeach;

                                if (!$foundInformation) :
                                    ?>
                                    <tr>
                                        <td>Tidak ada Informasi</td>
                                    </tr>
                                <?php
                                endif;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row-clearfix">
            <div class="col-lg-12">
                <div class="card activities">
                    <div class="header">
                        <h2><strong>Daftar Menu</strong>
                            Masakan Dapur
                        </h2>
                    </div>
                    <div class="body">
                        <?php
                        $currentDate = date('Y-m-d');
                        $currentDay = date('l');

                        echo "Menu Hari Ini $currentDay, $currentDate";
                        ?>
                        <div class="d-flex justify-content-around pt-3">
                            <?php
                            $currentDate = date('Y-m-d');
                            $foundmenu = false; // Flag to check if matching information was found

                            foreach ($daftar_menu as $table) :
                                if (($table->tgl_menu == $currentDate && $table->sesi_menu == 'pagi') || ($table->tgl_menu == $currentDate && $table->sesi_menu == 'siang') || ($table->tgl_menu == $currentDate && $table->sesi_menu == 'malam')) :
                                    $foundmenu = true;
                            ?>
                                    <?php if ($table->sesi_menu == 'pagi') : ?>
                                        <div class="card border-warning mb-3" style="width: 18rem;">
                                            <div class="card-header"><?= $table->sesi_menu; ?></div>
                                            <div class="card-body text-warning">
                                                <p class="card-text"><?= $table->menu_1; ?></p>
                                                <p class="card-text"><?= $table->menu_2; ?></p>
                                                <p class="card-text"><?= $table->menu_3; ?></p>
                                                <p class="card-text"><?= $table->menu_4; ?></p>
                                                <button class="btn btn-info btn-edit" data-id="<?= $table->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Penilaian & Saran</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($table->sesi_menu == 'siang') : ?>
                                        <div class="card border-info mb-3" style="width: 18rem;">
                                            <div class="card-header"><?= $table->sesi_menu; ?></div>
                                            <div class="card-body text-info">
                                                <p class="card-text"><?= $table->menu_1; ?></p>
                                                <p class="card-text"><?= $table->menu_2; ?></p>
                                                <p class="card-text"><?= $table->menu_3; ?></p>
                                                <p class="card-text"><?= $table->menu_4; ?></p>
                                                <button class="btn btn-info btn-edit" data-id="<?= $table->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Penilaian & Saran</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($table->sesi_menu == 'malam') : ?>
                                        <div class="card  border-success mb-3" style="width: 18rem;">
                                            <div class="card-header"><?= $table->sesi_menu; ?></div>
                                            <div class="card-body text-success">
                                                <p class="card-text"><?= $table->menu_1; ?></p>
                                                <p class="card-text"><?= $table->menu_2; ?></p>
                                                <p class="card-text"><?= $table->menu_3; ?></p>
                                                <p class="card-text"><?= $table->menu_4; ?></p>
                                                <button class="btn btn-info btn-edit" data-id="<?= $table->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Penilaian & Saran</button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php
                                endif;
                            endforeach;

                            if (!$foundmenu) :
                                ?>
                                <tr>
                                    <td>menu makan belum tersedia</td>
                                </tr>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal penilaian -->
        <div class="modal fade" id="ModalPenilaian" data-backdrop="false" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h7 class="modal-title text-center p-2" id="exampleModalLongTitle">Silahkan Berikan Rating dan Saran Anda!</h7>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="error-area"></div>
                        <?= form_open(base_url('penilaian'), ['class' => 'update-form']); ?>
                        <input type="hidden" name="_method" value="PUT" />
                        <input type="hidden" name="id_menu" id="id_menu">
                        <div class="row clearfix">
                            <div class="col-md-12 text-center">
                                <div class="rating">
                                    <span class="star" data-rating="1">&#9733;</span>
                                    <span class="star" data-rating="2">&#9733;</span>
                                    <span class="star" data-rating="3">&#9733;</span>
                                    <span class="star" data-rating="4">&#9733;</span>
                                    <span class="star" data-rating="5">&#9733;</span>
                                </div>
                                <p id="ratingValue" name="rating">Rating: 0</p>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">Saran & Komentar</label>
                                    <textarea class="form-control" id="saran" name="saran" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-3 pb-3">
                            <button type="submit" class="btn btn-success btn-round btn-save">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal for displaying event details -->
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Event Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="eventDetails">
                        <!-- Event details will be displayed here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    var ratingValue = 0;
    $(document).ready(function() {
        var dataBooking = [
            <?php foreach ($booking as $schedule) : ?> {
                    title: '<?= $schedule->acara_kegiatan; ?>',
                    start: '<?= $schedule->tanggal_pemakaian; ?>',
                    className: '<?= $schedule->status === "baru" ? "bg-info text-light" : ($schedule->status === "diproses" ? "bg-warning text-light" : ($schedule->status === 'selesai' ? "bg-success text-light" : ($schedule->status === "ditolak" ? "bg-danger text-light" : "bg-primary text-light"))) ?>',
                    url: '<?= base_url('details_timeline/' . $schedule->id_booking); ?>',
                },
            <?php endforeach; ?>

        ];
        $('#calendar').fullCalendar({
            header: {
                left: 'prev',
                center: 'title',
                right: 'next'
            },
            defaultDate: new Date(),
            editable: true,
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },
            eventLimit: true, // allow "more" link when too many events
            events: dataBooking,
        });
        $('.star').click(function() {
            const rating = $(this).data('rating');

            $('#ratingValue').text('Rating: ' + rating);

            ratingValue = rating;

            // Reset the color of all stars
            $('.star').removeClass('active');

            // Set the color of stars up to the clicked star
            for (let i = 1; i <= rating; i++) {
                $('.star[data-rating="' + i + '"]').addClass('active');
            }
        });
        $('.btn-edit').on('click', function() {
            $.getJSON("<?= base_url('penilaian_get/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=id_menu]').val(d['data'].id_menu);
                }
            });
        });
        $('.update-form').on('submit', function(e) {
            e.preventDefault();
            processStart();
            const ratingvalue = ratingValue;
            var formData = new FormData(this);
            formData.append('rating', ratingValue);
            $.ajax({
                url: e.target.action,
                type: 'post',
                dataType: 'json',
                data: formData,
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
        var baruValue = parseFloat($('.baru-value').text());
        var prosesValue = parseFloat($('.proses-value').text());
        var selesaiValue = parseFloat($('.selesai-value').text());
        var ditolakValue = parseFloat($('.ditolak-value').text());

        var percentagebaru = (baruValue / 30) * 100;
        var percentageproses = (prosesValue / 30) * 100;
        var percentageselesai = (selesaiValue / 30) * 100;
        var percentageditolak = (ditolakValue / 30) * 100;
        $('#baru').css('width', percentagebaru + '%');
        $('#diproses').css('width', percentageproses + '%');
        $('#selesai').css('width', percentageselesai + '%');
        $('#ditolak').css('width', percentageditolak + '%');
    });
</script>