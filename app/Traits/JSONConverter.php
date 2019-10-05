<?php

trait JSONConverter
{
    public function convertToJSON($array)
    {
        return json_encode($array);
    }
}