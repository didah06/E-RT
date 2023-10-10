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
                                <h5 class="m-t-0">Traffic</h5>
                                <p class="text-small">4% higher than last month</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="">20</h2>
                                <small class="info">of 1Tb</small>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Sales</h5>
                                <p class="text-small">6% higher than last month</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="">12%</h2>
                                <small class="info">of 100</small>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" style="width: 38%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Email</h5>
                                <p class="text-small">Total Registered email</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="">39</h2>
                                <small class="info">of 100</small>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100" style="width: 39%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="col-lg-3 col-md-6 col-sm-12">
                    <div class="body">
                        <div class="row">
                            <div class="col-7">
                                <h5 class="m-t-0">Domians</h5>
                                <p class="text-small">Total registered Domain</p>
                            </div>
                            <div class="col-5 text-right">
                                <h2 class="">8</h2>
                                <small class="info">of 10</small>
                            </div>
                            <div class="col-12">
                                <div class="progress m-t-20">
                                    <div class="progress-bar l-turquoise" role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="card">
                <div class="row">
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="body">
                            <div id="calendar" class="m-t-20"></div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-6">
                        <div class="body">
                            <div class="collapse-xs collapse-sm collapse" id="open-events">
                                <hr>
                                <div class="event-name b-primary row">
                                    <div class="col-2 text-center">
                                        <h4>11<span>Dec</span><span>2017</span></h4>
                                    </div>
                                    <div class="col-10">
                                        <h6>Conference</h6>
                                        <p>It is a long established fact that a reader will be distracted</p>
                                        <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                                    </div>
                                </div>
                                <div class="event-name b-primary row">
                                    <div class="col-2 text-center">
                                        <h4>13<span>Dec</span><span>2017</span></h4>
                                    </div>
                                    <div class="col-10">
                                        <h6>Birthday</h6>
                                        <p>It is a long established fact that a reader will be distracted</p>
                                        <address><i class="zmdi zmdi-pin"></i> 123 6th St. Melbourne, FL 32904</address>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
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
                    url: '<?= base_url('details/' . $schedule->id_booking); ?>',
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
            events: dataBooking
        });
    });
</script>