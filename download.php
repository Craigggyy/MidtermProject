<?php

if(isset($_GET['file']))
{
    $filename =
    $_GET['file'];

    if(file_exists($filename))
    {
        header(
        "Content-Type: application/octet-stream");

        header(
        "Content-Disposition: attachment; filename="
        .
        basename($filename));

        header(
        "Content-Length: "
        .
        filesize($filename));

        readfile($filename);

        exit();
    }
    else
    {
        die(
        "File Not Found");
    }
}

?>