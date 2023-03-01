<?php

class CSVWriter
{
    private string $filePath;


    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function updateExpirationDate(DateCalculator $calculator)
    {
        foreach ($this->subscriptions as $subscription) {
            $newExpirationDate = $calculator->calculateNewExpirationDate($subscription->getExpirationDate(), $subscription->getTerm());
            $subscription->setExpirationDate($newExpirationDate);
        }
    }


    public function renewSubscription(int $id, DateCalculator $calculator)
    {
        foreach ($this->subscriptions as $subscription) {
            if ($subscription->getId() === $id) {
                $newExpirationDate = $calculator->calculateNewExpirationDate($subscription->getExpirationDate(), $subscription->getTerm());
                $subscription->setExpirationDate($newExpirationDate);
                break;
            }
        }
    }

    public function saveSubscriptionsToCSV(array $subscriptions, string $filename)
    {
        $file = fopen($filename, 'w');

        // Schrijf de kolomnamen
        fputcsv($file, ['subscriptionNumber', 'name', 'expirationDate', 'term']);

        // Schrijf de abonnementen
        foreach ($subscriptions as $subscription) {
            fputcsv($file, [$subscription->getSubscriptionNumber(), $subscription->getName(), $subscription->getExpirationDate(), $subscription->getTerm()]);
        }

        fclose($file);
    }
}