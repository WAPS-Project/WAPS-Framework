<?php

namespace webapp_php_sample_class;

class ErrorHandler
{

    private const FOOTER = '<span>For help ask at <a href="https://gitlab.com/JosunLP/webapp_php_sample">https://gitlab.com/JosunLP/webapp_php_sample</a></span>';

    public static function FireError($type, $message): void
    {
        self::CreateLog($type, $message);
        echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
    }

    protected static function CreateLog($key, $message): void
    {
        $logPath = './custom/log/crashlog/';
        $files = array_diff(scandir($logPath), DEFAULT_FILE_FILTER);
        $currentDate = date('Y_m_d');
        $newLine = self::WriteLogLine($key, $message);
        if (!in_array($currentDate . '.txt', $files, true)) {
            $file = fopen($logPath . $currentDate . '.txt', 'wb') or die('Unable to create log file!');
            fclose($file);
        }
        foreach ($files as $file) {
            if ($file === $currentDate) {
                $logFile = fopen($currentDate . '.txt', 'ab') or die('Unable to open log file!');
                fwrite($logFile, $newLine);
                fclose($logFile);
            }
        }
    }

    private static function WriteLogLine($key, $message): string
    {
        $clientIp = Main::checkPost('ip');
        $ip = Main::getRealIp();
        $currentDate = date('Y.m.d_H:i:s');
        return '[' . $currentDate . ']:  (' . $clientIp . '/' . $ip . ') - Error Key: ' . $key . ' | Error Message: ' . $message . ' ;';
    }

    public static function FireWarning($type, $message): void
    {
        self::CreateLog($type, $message);
        echo "<script>Swal.fire({type: 'warning', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";
    }

    public static function CreateError($type, $message, $weight, $isFatal): void
    {
        if ($weight >= 3 && $isFatal) {
            self::CreateLog($type, $message);
            throw new \RuntimeException("<script>Swal.fire({type: 'error', title: '$type', text: '$message . This is a fatal Error!', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>");
        }

        if ($weight <= 3 && !$isFatal) {
            self::CreateLog($type, $message);
            echo "<script>Swal.fire({type: 'error', title: '$type', text: '$message', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
        }
    }

    public static function FireJsonError($type, $message): void
    {
        JsonHandler::FireSimpleJson($type, $message);
        self::CreateLog($type, $message);
    }

    public static function FireCLIError($type, $message): void
    {
        echo '[' . date('YmdHis') . '|' . $type . ']' . '{' . $message . '}';
        self::CreateLog($type, $message);
    }
}