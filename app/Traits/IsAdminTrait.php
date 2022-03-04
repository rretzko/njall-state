<?php

namespace App\Traits;

trait IsAdminTrait
{
    public function isAdmin() : bool
    {
        $ipaddresses = ['127.0.0.1:8000',];

        return in_array($_SERVER['HTTP_HOST'], $ipaddresses);
    }

}
