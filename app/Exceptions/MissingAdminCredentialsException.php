<?php

namespace App\Exceptions;

use Exception;

class MissingAdminCredentialsException extends Exception
{
    protected $message = 'Admin credentials not set in .env file';
}
