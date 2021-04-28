<?php

if (!isset($_GET['u'])) {
    $_GET['u'] = "/home";
}

require $_SERVER['DOCUMENT_ROOT'] . "/library/qr/qrlib.php";
QRcode::png("http://" . $_SERVER["HTTP_HOST"] . "/app/#" . $_GET['u'], false, QR_ECLEVEL_L, 8);