<?php

namespace webapp_php_sample_class;

use DOMDocument;

class DatatypeConverter
{
	/**
	 * @param $xml
	 * @return bool|string
	 */
	public static function xml2json($xml): bool|string
	{
        return json_encode(simplexml_load_string($xml));
    }

	/**
	 * @param $json
	 * @return bool|string
	 */
	public static function json2xml($json): bool|string
	{
        $a = json_decode($json);
        $d = new DOMDocument();
        $c = $d->createElement("root");
        $d->appendChild($c);
        $t = function ($v) {
            $type = gettype($v);
			return match ($type) {
				'integer', 'double' => 'number',
				default => strtolower($type),
			};
        };
        $f = function ($f, $c, $a, $s = false) use ($t, $d) {
            $c->setAttribute('type', $t($a));
            if ($t($a) != 'array' && $t($a) != 'object') {
                if ($t($a) == 'boolean') {
                    $c->appendChild($d->createTextNode($a ? 'true' : 'false'));
                } else {
                    $c->appendChild($d->createTextNode($a));
                }
            } else {
                foreach ($a as $k => $v) {
                    if ($k == '__type' && $t($a) == 'object') {
                        $c->setAttribute('__type', $v);
                    } else {
                        if ($t($v) == 'object') {
                            $ch = $c->appendChild($d->createElementNS(null, $s ? 'item' : $k));
                            $f($f, $ch, $v);
                        } else if ($t($v) == 'array') {
                            $ch = $c->appendChild($d->createElementNS(null, $s ? 'item' : $k));
                            $f($f, $ch, $v, true);
                        } else {
                            $va = $d->createElementNS(null, $s ? 'item' : $k);
                            if ($t($v) == 'boolean') {
                                $va->appendChild($d->createTextNode($v ? 'true' : 'false'));
                            } else {
                                $va->appendChild($d->createTextNode($v));
                            }
                            $ch = $c->appendChild($va);
                            $ch->setAttribute('type', $t($v));
                        }
                    }
                }
            }
        };
        $f($f, $c, $a, $t($a) == 'array');
        return $d->saveXML($d->documentElement);
    }


}
