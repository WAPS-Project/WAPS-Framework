<?php

namespace webapp_php_sample_class;

class ErrorHandler
{

    const FOOTER = '<span>For help ask at <a href="https://gitlab.com/JosunLP/webapp_php_sample">https://gitlab.com/JosunLP/webapp_php_sample</a></span>';

    static function FireError($type, $message)
    {
        self::CreateLog($type, $message);
        echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
    }

    static function FireWarning($type, $message)
    {
        self::CreateLog($type, $message);
        echo "<script>Swal.fire({type: 'warning', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";
    }

    static function CreateError($type, $message, $weight, $isFatal)
    {
        if ($weight >= 3 && $isFatal) {
            self::CreateLog($type, $message);
            throw new Exception("<script>Swal.fire({type: 'error', title: '$type', text: '$message . This is a fatal Error!', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>");
        } elseif ($weight <= 3 && !$isFatal) {
            self::CreateLog($type, $message);
            echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
        }
    }

    static protected function CreateLog($key, $message)
    {
        $logPath = "./custom/log/crahslog/";
        $files = array_diff(scandir($logPath), array('.', '..'));
        $currentDate = date("Y_m_d");
        $newLine = self::WriteLogLine($key, $message);
        if (!in_array($currentDate . ".txt", $files)) {
            $file = fopen( $logPath . $currentDate . ".txt", "w") or die("Unable to create log file!");
            fclose($file);
        }
        foreach ($files as $file) {
            if ($file === $currentDate) {
                $logFile = fopen($currentDate . ".txt", "a") or die("Unable to open log file!");
                fwrite($logFile, $newLine);
                fclose($logFile);
            }
        }
    }

    static private function WriteLogLine($key, $message)
    {
        $clientIp = Main::checkPost("ip");
        $ip = Main::getRealIp();
        $currentDate = date("Y.m.d_H:i:s");
        return "[" . $currentDate . "]:  (" . $clientIp . "/" . $ip . ") - Error Key: " . $key . " | Error Message: " . $message . " ;";
    }
}