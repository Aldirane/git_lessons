<?php

$key = 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=';

define('mykey', 'bRuD5WYw5wd0rdHR9yLlM6wt2vteuiniQBqE70nAuhU=');


function my_encrypt($data) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode(mykey);
    // Generate an initialization vector
    $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    // Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
    $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
    // The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
    return base64_encode($encrypted . '::' . base64_encode($iv));
}

function my_decrypt($data) {
    // Remove the base64 encoding from our key
    $encryption_key = base64_decode(mykey);
    // To decrypt, split the encrypted data from our IV - our unique separator used was "::"
    if (strpos(base64_decode($data), '::')) {
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, base64_decode($iv));
    }
}   return false;



function execute_script($mode) {
    if ($mode) {
        require_once($mode.'.php');
    }
}


function get_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

function sql_func($link, $sql_line, $nameErr) {
    if ($link->query($sql_line)) {
        echo 'Successfuly executed ' . $sql_line . "<br/>";
    } else {
        $mysql_err = mysqli_error($link);
        require 'init.html';
        exit;
    }
}  


?>