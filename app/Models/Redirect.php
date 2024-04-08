<?php

namespace app\Models;

use Database\Model;
use Database\DataBase;

class Redirect extends Model
{

    public $tableName = "redirect";

    public $short_link;

    public function create($data): bool
    {
        $this->short_link = $this->generateShortHash();
        $redirect = [
            'short_link' => $this->short_link,
            'long_link' => $data,
        ];
        return parent::create($redirect);
    }

    public function getShortLink(){
        return $this->short_link;
    }

    public function generateShortHash(int $length = 10): string
    {
        // Define characters allowed in the hash
        $charPool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Generate a random string of specified length
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $charPool[random_int(0, strlen($charPool) - 1)];
        }

        return $randomString;
    }

}

//тут должен быть айди редайрект линк и шорт линк