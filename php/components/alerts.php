<?php
echo '<script type="text/javascript">
toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  }</script>';
function createSuccessAlert(string $text){
    echo '<script type="text/javascript">
    toastr.success("'. $text .'")</script>';
}
function createErrorAlert(string $text){
    echo '<script type="text/javascript">
    toastr.error("'. $text .'")
    </script>';
}
function createWarningAlert(string $text){
    echo '<script type="text/javascript">
    toastr.warning("'. $text .'")
    </script>';
}
?>