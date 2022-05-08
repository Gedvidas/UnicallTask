<?php

namespace Unicall\Helper;


use Unicall\Email;

class Validator
{
    public static function isValidEmail(string $email) : bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @throws \League\Csv\Exception
     */
    public static function isUniqueEmail(string $email, string $file) : bool {
        $allRecord = (new Email())->getAll();
        return strpos($allRecord, $email) === false;
    }
}