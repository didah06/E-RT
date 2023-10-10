<!-- Jquery Core Js -->
<script src="<?= base_url(); ?>/public/assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="<?= base_url(); ?>/public/assets/bundles/vendorscripts.bundle.js"></script>
<!--Lib Scripts Plugin Js -->
<script src="https://cdn.datatables.net/v/bs4/dt-1.13.6/datatables.min.js"></script>

<script src="<?= base_url(); ?>/public/assets/plugins/dropzone/dropzone.js"></script> <!-- Dropzone Plugin Js -->
<script src="<?= base_url(); ?>/public/assets/bundles/mainscripts.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="<?= base_url(); ?>/public/assets/bundles/fullcalendarscripts.bundle.js"></script>
<!--/ calender javascripts -->

<!-- <script src="/public/assets/bundles/mainscripts.bundle.js"></script> -->
<script src="<?= base_url(); ?>/public/assets/js/pages/calendar/calendar.js"></script>

<script>
    $(document).ready(function() {
        var targetElement = $(".btn-group.bootstrap-select");
        $.each(targetElement, function(index) {
            var targetSelect = $(this).children('select');

            $(this).parent().append(targetSelect);

            $(this).remove();
            $('select').select2({
                width: '100%'
            });
        })
    })
</script>
<!-- <script>
    $('select').selectpicker();
</script> -->
</body>

</html>