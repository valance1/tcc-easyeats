<?php
function createSuccessAlert(string $text){
    echo '<script type="text/javascript">toastr.success("'. $text .'")</script>';
}
function createErrorAlert(string $text){
    echo '<script type="text/javascript">toastr.error("'. $text .'")</script>';
}
function createWarningAlert(string $text){
    echo '<script type="text/javascript">toastr.warning("'. $text .'")</script>';
}
?>