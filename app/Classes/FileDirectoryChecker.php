<?php
include __DIR__ . '/JSONOutput.php';
include 'app/Traits/JSONConverter.php';
class FileDirectoryChecker
{
    use JSONConverter;

    //properties
    private $directory;
    private $file = ''; //accepts resource from opendir()
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


    private final function readFilesInDirectory()
    {
        //look at this 'file_type' => $fileType['extension']
        //reads files from directory path
        while (($file = readdir($this->file)) !== false) {

            if ($file != '.' && $file != '..') {
                $fileType = pathinfo($file);
                $dir = '/images/';
                //array_push($this->holder, $file);
                array_push($this->holder, ['file_name' => $fileType['basename'], 'file_type' => $fileType['extension'], 'path' => $dir]);

            }

        }

        //TODO decide - not sure whether to use a trait or use composition??
        $jsonObject = new JSONOutput();
        $json = $jsonObject->outputFileAsJSON($this->holder);
        //$json = JSONConverter::convertToJSON($this->holder);

        //var_dump($this->holder);
        var_dump($json);
    }


}

