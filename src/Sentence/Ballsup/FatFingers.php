<?php

namespace Sentence\Ballsup;
use Sentence\Ballsup;
use Sentence\Keyboard;

class FatFingers implements Ballsup
{

    /**
     * @var Sentence\Keyboard
     */
    protected $keyboard;

    public function __construct(Keyboard $keyboard)
    {

        $this->setKeyboard($keyboard);
    }

    public function setKeyboard(Keyboard $keyboard)
    {

        $this->keyboard = $keyboard;

        return $this;
    }

    /**
     * @return Sentence\Keyboard
     */
    public function getKeyboard()
    {
        return $this->keyboard;
    }

    public function ballsup($fragment)
    {
        $len = strlen($fragment);

        $mistakes = mt_rand(0, 2);
        $chars = str_split($fragment);
        for ($i = 0; $i < $mistakes; $i++) {
            $pos = mt_rand(0, $len - 1);
            $likelyMistakes = $this->getKeyboard()->getNeighbouringKeys($chars[$pos]);
            $mistake = $likelyMistakes[mt_rand(0, count($likelyMistakes) - 1)];
            $chars[$pos] = $mistake;
        }
        $retval = implode($chars);

        return $retval;
    }
}