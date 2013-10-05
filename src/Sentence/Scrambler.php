<?php

namespace Sentence;

use Sentence\Keyboard;

class Scrambler {

	protected $keyboard = null;

	public function __construct(Keyboard $keyboard) {

		$this->setKeyboard($keyboard);
	}

	public function setKeyboard(Keyboard $keyboard) {

		$this->keyboard = $keyboard;
		return $this;
	}

	public function getKeyboard() {

		return $this->keyboard;
	}

	public function scramble($sentence) {

		$sentence = strtolower($this->removePunctuation($sentence));

		$retval = '';
		$fragments = explode(' ', $sentence);

		foreach ($fragments as $fragment) {

			$screwUp = mt_rand(0, 100) < 15;
			$screwedUpFragment = $fragment;
			if ($screwUp) {
				$screwedUpFragment = $this->screwUpFragment($fragment);
			}
			$retval .= ' ' . $screwedUpFragment;
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

		$effect = mt_rand(1,3);
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
				// make seemingly genuine keyboard mistakes
				$mistakes = mt_rand(0, 2);
				$chars = str_split($fragment);
				for ($i = 0; $i < $mistakes; $i++) {
					$pos = mt_rand(0, $len - 1);
					$likelyMistakes = $this->getKeyboard()->getNeighbouringKeys($chars[$pos]);
					$mistake = $likelyMistakes[mt_rand(0, count($likelyMistakes) - 1)];
					$chars[$pos] = $mistake;
				}
				$retval = implode($chars);
				break;

			case 3:
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
