<!-- Main Content -->
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
                                <small class="info">1 bln</small>
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
                                <small class="info">1 bln</small>
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
                                <small class="info">1 bln</small>
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
                                <small class="info">1 bln</small>
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
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12 col-lg-12">
                    <div class="card visitors-map">
                        <div class="header">
                            <h2><strong>Timeline</strong> Booking</h2>
                        </div>
                        <div class="body">
                            <div id="calendar"></div>
                        </div>
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
</section>

<!-- Default Size -->
<div class="modal fade" id="addevent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Add Event</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="form-line">
                        <input type="number" class="form-control" placeholder="Event Date">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <input type="text" class="form-control" placeholder="Event Title">
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-line">
                        <textarea class="form-control no-resize" placeholder="Event Description..."></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-round waves-effect">Add</button>
                <button type="button" class="btn btn-simple btn-round waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        var dataBooking = [
            <?php foreach ($booking as $schedule) : ?> {
                    title: '<?= $schedule->acara_kegiatan; ?>',
                    start: '<?= $schedule->tanggal_pemakaian; ?>',
                    className: '<?= $schedule->status === "baru" ? "bg-info text-light" : ($schedule->status === "diproses" ? "bg-warning text-light" : ($schedule->status === 'selesai' ? "bg-success text-light" : "bg-primary text-light")) ?>',
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