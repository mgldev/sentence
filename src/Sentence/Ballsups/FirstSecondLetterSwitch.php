<?php

use Sentence\Ballsup;

/**
 * Switch the first and last letter
 */
class FirstSecondLetterSwitch implements Ballsup {

	public function ballsup($fragment) {

		$retval = $fragment;
		$len = strlen($fragment);
		
		if ($len > 1) {
			$retval = $fragment[1] . $fragment[0] . substr($fragment, 2, $len - 2);
		}

		return $retval;
	}
}