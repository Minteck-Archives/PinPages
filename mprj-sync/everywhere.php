<?php

// The following code will affect ALL MINTECK PROJECTS WEBSITES.

// Config loader
$config = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/mprj-sync/config.json"));

// To include this file on other pages, insert this line on a file that is loaded on each page:
// include_once $_SERVER['DOCUMENT_ROOT'] . "/mprj-sync/everywhere.php";
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-146084463-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', <?= $config['google-site-tag'] ?>);
</script>
