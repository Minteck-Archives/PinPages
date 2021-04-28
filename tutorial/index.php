<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_polymer_tutorial1 ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body class="tbody">
        <div class="tutorial_body">
            <script src="index.js"></script>
            <script src="/resources/libs/jquery.js"></script>
            <script>var langprop = "<?= $langprop ?>";var currentPage = 1;</script>
            <div class="tutorial_header">
                <center>
                    <?php
                        if (isset($_GET['source'])) {
                            if ($_GET['source'] == "settings") {
                                echo("<a onclick=\"preventStep(true)\" class=\"tutorial_prevent\"></a>");
                            } else {
                                echo("<a onclick=\"preventStep(false)\" class=\"tutorial_prevent\"></a>");
                            }
                        }
                    ?>
                    <a onclick="nextStep()" class="tutorial_next"></a>
                    <span id="tutorial_desc_1"><?= $lang_polymer_tutorial2 ?></span>
                    <span id="tutorial_desc_2" class="hide"><?= $lang_polymer_tutorial5 ?></span>
                    <span id="tutorial_desc_3" class="hide"><?= $lang_polymer_tutorial8 ?></span>
                    <span id="tutorial_desc_4" class="hide"><?= $lang_polymer_tutorial12 ?></span>
                    <span> </span>
                </center>
            </div>
            <div class="tutorial_panel" id="tutorial_panel_1">
                <center><h1><?= $lang_polymer_tutorial3 ?></h1></center>
                <?= $lang_polymer_tutorial4 ?>
            </div>
            <div class="tutorial_panel hide" id="tutorial_panel_2">
                <center><h1><?= $lang_polymer_tutorial6 ?></h1></center>
                <?= $lang_polymer_tutorial7 ?>
            </div>
            <div class="tutorial_panel hide" id="tutorial_panel_3">
                <center><h1><?= $lang_polymer_tutorial9 ?></h1>
                <img src="/resources/image/account.svg" style="filter: hue-rotate(58.1deg);" width="256px" height="256px"></center>
                <?= $lang_polymer_tutorial10 ?>
            </div>
            <div class="tutorial_panel hide" id="tutorial_panel_4">
                <center><h3><?= $lang_polymer_tutorial11 ?></h3>
            </div>
        </div>
    </body>
</html>