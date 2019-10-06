<?php

class Render
{

    private $json;

    public function __construct($json)
    {
        $this->json = $json;
    }

    /*
     * Method will render the image gallery
     */
    public function render()
    {
        foreach ($this->json as $image) {

        }
    }
}