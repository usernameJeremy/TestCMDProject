<?php

class CSVReader
{
    private $handle;

    public function __construct(string $filepath)
    {
        $this->handle = fopen($filepath, 'r');
    }

    public function readSubscriptions(): array
    {
        $subscriptions = [];

        while (($row = fgetcsv($this->handle)) !== false) {
            $subscription = new Subscription(
                $row[0],
                $row[1],
                $row[2],
                $row[3]
            );
            $subscriptions[] = $subscription;
        }

        return $subscriptions;
    }

    public function __destruct()
    {
        fclose($this->handle);
    }

}