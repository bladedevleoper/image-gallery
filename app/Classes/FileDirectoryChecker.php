<?php
include __DIR__ . '/JSONOutput.php';
include 'app/Traits/JSONConverter.php';
class FileDirectoryChecker
{
    use JSONConverter;

    //properties
    private $directory;
    private $file = '';
    private $holder = [];

    public function __construct($directory)
    {
        $this->directory = $directory;
        $this->openFileDirectory();

    }

    private function checkFileInDirectory()
    {
        if (!is_dir($this->directory)) {

            return false;
        }

        return true;

    }

    private function openFileDirectory()
    {

        if (!$this->checkFileInDirectory()) {
            //push files to error
            echo 'No Files in Directory';
        }

        //open directory
        if ($this->file = opendir($this->directory)) {

            $this->readFilesInDirectory();

        }

    }


    private function readFilesInDirectory()
    {

        //reads files from directory path
        while (($file = readdir($this->file)) !== false) {

            if ($file != '.' && $file != '..') {
                array_push($this->holder, $file);
            }

        }

        //TODO decide - not sure whether to use a trait or use composition??
        //$jsonObject = new JSONOutput();
        //var_dump($jsonObject->outputFileAsJSON($this->holder));
        //$json = JSONConverter::convertToJSON($this->holder);


    }




}

