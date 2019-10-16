<?php


class ErrorHandler
{

    const FOOTER = '<span>For help ask at <a href="https://gitlab.com/JosunLP/webapp_php_sample">https://gitlab.com/JosunLP/webapp_php_sample</a></span>';

    function FireError($type, $message)
    {
        echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
    }

    function FireWarning($type, $message)
    {
        echo "<script>Swal.fire({type: 'warning', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";
    }

    function CreateError($type, $message, $weight, $isFatal)
    {
        if ($weight >= 3 && $isFatal) {
            throw new Exception("<script>Swal.fire({type: 'error', title: '$type', text: '$message . This is a fatal Error!', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>");
        } elseif ($weight <= 3 && !$isFatal) {
            echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
        }
    }
}