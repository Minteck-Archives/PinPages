<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_pm3del_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body class="dbody">
        <script src="index.js"></script>
        <script src="/resources/libs/jquery.js"></script>
        <script>var langprop = "<?= $langprop ?>";</script>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/headerWhenLoggedOut.php"; ?>
        <div class="header_escape">
            <?php

            if (isset($_GET['token'])) {
                $parts = explode("_",$_GET['token']);
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0])) {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/delete")) {
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/delete/" . $_GET['token'])) {
                            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/delete/" . $_GET['token']) != date("dmYH")) {
                                echo("<center><h1>" . $lang_polymer_reset18 . "</h1>" . $lang_pm3del_expire . "</center>");    
                                exit;
                            }
                        } else {
                            echo("<center><h1>" . $lang_polymer_reset18 . "</h1>" . $lang_pm3del_expire . "</center>");    
                            exit;
                        }
                    } else {
                        echo("<center><h1>" . $lang_polymer_reset18 . "</h1>" . $lang_pm3del_expire . "</center>");    
                        exit;
                    }
                } else {
                    echo("<center><h1>" . $lang_polymer_reset16 . "</h1>" . $lang_polymer_reset17 . "</center>");    
                    exit;
                }
            }
            else
            {
                echo("<center><h1>" . $lang_polymer_reset14 . "</h1>" . $lang_polymer_reset15 . "</center>");
                exit;
            }

            ?>
            <center><span class="logintitle"><?= $lang_pm3del_header ?></span>
            <script>var token = "<?= $_GET['token'] ?>";</script>
            <br><br>
            <span id="progress"><?= $lang_pm3del_message ?></span>
            <span id="error" class="hide"><?= $lang_pm3del_error ?></span>
            <span id="success" class="hide"><?= $lang_pm3del_success ?></span>
            </center>
        </div>
        <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/addons/footer.php"; ?>
    </body>
</html>