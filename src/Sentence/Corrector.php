<?php

namespace Sentence;

class Corrector {

	protected $originalSentence = null;
	protected $correctedSentance = null;
	protected $corrections = 0;

    public function correct($sentence) {

		$retval = $this->originalSentence = $sentence;

        $response = $this->googleSearch($sentence);
        $start = strpos($response, '<span class="spell');

		if ($start !== false) {

            $end = strpos($response, '</a>', $start);
			$block = substr($response, $start, ($end + 4) - $start);
			$dom = new \DOMDocument();
			$dom->loadHTML($block);
			$this->corrections = count($dom->getElementsByTagName('i'));
			$retval = $this->correctedSentance = str_replace(array('Did you mean: ', 'Showing results for ', "\n"), '', strip_tags($dom->saveHTML()));
        }

        return $retval;
    }

	public function getOriginalSentance() {

		return $this->originalSentence;
	}

	public function getCorrectedSentance() {

		return $this->correctedSentance;
	}

	public function getCorrectionCount() {

		return $this->corrections;
	}

    protected function googleSearch($keywords) {


        $agents = array(
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.60 Safari/534.24",
            "Opera/9.63 (Windows NT 6.0; U; ru) Presto/2.1.1",
            "Mozilla/5.0 (Windows; U; Windows NT 6.0; en-US; rv:1.9.0.5) Gecko/2008120122 Firefox/3.0.5",
        );

        $url = 'http://www.google.com/search?client=firefox-a&hl=en&q=' . urlencode($keywords);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agents[rand(0, count($agents) - 1)]);
        $retval = curl_exec($ch);
        curl_close($ch);
        return $retval;
    }
}