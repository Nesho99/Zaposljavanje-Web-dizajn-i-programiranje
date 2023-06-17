<?php
function pretvoriUsqlTimestamp($timestamp) {
    $sqlTimestamp = date('Y-m-d H:i:s', $timestamp);
    return $sqlTimestamp;
}
?>