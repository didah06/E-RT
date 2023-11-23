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
<section class="content">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Penilaian Menu Dapur
                    <small class="text-muted"><?= appName(); ?></small>
                </h2>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">
                <button class="btn btn-primary btn-icon btn-round hidden-sm-down float-right m-l-10" type="button">
                    <i class="zmdi zmdi-plus"></i>
                </button>
                <ul class="breadcrumb float-md-right">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i><?= appName(); ?></a></li>
                    <li class="breadcrumb-item active">Penilaian Menu Dapur</li>
                </ul>
            </div>
            <div class=" pt-3 pl-3">
                <h2>Penilaian Menu Dapur</h2>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-md-12">
                <div class="card patients-list">
                    <div class="body">
                        <div class="col-md-12">
                            <form method="GET" action="<?= base_url('penilaian'); ?>">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" name="today" value="<?= $today; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mt-3">
                                            <button class="btn btn-warning" type="submit">search menu</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 ">
                            <div class="d-flex justify-content-around">
                                <div class="card-deck p-5">
                                    <?php foreach ($daftar_menu as $menu_today) : ?>
                                        <?php if ($menu_today->sesi_menu == 'pagi') : ?>
                                            <div class="card border-warning mb-3" style="width: 20rem;">
                                                <div class="card-header">
                                                    <p>menu <?= $menu_today->sesi_menu; ?></p>
                                                </div>
                                                <div class="card-body text-warning">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <?php if ($menu_today->saran == "" && $menu_today->rating == "") : ?>
                                                        <button class="btn btn-info btn-edit" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Berikan Review</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-info btn-edit-rating" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalEditPenilaian">Edit Review</button>
                                                    <?php endif; ?>
                                                    <?php if ($menu_today->saran != "" && $menu_today->rating != "") : ?>
                                                        <hr>
                                                        <div class="col-md-12 text-dark">
                                                            <p>Review</p>
                                                            <div class="row">
                                                                <?php
                                                                $rating = $menu_today->rating; // Get the rating value from your data
                                                                if ($rating < 0) {
                                                                    $rating = 0;
                                                                } elseif ($rating > 5) {
                                                                    $rating = 5;
                                                                }

                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    $class = ($i <= $rating) ? 'zmdi zmdi-star' : 'zmdi zmdi-star-outline';
                                                                    $color = ($i <= $rating) ? 'orange' : 'gray';
                                                                    echo '<i class="' . $class . '" style="color: ' . $color . ';"></i>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="row">
                                                                <p class="card-text">Saran : <?= $menu_today->saran; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($menu_today->sesi_menu == 'siang') : ?>
                                            <div class="card border-info mb-2" style="width: 20rem;">
                                                <div class="card-header">
                                                    <p>menu <?= $menu_today->sesi_menu; ?></p>
                                                </div>
                                                <div class="card-body text-info">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <?php if ($menu_today->saran == "" && $menu_today->rating == "") : ?>
                                                        <button class="btn btn-info btn-edit" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Berikan Review</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-info btn-edit-rating" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalEditPenilaian">Edit Review</button>
                                                    <?php endif; ?>
                                                    <?php if ($menu_today->saran != "" && $menu_today->rating != "") : ?>
                                                        <hr>
                                                        <div class="col-md-12 text-dark">
                                                            <p>Review</p>
                                                            <div class="row">
                                                                <?php
                                                                $rating = $menu_today->rating; // Get the rating value from your data
                                                                if ($rating < 0) {
                                                                    $rating = 0;
                                                                } elseif ($rating > 5) {
                                                                    $rating = 5;
                                                                }

                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    $class = ($i <= $rating) ? 'zmdi zmdi-star' : 'zmdi zmdi-star-outline';
                                                                    $color = ($i <= $rating) ? 'orange' : 'gray';
                                                                    echo '<i class="' . $class . '" style="color: ' . $color . ';"></i>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="row">
                                                                <p class="card-text">Saran : <?= $menu_today->saran; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($menu_today->sesi_menu == 'malam') : ?>
                                            <div class="card  border-success mb-3" style="width: 20rem;">
                                                <div class="card-header">
                                                    <p>menu <?= $menu_today->sesi_menu; ?></p>
                                                </div>
                                                <div class="card-body text-success">
                                                    <p class="card-text"><?= $menu_today->menu_1; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_2; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_3; ?></p>
                                                    <p class="card-text"><?= $menu_today->menu_4; ?></p>
                                                    <?php if ($menu_today->saran == "" && $menu_today->rating == "") : ?>
                                                        <button class="btn btn-info btn-edit" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalPenilaian">Berikan Review</button>
                                                    <?php else : ?>
                                                        <button class="btn btn-info btn-edit-rating" data-id="<?= $menu_today->id_menu; ?>" data-toggle="modal" data-target="#ModalEditPenilaian">Edit Review</button>
                                                    <?php endif; ?>
                                                    <?php if ($menu_today->saran != "" && $menu_today->rating != "") : ?>
                                                        <hr>
                                                        <div class="col-md-12 text-dark ">
                                                            <p>Review</p>
                                                            <div class="row">
                                                                <?php
                                                                $rating = $menu_today->rating; // Get the rating value from your data
                                                                if ($rating < 0) {
                                                                    $rating = 0;
                                                                } elseif ($rating > 5) {
                                                                    $rating = 5;
                                                                }

                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    $class = ($i <= $rating) ? 'zmdi zmdi-star' : 'zmdi zmdi-star-outline';

                                                                    $color = ($i <= $rating) ? 'orange' : 'gray';
                                                                    echo '<i class="' . $class . '" style="color: ' . $color . ';"></i>';
                                                                }
                                                                ?>
                                                            </div>
                                                            <div class="row">
                                                                <p class="card-text">Saran : <?= $menu_today->saran; ?></p>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal beri penilaian -->
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
                                            <div class="rating" name="rating">
                                                <span class="star" data-rating="1">&#9733;</span>
                                                <span class="star" data-rating="2">&#9733;</span>
                                                <span class="star" data-rating="3">&#9733;</span>
                                                <span class="star" data-rating="4">&#9733;</span>
                                                <span class="star" data-rating="5">&#9733;</span>
                                            </div>
                                            <!-- <p id="ratingValue" name="rating">Rating: 0</p> -->
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
                    <!-- modal edit penilaian -->
                    <div class="modal fade" id="ModalEditPenilaian" data-backdrop="false" role="dialog">
                        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h7 class="modal-title text-center p-2" id="exampleModalLongTitle">Edit Rating dan Saran Anda!</h7>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="error-area"></div>
                                    <?= form_open(base_url('penilaian_update'), ['class' => 'update-form']); ?>
                                    <input type="hidden" name="_method" value="PUT" />
                                    <input type="hidden" name="e_id_menu" id="id_menu">
                                    <div class="row clearfix">
                                        <div class="col-md-12 text-center">
                                            <div class="rating" name="rating">
                                                <span class="star" data-rating="1">&#9733;</span>
                                                <span class="star" data-rating="2">&#9733;</span>
                                                <span class="star" data-rating="3">&#9733;</span>
                                                <span class="star" data-rating="4">&#9733;</span>
                                                <span class="star" data-rating="5">&#9733;</span>
                                            </div>
                                            <!-- <p id="ratingValue" name="e_rating">Rating: 0</p> -->
                                        </div>
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Saran & Komentar</label>
                                                <textarea class="form-control" id="e_saran" name="e_saran" rows="3"></textarea>
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
                </div>
            </div>
</section>
<script>
    var ratingValue = 0;
    $(document).ready(function() {
        $('.star').click(function() {
            const rating = $(this).data('rating');

            // $('#ratingValue').text('Rating: ' + rating);
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
        $('.btn-edit-rating').on('click', function() {
            const rating = $(this).data('rating');
            $.getJSON("<?= base_url('penilaian_edit/'); ?>/" + $(this).data('id'), function(d) {
                if (d['status'] === true) {
                    $('input[name=e_id_menu]').val(d['data'].id_menu);
                    // $('p[name="e_rating"]').text('Rating: ' + d['data'].rating);
                    if (d['data'].rating > 0) {
                        $('.star').removeClass('active');

                        for (var i = 1; i <= d['data'].rating; i++) {
                            $('.star[data-rating="' + i + '"]').addClass('active');
                        }
                    } else if (d['data'].rating = 0) {
                        $('.star').removeClass('active');
                    }
                    $('textarea[name=e_saran]').val(d['data'].saran);
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
    });
</script>