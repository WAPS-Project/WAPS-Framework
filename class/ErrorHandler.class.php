<?php


class ErrorHandler
{

    const FOOTER = '<span>For help ask at <a href="https://gitlab.com/JosunLP/webapp_php_sample">https://gitlab.com/JosunLP/webapp_php_sample</a></span>';

    function CreateError($type, $message)
    {
        echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
    }
}