<?php

namespace Sentence\Ballsup;

use Sentence\Ballsup;

class RepeatFirstOrLastLetter implements Ballsup
{

	protected $options;
	
	public function ballsup($fragment)
	{
		if(isset($options['maxrepeat'])) {
			$maxRepeat = $options['maxrepeat'];	
		} else {
			$maxRepeat = 8;
		}


        $padType = mt_rand(0, 1) ? STR_PAD_LEFT : STR_PAD_RIGHT;
        $padLength = mt_rand(1, 4);
        $retval = str_pad($fragment, $padLength, $fragment[$padType ? 0 : ($len - 1)], $padType);

		return $retval;
	}
}
