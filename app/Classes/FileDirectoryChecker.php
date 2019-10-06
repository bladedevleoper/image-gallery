<?php
include __DIR__ . '/JSONOutput.php';
include 'app/Traits/JSONConverter.php';
include __DIR__ . '/Render.php';
class FileDirectoryChecker
{
    use JSONConverter;

    //properties
    private $directory;
    private $file = ''; //accepts resource from opendir()
    private $holder = [];
    private $jsonObject;

    public function __construct($directory)
    {
        $this->directory = $directory;
        //$this->openFileDirectory();

    }

    public function openFileDirectory()
    {

        //Check Directory and open directory
        try {

            if (!$this->checkFileInDirectory()) {

                throw new Exception('Folder cannot be found');
            }


            $this->file = opendir($this->directory);
            $this->readFilesInDirectory();

        } catch (Exception $e) {
            echo $e->getMessage();
        }


    }

    private function checkFileInDirectory()
    {

            if (!is_dir($this->directory)) {

                return false;

            }

            return true;

    }


    private function readFilesInDirectory()
    {
        //look at this 'file_type' => $fileType['extension']
        //reads files from directory path
        while (($file = readdir($this->file)) !== false) {

            if ($file != '.' && $file != '..') {
                $fileType = pathinfo($file);
                $dir = 'images/';
                //array_push($this->holder, $file);
                array_push($this->holder, ['file_name' => $fileType['basename'], 'file_type' => $fileType['extension'], 'path' => $dir]);

            }

        }

        //TODO decide - not sure whether to use a trait or use composition??
        //TODO pass $this->holder to JSONOutput and then pass to render class
        $this->jsonObject = new JSONOutput();
        $json = $this->jsonObject->outputFileAsJSON($this->holder);

        //var_dump($json);
        echo $json;
    }


}

