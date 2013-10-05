<?php

namespace Sentence;

class Keyboard {

	protected $chars = "qwertyuiopasdfghjkl;zxcvbnm";

	public function getNeighbouringKeys($key) {

		$retval = array();

	   for ($i = 0; $i < strlen($this->chars); $i++) {
		   $char = $this->chars[$i];
		   if ($char !== $key && $this->distance($char, $key) < 2) {
			   $retval[] = $char;
		   }
	   }

	   return $retval;
	}

	public function distance($c1, $c2) {

		$retval = sqrt(pow($this->colOf($c2) - $this->colOf($c1), 2) + pow($this->rowOf($c2) - $this->rowOf($c1), 2));
		return $retval;
	}

	public function rowOf($c) {

	   return strpos($this->chars, $c) / 10;
	}

	public function colOf($c) {

	   return strpos($this->chars, $c) % 10;
	}
}
