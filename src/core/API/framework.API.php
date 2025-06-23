<?php

use webapp_php_sample_class\ErrorHandler;
use webapp_php_sample_class\JsonHandler;

try {
	JsonHandler::FireSimpleJson("framework_info", FRAMEWORK_INFO);
} catch (JsonException $e) {
	ErrorHandler::FireJsonError($e->getCode(), $e->getMessage());
}
