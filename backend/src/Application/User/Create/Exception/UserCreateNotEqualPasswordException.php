<?php

namespace App\Application\User\Create\Exception;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UserCreateNotEqualPasswordException extends BadRequestException
{
    public function __construct()
    {
        $this->message = 'As senhas enviadas não igual';
        $this->code = 400;
    }
}
