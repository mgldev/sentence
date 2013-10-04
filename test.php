<?php

require_once __DIR__ . '/Keyboard.php';
require_once __DIR__ . '/Scrambler.php';

use Sentence\Scrambler;

$scrambler = new Scrambler;
$sentences = [
	'The quick brown fox jumped over the lazy dog',
	'phpnw is the uks favourite php conference'
];

foreach ($sentences as $sentence) {
	$jennySaid = $scrambler->scramble($sentence);
	echo 'Or, as Jenny would say: ' . $jennySaid . "\n";
}
