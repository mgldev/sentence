<?php

require_once __DIR__ . '/vendor/autoload.php';

use Sentence\Scrambler;
use Sentence\Keyboard;
use Sentence\Ballsup;
use Sentence\Corrector;

$scrambler = new Scrambler();
$scrambler->addBallsup(new Ballsup\FatFingers(new Sentence\Keyboard()))
            ->addBallsup(new Ballsup\FirstSecondLetterSwitch())
            ->addBallsup(new Ballsup\RepeatFirstOrLastLetter());

$corrector = new Corrector;

$sentences = [
	'The quick brown fox jumped over the lazy dog and the hyperactive cat'
];

foreach ($sentences as $sentence) {

	$scrambled = $scrambler->scramble($sentence);
	$corrected = $corrector->correct($scrambled);

	echo 'Original sentence: ' . $sentence . "\n";
	echo 'Scrambled: ' . $scrambled . "\n";
	echo 'Corrected: ' . $corrected . "\n";
}