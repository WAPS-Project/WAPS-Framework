<?php

namespace Waps\Framework\Support;

use JsonException;
use Waps\Framework\Core\ErrorHandler;

class JsonHandler
{
	/**
	 * @param $key
	 * @param $value
	 * @throws JsonException
	 */
	public static function FireSimpleJson($key, $value): void
	{
		$array = [[$key => $value]];
		try {
			$json = self::BuildJson($array);
			echo $json;
		} catch (JsonException $e) {
			ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
		}
	}

	/**
	 * @param $objectArray
	 * @return bool|string
	 * @throws JsonException
	 */
	public static function BuildJson($objectArray): bool|string
	{
		$arrayMaster = [];
		foreach ($objectArray as $value) {
			$arrayMaster[] = $value;
		}
		return json_encode($arrayMaster, JSON_THROW_ON_ERROR, 512);
	}

	public static function FireJson(string $title, string $message, array $data = []): void
	{
		header('Content-Type: application/json');
		echo json_encode([
			'title' => $title,
			'message' => $message,
			'data' => $data,
			'status' => 'success'
		]);
	}
}
