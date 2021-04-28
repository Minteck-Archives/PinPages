<?php 

include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/languageHandler.php";

if (isset($_GET['return'])) {
    $_GET['return'] = urldecode($_GET['return']);
    $return = $_GET['return'];
    $returnsu = $_GET['return'];
} else {
    $return = "/app";
    $returnsu = "/tutorial";
}

if (isset($_COOKIE['token']))
{
    $user = strtok($_COOKIE['token'], '_');
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/tokens/" . $_COOKIE['token']))
    {
        header("Location: /app");
        exit;
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" href="/favicon.svg" />
        <link rel="stylesheet" href="/resources/style/global.css" />
        <title><?= $lang_newpassset_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/resources/libs/jquery.js"></script>
        <script>callback="<?= $returnsu ?>";</script>
    </head>
    <body class="nd_WelcomeBkg">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/private/everywhere.php"; ?>
    <div class="nd_AuthPage">
        <div class="nd_AuthPage_modal" style="position: relative; background: initial;">
	<div class="nd_AuthPage_modalBlur" style="position: absolute; inset: 0px; filter: blur(10px); background: rgba(0, 0, 0, 0) url('/resources/image/background.jpg') repeat fixed center center / cover;">
		&nbsp;
	</div>
	<div class="nd_AuthPage_modalContent" style="display: flex; z-index: 1; background: rgba(255, 255, 255, 0.59) none repeat scroll 0% 0%; border-radius: 4px;">
		<div class="nd_AuthPage_modalContent" style="display: flex; z-index: 1; background: rgba(255, 255, 255, 0.59) none repeat scroll 0% 0%; border-radius: 4px;">
			<div class="nd_AuthHeader">
				<div class="nd_AuthHeaderLogo">
					<img src="/resources/image/logo.svg" alt="PinPages" />
				</div>
				<div class="nd_Dropdown nd_AuthBody_language" onclick="location.href='/lang/?switch'"><div aria-haspopup="listbox" aria-expanded="false" aria-label="Language Dropdown" aria-describedby="nd_LanguageDropdown_value" role="button" tabindex="0" class="nd_AccessibleButton nd_Dropdown_input nd_no_textinput"><div class="nd_Dropdown_option" id="nd_LanguageDropdown_value"><div><?= $lang__name ?></div></div><span class="nd_Dropdown_arrow"></span></div></div>
			</div>
			<div class="nd_AuthBody">
            <?php

            if (isset($_GET['token'])) {
                $parts = explode("_",$_GET['token']);
                if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0])) {
                    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/reset")) {
                        if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/reset/" . $_GET['token'])) {
                            if (file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $parts[0] . "/reset/" . $_GET['token']) != date("dmYH")) {
                                echo("<h2>" . $lang_polymer_reset18 . "</h2><h3>" . $lang_polymer_reset19 . "</h3>");    
                                exit;
                            } else {
                                include_once $_SERVER['DOCUMENT_ROOT'] . "/setpass/cbox.php";
                            }
                        } else {
                            echo("<h2>" . $lang_polymer_reset18 . "</h2><h3>" . $lang_polymer_reset19 . "</h3>");    
                            exit;
                        }
                    } else {
                        echo("<h2>" . $lang_polymer_reset18 . "</h2><h3>" . $lang_polymer_reset19 . "</h3>");    
                        exit;
                    }
                } else {
                    echo("<h2>" . $lang_polymer_reset16 . "</h2><h3>" . $lang_polymer_reset17 . "</h3>");    
                    exit;
                }
            }
            else
            {
                echo("<h2>" . $lang_polymer_reset14 . "</h2><h3>" . $lang_polymer_reset15 . "</h3>");
                exit;
            }
            
            ?>
			</div>
		</div>
    </div>
    <div class="nd_AuthFooter"><a href="https://minteck-projects.alwaysdata.net/status" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_stat ?></a><a href="https://gitlab.com/minteck-projects" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_bugs ?></a><a href="https://mpbugger.alwaysdata.net" target="_blank" rel="noreferrer noopener">github</a><a href="https://minteck-projects.alwaysdata.net" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_mprj ?></a></div>
</div></div>

    </body>
    <script src="index.js"></script>
</html>