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
        <title><?= $lang_newlogin_title ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="/resources/libs/jquery.js"></script>
        <script>callback="<?= $return ?>";</script>
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
					<?= $lang_newlogin_doctitle ?>
                </h2>
                <div class="nd_Login_error" style="display: none;" id="login_error_1"><?= $lang_login_error1 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_2"><?= $lang_login_error2 ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_3"><?= $lang_polymer_autherr ?></div>
                <div class="nd_Login_error" style="display: none;" id="login_error_4"><?= $lang_polymer_lerr4 ?></div>
				<div>
					<h3>
                    <?= $lang_newlogin_tagline ?>
					</h3>
					<form name="login_form" action="javascript:submitForm();">
						<div class="nd_Field nd_Field_input">
							<input id="nd_Field_2" name="username" id="lguser" type="text" autofocus placeholder="<?= $lang_newlogin_username ?>" />
							<label for="nd_Field_2">
                                <?= $lang_newlogin_username ?>
							</label>
						</div>
						<div class="nd_Field nd_Field_input">
							<input id="nd_Field_3" name="password" id="lgpass" type="password"  placeholder="<?= $lang_newlogin_password ?>" />
							<label for="nd_Field_3">
                                <?= $lang_newlogin_password ?>
							</label>
						</div>
						<?= $lang_newlogin_forgot ?>
						<a href="/reset"><div class="nd_AccessibleButton nd_Login_forgot nd_AccessibleButton_hasKind nd_AccessibleButton_kind_link" tabindex="0" role="button">
                            <?= $lang_newlogin_forgot2 ?>
						</div></a>
						<input class="nd_Login_submit" name="submit" type="submit" id="lgsend" value="<?= $lang_newlogin_submit ?>" />
					</form>
				</div>
				<a class="nd_AuthBody_changeFlow" href="/signup">
                    <?= $lang_newlogin_switch ?>
				</a>
			</div>
		</div>
    </div>
    <div class="nd_AuthFooter"><a href="https://minteck-projects.alwaysdata.net/status" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_stat ?></a><a href="https://gitlab.com/minteck-projects" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_bugs ?></a><a href="https://mpbugger.alwaysdata.net" target="_blank" rel="noreferrer noopener">github</a><a href="https://minteck-projects.alwaysdata.net" target="_blank" rel="noreferrer noopener"><?= $lang_welcome_btn_mprj ?></a></div>
</div></div>

    </body>
    <script src="index.js"></script>
</html>