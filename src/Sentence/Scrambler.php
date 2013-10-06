<?php

namespace Sentence;

use Sentence\Keyboard;
use Sentence\Ballsups;

class Scrambler
{

    protected $ballsups = [];

    protected $scrambled = false;

    protected $passes = 2;

    protected $probability = 10;

    public function __construct($options = array())
    {
        $this->setOptions($options);
    }

    public function setOptions(array $options) {

        foreach ($options as $key => $value) {

            switch ($key) {

                default:
                    if (isset($this->$key )) {
                        $this->$key = $value;
                    }
                    break;
            }
        }
    }

    public function scramble($sentence)
    {

        $sentence = strtolower($this->removePunctuation($sentence));


        for ($i = 0; $i < $this->passes; $i++) {

            $retval = '';
            $fragments = explode(' ', $sentence);
            foreach ($fragments as $fragment) {

                $screwUp = mt_rand(0, 100) < $this->probability;
                $ballsedUpFragment = $fragment;
                if ($screwUp) {
                    $ballsedUpFragment = $this->getRandomBallsup()->ballsup($fragment);
                    $this->scrambled = true;
                }
                $retval .= ' ' . $ballsedUpFragment;
            }
            $sentence = $retval;
        }

        if (!$this->scrambled) {
            $retval = $this->scramble($retval);
        } else {
            $retval = $this->hitSpacebarOnCaffeine() . $retval;
        }

        return $retval;
    }

    protected function removePunctuation($sentence)
    {

        $retval = preg_replace("/[^A-Za-z0-9 ]/", '', $sentence);
        return $retval;
    }

    public function hitSpacebarOnCaffeine()
    {

        $retval = ' ';
        if (mt_rand(0, 100) < 30) {
            $retval = str_pad('', mt_rand(1, 8), ' ', STR_PAD_LEFT);
        }

        return $retval;
    }

    public function addBallsup(Ballsup $ballsup)
    {

        $this->ballsups[] = $ballsup;
        return $this;
    }

    public function getBallsups()
    {
        return $this->ballsups;
    }

    /**
     * @return Sentence\Ballsup
     */
    public function getRandomBallsup()
    {

        return $this->ballsups[rand(0, count($this->ballsups) - 1)];
    }
}