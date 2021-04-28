<?php

function normalize ($string) {
    $table = array(
        'Š'=>'S', 'š'=>'s', 'Ð'=>'D', 'Ž'=>'Z', 'ž'=>'z', 'C'=>'C', 'c'=>'c', 'C'=>'C', 'c'=>'c',
        'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
        'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
        'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
        'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
        'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
        'ÿ'=>'y', 'R'=>'R', 'r'=>'r',
    );
   
    return strtr($string, $table);
}

$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root . "/library/token_util.php";
include_once $root . "/library/crypt_util.php";
include_once $_SERVER['DOCUMENT_ROOT'] . "/resources/i18n/postLanguageHandler.php";

$_POST['username'] = trim($_POST['username']);

if (isset($_POST['username']))
{
}
else
{
    echo("Undefined Variable: 'username'");
    exit;
}

if (isset($_POST['realname']))
{
    if (strpos($_POST['realname'], '"') !== false || strpos($_POST['realname'], '#') !== false || strpos($_POST['realname'], '@') !== false || strpos($_POST['realname'], '{') !== false || strpos($_POST['realname'], '}') !== false || strpos($_POST['realname'], '..') !== false || strpos($_POST['realname'], '¤') !== false || strpos($_POST['realname'], '`') !== false || strpos($_POST['realname'], ' ') !== false)
    {
        echo("Error 9");
        exit;
    } else {
        include_once $_SERVER['DOCUMENT_ROOT'] . "/library/auto_moderate.php";
        $_POST['realname'] = autoModerate($_POST['realname']);
    }
}
else
{
    echo("Undefined Variable: 'realname'");
    exit;
}

if ($_POST['username'] == ".htaccess" || $_POST['username'] == "root" || $_POST['username'] == ".." || $_POST['username'] == "." || $_POST['username'] == "library" || $_POST['username'] == "api" || $_POST['username'] == "system" || $_POST['username'] == "pinpages" || $_POST['username'] == "PinPages" || $_POST['username'] == "none" || $_POST['username'] == "null" || $_POST['username'] == "&pinpages-hashtag;" || $_POST['username'] == "&pp-lt;" || $_POST['username'] == "&pp-gt;" || $_POST['username'] == "undefined" || $_POST['username'] == "logout-user" || $_POST['username'] == "user" || strpos($_POST['username'], '\'') !== false || strpos($_POST['username'], '"') !== false || strpos($_POST['username'], '|') !== false || strpos($_POST['username'], ' ') !== false) {
    echo("Error 8");
    exit;
}

if (isset($_POST['password']))
{
}
else
{
    echo("Undefined Variable: 'password'");
    exit;
}

if (isset($_POST['passconf']))
{
}
else
{
    echo("Undefined Variable: 'passconf'");
    exit;
}

if ($_POST['password'] != $_POST['passconf']) {
    die("Error 5");
}

$slug = normalize($_POST['username']);
$slug = preg_replace("/[^0-9a-zA-Z ]/m", "", $slug);
$slug = str_replace(" ", "-", $slug);
$slug = strtolower($slug);

if (file_exists($root . "/data/" . $_POST['username']) || file_exists($root . "/data/" . str_replace(" ", "_", $_POST['username'])) || file_exists($root . "/data/" . $slug))
{
    echo("Error 6");
    exit;
}

if ($_POST['username'] == "deleted" || $_POST['username'] == "mdeleted" || $_POST['username'] == "disabled") {
    echo("Error 8");
    exit;
}

if (strpos($_POST['username'], '"') !== false || strpos($_POST['username'], '#') !== false || strpos($_POST['username'], '..') !== false || strpos($_POST['username'], '@') !== false || strpos($_POST['username'], '{') !== false || strpos($_POST['username'], '&') !== false || strpos($_POST['username'], '?') !== false || strpos($_POST['username'], '}') !== false || strpos($_POST['username'], ':') !== false || strpos($_POST['username'], '/') !== false || strpos($_POST['username'], '\\') !== false || strpos($_POST['username'], '?') !== false || strpos($_POST['username'], '¤') !== false || strpos($_POST['username'], '%') !== false || strpos($_POST['username'], '`') !== false || strpos($_POST['username'], '_') !== false || strpos($_POST['username'], 'password') !== false || strpos($_POST['username'], 'username') !== false || strpos($_POST['username'], 'deleted') !== false || strpos($_POST['username'], 'mdeleted') !== false || strpos($_POST['username'], 'disabled') !== false)
{
    echo("Error 8");
    exit;
}
else
{
    $_POST['username'] = autoModerate($_POST['username']);
    if (strlen($_POST['password']) < 8)
    {
        echo("Error 7");
        exit;
    }
    else
    {
        mkdir($root . "/data/" . $_POST['username']);
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
        file_put_contents($root . "/data/" . $_POST['username'] . "/password",$hashed_password);
        file_put_contents($root . "/data/" . $_POST['username'] . "/realname",encrypt($_POST['realname']));
        mkdir($root . "/data/" . $_POST['username'] . "/notifications");
        file_put_contents($root . "/data/" . $_POST['username'] . "/notifications/unread","");
        file_put_contents($root . "/data/" . $_POST['username'] . "/notifications/read","");
        mkdir($root . "/data/" . $_POST['username'] . "/friends");
        file_put_contents($root . "/data/" . $_POST['username'] . "/friends/incoming","");
        file_put_contents($root . "/data/" . $_POST['username'] . "/friends/valided","");
        mkdir($root . "/data/" . $_POST['username'] . "/verification");
        file_put_contents($root . "/data/" . $_POST['username'] . "/verification/status","False");
        file_put_contents($root . "/data/" . $_POST['username'] . "/emaillang",$_POST['lang']);
        file_put_contents($root . "/data/" . $_POST['username'] . "/verification/since","");
        mkdir($root . "/data/" . $_POST['username'] . "/privacy");
        file_put_contents($root . "/data/" . $_POST['username'] . "/privacy/discovery","True");
        file_put_contents($root . "/data/" . $_POST['username'] . "/privacy/private","True");
        file_put_contents($root . "/data/" . $_POST['username'] . "/dark","False");
        file_put_contents($root . "/data/" . $_POST['username'] . "/views","0");
        file_put_contents($root . "/data/" . $_POST['username'] . "/cakes","0");
        mkdir($root . "/data/" . $_POST['username'] . "/page");
        file_put_contents($root . "/data/" . $_POST['username'] . "/page/count","0");
        file_put_contents($root . "/data/" . $_POST['username'] . "/page/views","");
        file_put_contents($root . "/data/" . $_POST['username'] . "/permissions","0");
        file_put_contents($root . "/data/" . $_POST['username'] . "/protected","0");
        tokenUtil_login($_POST['username'],$lang_log_login_title,$lang_log_login_desc,$lang_polymer2_unknownloc,$lang_polymer2_logindesc);
    }
}