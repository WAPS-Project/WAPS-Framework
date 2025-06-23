<?php

namespace Waps\Framework\Controller;

use Error;
use JsonException;
use RuntimeException;
use Waps\\Framework\\Controller\JsonHandler;

/**
 * Class ErrorHandler
 * @package webapp_php_sample_class
 *
 * Verbesserte Fehlerbehandlung mit Schutz gegen XSS, verbesserte Protokollierung
 * und Vermeidung von Rekursionen
 */
class ErrorHandler
{
	/** Constant Footer
	 *  The Footer String that is used for each Sweet Alert Popup
	 */
	private const FOOTER = '<span>For help ask at <a href="https://gitlab.com/waps/framework">https://gitlab.com/waps/framework</a></span>';

	/**
	 * Pfad zu den Log-Dateien
	 */
	private const LOG_PATH = './custom/log/crashlog/';

	/**
	 * Flag zur Vermeidung rekursiver Fehlerbehandlung
	 */
	private static $isHandlingError = false;

	function __construct(string $mode)
	{
		switch ($mode) {
			case 'json':
				set_error_handler([__CLASS__, 'FireJsonError']);
				break;

			case 'basic':
				set_error_handler([__CLASS__, 'FireError']);
				break;

			case 'cli':
				set_error_handler([__CLASS__, 'FireCLIError']);
				break;

			default:
				set_error_handler([__CLASS__, 'FireError']);
				break;
		}
	}

	/**
	 * The message type
	 * @param $type
	 * The message content
	 * @param $message
	 */
	public static function FireError($type, $message): void
	{
		if (self::$isHandlingError) {
			// Vermeidet rekursive Fehlerbehandlung
			error_log("Rekursiver Fehler: $type - $message");
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen: {$e->getMessage()}");
		}

		$safeType = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
		$safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

		echo "<script>Swal.fire({type: 'error', title: '{$safeType}', text: '{$safeMessage}', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";

		self::$isHandlingError = false;
	}

	/**
	 * Erstellt eine Log-Eintrag
	 * @param $key Der Log-Schlüssel
	 * @param $message Die Log-Nachricht
	 */
	protected static function CreateLog($key, $message): void
	{
		$logPath = self::LOG_PATH;
		$files = array_diff(scandir($logPath), DEFAULT_FILE_FILTER);
		$currentDate = date('Y_m_d');
		$logFilename = $currentDate . '.log';
		$newLine = self::WriteLogLine($key, $message);

		// Erstelle die Log-Datei, wenn sie nicht existiert
		if (!in_array($logFilename, $files, true)) {
			try {
				$file = fopen($logPath . $logFilename, 'wb');
				if ($file === false) {
					error_log("Kann Log-Datei nicht erstellen: $logPath$logFilename");
					return;
				}
				fclose($file);
			} catch (\Exception $e) {
				error_log("Fehler beim Erstellen der Log-Datei: {$e->getMessage()}");
				return;
			}
		}

		// Schreibe in die Log-Datei
		try {
			$logFile = fopen($logPath . $logFilename, 'ab');
			if ($logFile === false) {
				error_log("Kann Log-Datei nicht öffnen: $logPath$logFilename");
				return;
			}
			fwrite($logFile, $newLine);
			fclose($logFile);
		} catch (\Exception $e) {
			error_log("Fehler beim Schreiben in Log-Datei: {$e->getMessage()}");
		}
	}

	/**
	 * Erstellt eine formatierte Log-Zeile
	 * @param $key Der Log-Schlüssel
	 * @param $message Die Log-Nachricht
	 * @return string Formatierte Log-Zeile
	 */
	private static function WriteLogLine($key, $message): string
	{
		try {
			$clientIp = Main::checkRequest('post', 'ip');
			$ip = Main::getRealIp();
		} catch (\Exception $e) {
			$clientIp = 'unknown';
			$ip = 'unknown';
		}

		$currentDate = date('Y.m.d_H:i:s');
		return '[' . $currentDate . ']:  (' . $clientIp . '/' . $ip . ') - Error Key: ' . $key . ' | Error Message: ' . $message . "\n";
	}

	/**
	 * Zeigt eine Warnung an
	 * @param $type Der Typ der Warnung
	 * @param $message Die Warnungsnachricht
	 */
	public static function FireWarning($type, $message): void
	{
		if (self::$isHandlingError) {
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen der Warnung: {$e->getMessage()}");
		}

		$safeType = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
		$safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

		echo "<script>Swal.fire({type: 'warning', title: '{$safeType}', text: '{$safeMessage}', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";

		self::$isHandlingError = false;
	}

	/**
	 * Zeigt eine Erfolgsmeldung an
	 * @param $type Der Typ der Meldung
	 * @param $message Die Erfolgsnachricht
	 */
	public static function FireSuccess($type, $message): void
	{
		if (self::$isHandlingError) {
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen der Erfolgsmeldung: {$e->getMessage()}");
		}

		$safeType = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
		$safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

		echo "<script>Swal.fire({type: 'success', title: '{$safeType}', text: '{$safeMessage}', showCloseButton: true, footer: '" . self::FOOTER . "', animation: true})</script>";

		self::$isHandlingError = false;
	}

	/**
	 * Erzeugt einen Fehler mit bestimmtem Schweregrad
	 * @param $type Der Fehlertyp
	 * @param $message Die Fehlernachricht
	 * @param $weight Der Schweregrad des Fehlers
	 * @param $isFatal Gibt an, ob der Fehler fatal ist
	 */
	public static function CreateError($type, $message, $weight, $isFatal): void
	{
		if (self::$isHandlingError) {
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen des Fehlers: {$e->getMessage()}");
		}

		$safeType = htmlspecialchars($type, ENT_QUOTES, 'UTF-8');
		$safeMessage = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

		self::$isHandlingError = false;

		if ($weight >= 3 && $isFatal) {
			throw new RuntimeException("<script>Swal.fire({type: 'error', title: '{$safeType}', text: '{$safeMessage} . This is a fatal Error!', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>");
		}

		if ($weight <= 3 && !$isFatal) {
			echo "<script>Swal.fire({type: 'error', title: '{$safeType}', text: '{$safeMessage}', showCloseButton: true, footer: '" . self::FOOTER . "'})</script>";
		}
	}

	/**
	 * Gibt einen JSON-Fehler zurück
	 * @param $type Der Fehlertyp
	 * @param $message Die Fehlernachricht
	 * @throws JsonException
	 */
	public static function FireJsonError($type, $message): void
	{
		if (self::$isHandlingError) {
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen des JSON-Fehlers: {$e->getMessage()}");
		}

		self::$isHandlingError = false;

		JsonHandler::FireSimpleJson($type, $message);
	}

	/**
	 * Gibt einen CLI-Fehler zurück
	 * @param $type Der Fehlertyp
	 * @param $message Die Fehlernachricht
	 */
	public static function FireCLIError($type, $message): void
	{
		if (self::$isHandlingError) {
			return;
		}

		self::$isHandlingError = true;

		try {
			self::CreateLog($type, $message);
		} catch (Error $e) {
			error_log("Fehler beim Loggen des CLI-Fehlers: {$e->getMessage()}");
		}

		self::$isHandlingError = false;

		echo '[' . date('YmdHis') . '|' . $type . ']{' . $message . '}' . PHP_EOL;
	}
}
