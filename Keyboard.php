<?php

namespace Sentence;

class Keyboard {

	static $chars = "qwertyuiopasdfghjkl;zxcvbnm";

	public static function getNeighbouringKeys($key) {

		$retval = array();

	   for ($i = 0; $i < strlen(self::$chars); $i++) {
		   $char = self::$chars[$i];
		   if ($char !== $key && self::distance($char, $key) < 2) {
			   $retval[] = $char;
		   }
	   }

	   return $retval;
	}

	public static function distance($c1, $c2) {

		$retval = sqrt(pow(self::colOf($c2) - self::colOf($c1), 2) + pow(self::rowOf($c2) - self::rowOf($c1), 2));
		return $retval;
	}

	public static function rowOf($c) {

	   return strpos(self::$chars, $c) / 10;
	}

	public static function colOf($c) {

	   return strpos(self::$chars, $c) % 10;
	}
}
