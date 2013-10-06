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

        break;

    default:
        break;
}

return $retval;