<?php

function encrypt($string) {
    // $key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
    // $nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
    // $ciphertext = sodium_crypto_secretbox($string, $nonce, $key);
    // $encoded = base64_encode($nonce . $ciphertext);
    // return $encoded;
    // $key_size = 32;
    // $encryption_key = openssl_random_pseudo_bytes($key_size, $strong);
    // $iv_size = 16;
    // $iv = openssl_random_pseudo_bytes($iv_size, $strong);
    $step1 = strrev($string);
    return $step1;
}

function decrypt($string) {
    // $decoded = base64_decode($string);
    // $nonce = mb_substr($decoded, 0, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, '8bit');
    // $ciphertext = mb_substr($decoded, SODIUM_CRYPTO_SECRETBOX_NONCEBYTES, null, '8bit');
    // $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
    // return $plaintext;
    $step1 = strrev($string);
    return $step1;
}