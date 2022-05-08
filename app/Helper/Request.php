<?php

namespace Unicall\Helper;

class Request
{
    public function getPatch() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function getEmailFromJson() {
        $email = json_decode(file_get_contents('php://input', true));
        if ($email) {
            $email = (array) $email;
            if (isset($email['email'])) {
                $email = $email['email'];
            }
        }

        return $email;
    }
}