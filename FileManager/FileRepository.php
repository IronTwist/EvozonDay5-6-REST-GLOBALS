<?php

class FileRepository
{
   private string $filename;
   private array $dictionar = [];

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
        //TODO MAP
        while(! feof($file)) {
            $result = fgetcsv($file);
          $this->dictionar[] = $result;
        }
    }

    public function findTheWord(string $wordToSearch): ?string
    {
        foreach($this->dictionar as $explanations){
            if($explanations[0] === $wordToSearch){
                return $explanations[1];
            }
        }

        return null;
    }

    public function deleteWord(string $word){
        foreach ($this->dictionar as $wordSearch) {
            if($wordSearch[0] === $word){
                array_pop($wordSearch[0]);
            }
        }
//        var_dump($this->dictionar);
    }

    public function addWord(array $newDictionarWords): bool
    {
        file_put_contents($this->filename, "");

        $file = fopen($this->filename, 'wb+');

        foreach($newDictionarWords as $dictionarWord) {
            $arr = $dictionarWord;

            $arr2 = implode(',',$dictionarWord);
            var_dump($arr2);
            fputcsv($file, $arr2);
            return true;
        }

        return false;
    }

    /**
     * @return array
     */
    public function getDictionar(): array
    {
        return $this->dictionar;
    }



}