<?php

namespace Sentence;

use Sentence\Keyboard;

class Scrambler {

	public function scramble($sentence) {

		$sentence = $this->removePunctuation($sentence);

		$retval = '';
		$fragments = explode(' ', $sentence);

		foreach ($fragments as $fragment) {

			$screwUp = mt_rand(0, 100) < 15;
			$jennifiedFragment = $fragment;
			if ($screwUp) {
				$jennifiedFragment = $this->screwUpFragment($fragment);
			}
			$retval .= ' ' . $jennifiedFragment;
		}

		return $this->hitSpacebarOnCaffeine() . $retval;
	}

	protected function removePunctuation($sentence) {

		$retval = preg_replace("/[^A-Za-z0-9 ]/", '', $sentence);
		return $retval;	
	}

	public function hitSpacebarOnCaffeine() {

		$retval = ' ';
		if (mt_rand(0, 100) < 30) {
			$retval = str_pad('', mt_rand(1,8), ' ', STR_PAD_LEFT);
		}

		return $retval;
	}

	public function screwUpFragment($fragment) {

		$effect = mt_rand(1,4);
		$len = strlen($fragment);
		$retval = null;

		switch ($effect) {

			case 1:
				// swap 1st/2nd chars
				if ($len > 1) {
					$retval = $fragment[1] . $fragment[0] . substr($fragment, 2, $len - 2);
				}
				break;

			case 2:
				// swap first and last chars
				if ($len > 1) {
					$retval = $fragment[$len - 1] . substr($fragment, 1, $len - 1) . $fragment[0];
				}
				break;

			case 3:
				// make seemingly genuine keyboard mistakes
				$mistakes = mt_rand(0, 2);
				$chars = str_split($fragment);
				for ($i = 0; $i < $mistakes; $i++) {
					$pos = mt_rand(0, $len - 1);
					$likelyMistakes = Keyboard::getNeighbouringKeys($chars[$pos]);
					$mistake = $likelyMistakes[mt_rand(0, count($likelyMistakes) - 1)];
					$chars[$pos] = $mistake;
				}
				$retval = implode($chars);
				break;

			case 4:
				// repeat first or last character
				$padType = mt_rand(0, 1) ? STR_PAD_LEFT : STR_PAD_RIGHT;
				$padLength = mt_rand(1, 4);
				$retval = str_pad($fragment, $padLength, $fragment[$padType ? 0 : ($len - 1)], $padType);
				break;

			default:
				break;
		}

		return $retval;
	}
}
