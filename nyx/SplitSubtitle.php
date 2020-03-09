<?php

namespace nyx;

class SplitSubtitle
{
    public $phrases = [];
    public $words = [];
    public $totalWords = 0;

    public function __construct(String $subtitleFile)
    {
        $data = file($subtitleFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $this->explodePhrases($data);
        $this->explodeWords();
    }

    private function explodeWords()
    {
        foreach ($this->phrases as $phrase) {
            $allWords = explode(" ", $phrase);
            foreach ($allWords as $word) {
                $word = preg_replace('/[.,\/#!$%\^&\*;?:{}=\-_`~()]/', '', $word);
                if (strlen($word) != 0) {
                    $word = strtolower($word);
                    $this->totalWords++;
                    $this->words[$word] = $this->words[$word] + 1;
                }
            }
        }

        arsort($this->words);
    }

    private function explodePhrases(array $text)
    {
        $phrase = "";
        foreach ($text as $key => $line) {
            if (!is_numeric($line) && strpos($line, '-->') === false) {
                if ($phrase != "")
                    $phrase .= " " . $line;
                else
                    $phrase = $line;

                $finishPhrase = ['!', '.', '?'];
                $lastPontuation = substr($line, -1);
                if (in_array($lastPontuation, $finishPhrase)) {
                    $this->phrases[] = $phrase;
                    $phrase = '';
                }
            }
        }
    }
}