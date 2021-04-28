<?php

function str_replace_first($from, $to, $content) {
    $from = '/' . preg_quote($from, '/') . '/';
    return preg_replace($from, $to, $content, 1);
}

function HTMLtoMD(string $text) {
    $first = $text;
    if (substr_count($text, "**") > 0) {
        $occurences = substr_count($text, "**") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("**","<b>",$first);
            $first = str_replace_first("**","</b>",$first);
        }
    }
    if (substr_count($text, "*") > 0) {
        $occurences = substr_count($first, "*") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("*","<i>",$first);
            $first = str_replace_first("*","</i>",$first);
        }
    }
    if (substr_count($text, "__") > 0) {
        $occurences = substr_count($first, "__") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("__","<u>",$first);
            $first = str_replace_first("__","</u>",$first);
        }
    }
    if (substr_count($text, "~~") > 0) {
        $occurences = substr_count($first, "~~") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("~~","<s>",$first);
            $first = str_replace_first("~~","</s>",$first);
        }
    }
    if (substr_count($text, "```") > 0) {
        $occurences = substr_count($first, "```") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("```","<center><code class=\"md-code-block\">",$first);
            $first = str_replace_first("```","</code></center>",$first);
        }
    }
    if (substr_count($text, "`") > 0) {
        $occurences = substr_count($first, "`") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("`","<code class=\"md-code-inline\">",$first);
            $first = str_replace_first("`","</code>",$first);
        }
    }
    return $first;
}

function HTMLtoMD_bio(string $text) {
    $first = $text;
    if (substr_count($text, "**") > 0) {
        $occurences = substr_count($text, "**") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("**","<b>",$first);
            $first = str_replace_first("**","</b>",$first);
        }
    }
    if (substr_count($text, "*") > 0) {
        $occurences = substr_count($first, "*") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("*","<i>",$first);
            $first = str_replace_first("*","</i>",$first);
        }
    }
    if (substr_count($text, "__") > 0) {
        $occurences = substr_count($first, "__") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("__","<u>",$first);
            $first = str_replace_first("__","</u>",$first);
        }
    }
    if (substr_count($text, "~~") > 0) {
        $occurences = substr_count($first, "~~") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("~~","<s>",$first);
            $first = str_replace_first("~~","</s>",$first);
        }
    }
    if (substr_count($text, "```") > 0) {
        $occurences = substr_count($first, "```") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("```","<center><code class=\"md-code-block\">",$first);
            $first = str_replace_first("```","</code></center>",$first);
        }
    }
    if (substr_count($text, "`") > 0) {
        $occurences = substr_count($first, "`") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("`","<code class=\"md-code-inline\">",$first);
            $first = str_replace_first("`","</code>",$first);
        }
    }

    $lines_new = [];
    $lines = explode("\n", $first);
    foreach ($lines as $line) {
        if (substr($line, 0, 4) == "<br>") {
            $linenew = substr($line, 4);
        } else {
            $linenew = $line;
        }
        if (substr($linenew, 0, (5 * 18) + 1) == "&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ") {
            $title = str_replace("&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ", "", $linenew);
            $titleparts = explode("<br>", $title);
            $title = "<h6>" . $titleparts[0] . "</h6>";
            array_shift($titleparts);
            array_push($lines_new, $title);
            array_push($lines_new, implode("<br>", $titleparts));
        } else {
            array_push($lines_new, $line);
        }
    }
    $lines_text = implode("\n", $lines_new);
    
    $lines_new = [];
    $lines = explode("\n", $lines_text);
    foreach ($lines as $line) {
        if (substr($line, 0, 4) == "<br>") {
            $linenew = substr($line, 4);
        } else {
            $linenew = $line;
        }
        if (substr($linenew, 0, (4 * 18) + 1) == "&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ") {
            $title = str_replace("&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ", "", $linenew);
            $titleparts = explode("<br>", $title);
            $title = "<h5>" . $titleparts[0] . "</h5>";
            array_shift($titleparts);
            array_push($lines_new, $title);
            array_push($lines_new, implode("<br>", $titleparts));
        } else {
            array_push($lines_new, $line);
        }
    }
    $lines_text = implode("\n", $lines_new);

    $lines_new = [];
    $lines = explode("\n", $lines_text);
    foreach ($lines as $line) {
        if (substr($line, 0, 4) == "<br>") {
            $linenew = substr($line, 4);
        } else {
            $linenew = $line;
        }
        if (substr($linenew, 0, (3 * 18) + 1) == "&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ") {
            $title = str_replace("&pinpages-hashtag;&pinpages-hashtag;&pinpages-hashtag; ", "", $linenew);
            $titleparts = explode("<br>", $title);
            $title = "<h4>" . $titleparts[0] . "</h4>";
            array_shift($titleparts);
            array_push($lines_new, $title);
            array_push($lines_new, implode("<br>", $titleparts));
        } else {
            array_push($lines_new, $line);
        }
    }
    $lines_text = implode("\n", $lines_new);

    $lines_new = [];
    $lines = explode("\n", $lines_text);
    foreach ($lines as $line) {
        if (substr($line, 0, 4) == "<br>") {
            $linenew = substr($line, 4);
        } else {
            $linenew = $line;
        }
        if (substr($linenew, 0, (2 * 18) + 1) == "&pinpages-hashtag;&pinpages-hashtag; ") {
            $title = str_replace("&pinpages-hashtag;&pinpages-hashtag; ", "", $linenew);
            $titleparts = explode("<br>", $title);
            $title = "<h3>" . $titleparts[0] . "</h3>";
            array_shift($titleparts);
            array_push($lines_new, $title);
            array_push($lines_new, implode("<br>", $titleparts));
        } else {
            array_push($lines_new, $line);
        }
    }
    $lines_text = implode("\n", $lines_new);

    $lines_new = [];
    $lines = explode("\n", $lines_text);
    foreach ($lines as $line) {
        if (substr($line, 0, 4) == "<br>") {
            $linenew = substr($line, 4);
        } else {
            $linenew = $line;
        }
        if (substr($linenew, 0, (1 * 18) + 1) == "&pinpages-hashtag; ") {
            $title = str_replace("&pinpages-hashtag; ", "", $linenew);
            $titleparts = explode("<br>", $title);
            $title = "<h2>" . $titleparts[0] . "</h2>";
            array_shift($titleparts);
            array_push($lines_new, $title);
            array_push($lines_new, implode("<br>", $titleparts));
        } else {
            array_push($lines_new, $line);
        }
    }
    $lines_text = implode("\n", $lines_new);

    $lines_text = str_replace("&pinpages-hashtag;", "#", $lines_text);

    $p2lines = explode("\n", $lines_text);

    return $lines_text;
}

