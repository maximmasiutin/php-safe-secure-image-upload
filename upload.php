<?php

/*

PHP safe/secure image upload code snippet
Copyright 2021 Maxim Masiutin
maxim@masiutin.com

This code saves an uploaded file under the original file name,
as provided by the uploader. It does not use a hash as a
destination filename or similar technique but preserves the
file name instead.

If you manage to find vulnerabilities or weaknesses in this code,
please send me a note. This code is just an example that
illustrates the issues that may arise during PHP file upload.
The code serves educational purposes and is not intended for
direct use.

This program is free software; you can redistribute it and/or
modify it under the terms of version 3 of the GNU Lesser General
Public License (LGPL) as published by the Free Software Foundation.

*/

declare(strict_types=1);
error_reporting(E_STRICT);

// Store file contents isolated from other application parts (e.g. different host or outside web root).
$target_dir = '/mnt/c/upload/';
$htmlfield = 'UploadFile';
$whitelist_extensions = ['gif', 'png', 'jpg'];
$whitelist_content_types = ['image/gif', 'image/png', 'image/jpeg'];
$max_file_size = 500000;
$min_file_size = 50;
$max_filename_length = 63;
$min_filename_length = 3; // including extension

if (isset($_POST['submit'])) {

    if (file_exists($target_dir) !== true) {
        die('Sorry, no uploads are allowed today');
    }

    if (!isset($_FILES) || !array_key_exists($htmlfield, $_FILES) || !array_key_exists('name', $_FILES[$htmlfield]))
    die('Please spefify a file name to upload');
    $uname = $_FILES[$htmlfield]['name'];

    if (strlen($uname) > $max_filename_length) {
        die('Sorry, the file name is too long.');
    }

    if (strlen($uname) < $min_filename_length) {
        die('Sorry, the file name is too short.');
    }

    $tmpname = $_FILES[$htmlfield]['tmp_name'];
    if (is_uploaded_file($tmpname) !== true) {
      die('Sorry, the file is not the uploaded one!');
    }

    // Normalize the Unicode. Use 'sudo apt install php-intl' if the following function is not found in PHP
    $unamen = Normalizer::normalize($uname);

    $lc = strtolower($unamen);

    // Extension validation via whitelist depending on business-critical requirements.
    $extlc = pathinfo($lc, PATHINFO_EXTENSION);
    if (in_array($extlc, $whitelist_extensions, true) !== true) {
        die("Sorry, the file extension '".htmlspecialchars($extlc)."' is not allowed");
    }

    if ((in_array(mime_content_type($tmpname), $whitelist_content_types, true) !== true) ||
        (in_array($_FILES[$htmlfield]["type"], $whitelist_content_types, true) !== true)) {
        die('Sorry, this content type is not allowed.');
    }

    // basename() may prevent filesystem traversal attacks
    $target_file = $target_dir.basename($uname);

    // further check for directory traversal
    $target_rp = realpath(pathinfo($target_file, PATHINFO_DIRNAME));
    $targetdir_rp = realpath($target_dir);
    if ($target_rp === false || strpos($target_rp, $targetdir_rp) !== 0) {
        die('Sorry, directory traversals are not allowed');
    }

    if (file_exists($target_file) !== false) {
        die('Sorry, file already exists.');
    }

    $filesize = $_FILES[$htmlfield]['size'];

    if ($filesize > $max_file_size) {
        die('Sorry, your file is too large.');
    }

    if ($filesize < $min_file_size) {
        die('Sorry, your file is too small.');
    }

// todo #1: use finfo_file -- finfo::file to geturn information about the file
// todo #2: use getimagesize

    if (move_uploaded_file($tmpname, $target_file)!==true) {
        die('Sorry, there was an error uploading your file.');
    }

    echo '<html><body>';
    echo 'The file '. htmlspecialchars($uname). ' has been uploaded.';
    echo '</body></html>';
}
