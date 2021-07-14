<?php

class FileRepository
{
   private string $filename;
   private array $dictionary = [];

    /**
     * Translator constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }


    public function readDB():void
    {
        $file = fopen($this->filename, 'rb');

        while(! feof($file)) {
            $result = fgetcsv($file);
          $this->dictionary[$result[0]] = $result[1];
        }
    }

    public function findTheWord(string $wordToSearch): ?string
    {

        foreach($this->dictionary as $word => $explanations){
            if($word === $wordToSearch){
                return $explanations;
            }
        }

        return null;
    }

    public function deleteWord(string $word){
        foreach ($this->dictionary as $wordFound => $explanation) {
            if($wordFound === $word){
                unset($this->dictionary[$wordFound]);
            }
        }

    }

    public function addWord(array $updatedDictionary): bool
    {
        $file = fopen('translatorDB2.csv', 'wb+');

        file_put_contents($this->filename, "");

        foreach($updatedDictionary as $word => $explanation) {

            $line = "$word" . ','. "$explanation";

            fputcsv($file, $line);

            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getDictionary(): array
    {
        return $this->dictionary;
    }



}