function HTMLtoMD_extended(string $text) {
    $first = $text;
    if (substr_count($text, "**") > 0) {
        $occurences = substr_count($text, "**") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("**","<b>",$first);
            $first = str_replace_first("**","</b>",$first);
        }
    }
    if (substr_count($text, "*") > 0) {
        $occurences = substr_count($first, "*") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("*","<i>",$first);
            $first = str_replace_first("*","</i>",$first);
        }
    }
    if (substr_count($text, "__") > 0) {
        $occurences = substr_count($first, "__") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("__","<u>",$first);
            $first = str_replace_first("__","</u>",$first);
        }
    }
    if (substr_count($text, "~~") > 0) {
        $occurences = substr_count($first, "~~") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("~~","<s>",$first);
            $first = str_replace_first("~~","</s>",$first);
        }
    }
    if (substr_count($text, "`") > 0) {
        $occurences = substr_count($first, "`") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("`","<code class=\"md-code-inline\">",$first);
            $first = str_replace_first("`","</code>",$first);
        }
    }
    if (substr_count($text, "```") > 0) {
        $occurences = substr_count($first, "```") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("```","<code class=\"md-code-block\">",$first);
            $first = str_replace_first("```","</code>",$first);
        }
    }
    if (substr_count($text, "||") > 0) {
        $occurences = substr_count($first, "||") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("||","<a href=\"",$first);
            $first = str_replace_first("||","\">",$first);
        }
    }
    if (substr_count($text, "&&") > 0) {
        $occurences = substr_count($first, "&&") / 2;
        for ($i=0; $i < $occurences; $i++) { 
            $first = str_replace_first("&&","</a>",$first);
        }
    }
    return $first;
}