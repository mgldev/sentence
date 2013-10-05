<?php

require_once __DIR__ . '/vendor/autoload.php';

use Sentence\Scrambler;
use Sentence\Corrector;

$scrambler = new Scrambler;
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