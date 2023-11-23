<section class="content page-calendar">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Timeline
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
        <div class="row  pb-3 pt-3 pl-3">
            <a href="<?= base_url(''); ?>" class="btn btn-danger" type="button">back</a>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <ul class="cbp_tmtimeline">
                    <?php if ($booking->id_status >= 6) : ?>
                        <li>
                            <time class="cbp_tmtime"><span class="hidden"><?= (date('D', $booking->selesai_at)); ?></span> <span class="large"><?= date('d-m-Y H:i:s', $booking->selesai_at); ?></span></time>
                            <div class="cbp_tmicon bg-green"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel empty">
                                <span><?= $booking->selesai_by; ?></span>
                                <p><?= $booking->id_status == 6 ? 'selesai' : 'selesai'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($booking->id_status >= 5) : ?>
                        <li>
                            <time class="cbp_tmtime"><span><?= (date('D', $booking->ditolak_at)); ?></span> <span><?= date('d-m-Y H:i:s', $booking->ditolak_at); ?></span></time>
                            <div class="cbp_tmicon bg-danger"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $booking->ditolak_by; ?></h2>
                                <p><?= $booking->id_status == 5 ? 'ditolak' : 'ditolak'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($booking->id_status >= 4) : ?>
                        <li>
                            <time class="cbp_tmtime"><span><?= (date('D', $booking->approved_rt_at)); ?></span> <span><?= date('d-m-Y H:i:s', $booking->approved_rt_at); ?></span></time>
                            <div class="cbp_tmicon bg-blush"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $booking->approved_rt_by; ?></a></h2>
                                <p><?= $booking->id_status == 4 ? 'diproses' : 'diproses'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($booking->id_status >= 3) : ?>
                        <li>
                            <time class="cbp_tmtime"><span><?= (date('D', $booking->approved_kadiv_at)); ?></span> <span><?= date('d-m-Y H:i:s', $booking->approved_kadiv_at); ?></span></time>
                            <div class="cbp_tmicon bg-orange"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $booking->approved_kadiv_by; ?></a></h2>
                                <p><?= $booking->id_status == 3 ? 'approved kadiv' : 'approved kadiv'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($booking->id_status >= 2) : ?>
                        <li>
                            <time class="cbp_tmtime"><span><?= (date('D', $booking->approved_kadep_at)); ?></span> <span><?= date('d-m-Y H:i:s', $booking->approved_kadep_at); ?></span></time>
                            <div class="cbp_tmicon bg-orange"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $booking->approved_kadep_by; ?></a></h2>
                                <p><?= $booking->id_status == 2 ? 'approved kadep' : 'approved kadep'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                    <?php if ($booking->id_status >= 1) : ?>
                        <li>
                            <time class="cbp_tmtime"><span><?= (date('D', $booking->created_at)); ?></span> <span><?= date('d-m-Y H:i:s', $booking->created_at); ?></span></time>
                            <div class="cbp_tmicon bg-info"><i class="zmdi zmdi-calendar"></i></div>
                            <div class="cbp_tmlabel">
                                <h2><a href="javascript:void(0);"><?= $booking->nama; ?></a></h2>
                                <p><?= $booking->id_status == 1 ? 'baru' : 'baru'; ?></p>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>