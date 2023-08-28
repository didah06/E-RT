
function processStart() {
    $('body').removeClass('pace-done');
    $('body').addClass('pace-running');
    $('.pace').removeClass('pace-inactive');
    $('.pace').addClass('pace-active');
}

function processDone() {
    $('body').removeClass('pace-running');
    $('body').addClass('pace-done');
    $('.pace').removeClass('pace-active');
    $('.pace').addClass('pace-inactive');
}

function invalidError(d) {
    $('.alert').remove();
    $('input').removeClass('is-invalid');
    $('textarea').removeClass('is-invalid');
    // $('select').siblings('span').find('.select2-selection').attr('style', '');
    $('select').siblings('.invalid-feedback').css('display', 'none');
    $('select').siblings('.invalid-feedback').html('');
    $.each(d, function (key, value) {
        if (key == 'rscript') {
            $('input[name=' + key + ']').val(value);
        } else if (key == 'error') {
            $('.error-area').html(`<div class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show" role="alert"><i class="mdi mdi-block-helper label-icon"></i>` + value + `<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`);
        } else if (key == 'input') {
            $.each(value, function (k, v) {
                if (v != '') {
                    $('input[name="' + k + '"]').addClass('is-invalid');
                    $('input[name="' + k + '"]').siblings('.invalid-feedback').html(v);
                }
            });
        } else if (key == 'textarea') {
            $.each(value, function (k, v) {
                if (v != '') {
                    $('textarea[name="' + k + '"]').addClass('is-invalid');
                    $('textarea[name="' + k + '"]').siblings('.invalid-feedback').html(v);
                }
            });
        } else if (key == 'select') {
            $.each(value, function (k, v) {
                if (v != '') {
                    // $('select[name="' + k + '"]').siblings('span').find('.select2-selection').attr('style', 'border-color: #fd625e !important');
                    $('select[name="' + k + '"]').siblings('.invalid-feedback').css('display', 'unset');
                    $('select[name="' + k + '"]').siblings('.invalid-feedback').html(v);
                }
            });
        }
    });
}



