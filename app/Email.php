<?php

namespace Unicall;

use League\Csv\CannotInsertRecord;
use League\Csv\Reader;
use League\Csv\Writer;

/** Model CLass */
class Email
{
    public $file = CSV_FILE;

    /**
     */
    public function add(string $email): string
    {
        $writer = Writer::createFromPath($this->file, 'a');
        // Email address is valid and unique, lets insert it into csv file

        try {
            $writer->insertOne([$email]);
        } catch (CannotInsertRecord $e) {
            return $e->getMessage();
        }

        return  '';
    }

    public function getAll() {
        $csv = Reader::createFromPath($this->file, 'r');
        return $csv->toString(); //returns the CSV document as a string

    }
}