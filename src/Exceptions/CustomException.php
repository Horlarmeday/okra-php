<?php


namespace App\Exceptions;


class CustomException extends \Exception
{
    public function errorMessage()
    {
        return $this->getMessage() . 'is required';
    }
}
