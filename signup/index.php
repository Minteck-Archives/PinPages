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
        <title><?= $lang_newsignup_title ?></title>
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
				<h2>
					<?= $lang_newsignup_doctitle ?>
                </h2>
                <div class="nd_Login_error" style="display: none;" id="login_error_1"><?= $lang_signup_error1 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_2"><?= $lang_signup_error2 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_3"><?= $lang_signup_error3 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_4"><?= $lang_signup_error4 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_5"><?= $lang_signup_error5 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_6"><?= $lang_signup_error6 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_7"><?= $lang_signup_error7 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_8"><?= $lang_signup_error8 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_9"><?= $lang_signup_error9 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_10"><?= $lang_signup_error10 ?></div>
				<div>
					<h3>
                    <?php include_once $_SERVER['DOCUMENT_ROOT'] . "/library/rounder_functions.php";$count = 0;$dirs = scandir($_SERVER['DOCUMENT_ROOT'] . "/data");foreach ($dirs as $dir) {$count = $count + 1;} ?>
                    <?= $lang_newsignup_terms1 ?> <a href="https://minteck-projects.alwaysdata.net/terms"><?= $lang_newsignup_terms2 ?></a> <?= $lang_newsignup_terms3 ?> <a href="https://minteck-projects.alwaysdata.net/privacy"><?= $lang_newsignup_terms4 ?></a> <?= $lang_newsignup_terms5 ?>
					</h3>
					<form name="login_form" action="javascript:submitForm();">
						<div class="nd_Field nd_Field_input">
							<input id="nd_Field_2" name="username" id="lguser" type="text" autofocus placeholder="<?= $lang_newsignup_username ?>" />
							<label for="nd_Field_2">
                                <?= $lang_newsignup_username ?>
							</label>
						</div>
                        <div class="nd_Field nd_Field_input">
							<input id="nd_Field_3" name="password" id="lgpass" type="password"  placeholder="<?= $lang_newsignup_password ?>" />
							<label for="nd_Field_3">
                                <?= $lang_newsignup_password ?>
							</label>
						</div>
						<div class="nd_Field nd_Field_input">
							<input id="nd_Field_4" name="passwordrepeat" id="lgprep" type="password"  placeholder="<?= $lang_newsignup_passwordr ?>" />
							<label for="nd_Field_4">
                                <?= $lang_newsignup_passwordr ?>
							</label>
                        </div>
                        <div class="nd_Field nd_Field_input">
							<input id="nd_Field_5" name="nickname" id="lgnick" type="text"  placeholder="<?= $lang_newsignup_nickname ?>" />
							<label for="nd_Field_4">
                                <?= $lang_newsignup_nickname ?>
							</label>
						</div>
                        <?= $lang_newsignup_nickwarn ?>
						<input class="nd_Login_submit" name="submit" type="submit" id="lgsend" value="<?= str_replace("#", rounder_approximate($count, $lang_newsignup_numbsep), $lang_newsignup_submit) ?>" />
					</form>
				</div>
				<a class="nd_AuthBody_changeFlow" href="/login">
                    <?= $lang_newsignup_switch ?>
				</a>
			</div>
		</div>
    </div>
    <div class="nd_AuthFooter"><a href="https://minteck-projects.alwaysdata.net/status" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_stat ?></a><a href="https://gitlab.com/minteck-projects" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_bugs ?></a><a href="https://mpbugger.alwaysdata.net" target="_blank" rel="noreferrer noopener">github</a><a href="https://minteck-projects.alwaysdata.net" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_mprj ?></a></div>
</div></div>

    </body>
    <script src="index.js"></script>
</html>