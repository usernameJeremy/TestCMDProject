<?php


class SubscriptionManager
{
    private $subscriptions;


    public function __construct() {
        $this->subscriptions = array();
    }

    public function loadSubscriptionsFromCSV() {

        $filename= 'MockData/MOCK_DATA.csv';
        $file = fopen($filename, 'r');

        // sla de eerste kolomnamen rij over
        fgetcsv($file);

        while (($row = fgetcsv($file)) !== FALSE) {
            $subscription = new Subscription($row[0], $row[1], $row[2], $row[3]);
            $this->subscriptions[] = $subscription;
        }

        fclose($file);

    }

    public function updateExpirationDate() {
        foreach ($this->subscriptions as $subscription) {
            $expirationDate = $subscription->getExpirationDate();
            $term = $subscription->getTerm();
            $newExpirationDate = $this->calculateNewExpirationDate($expirationDate, $term);
            $subscription->setExpirationDate($newExpirationDate);
        }
    }

    private function calculateNewExpirationDate($expirationDate, $term)
    {

        foreach ($this->subscriptions as $subscription) {
            $newExpirationDate = $subscription->calculateNewExpirationDate();

            // voeg de nieuwe vervaldatum toe aan het abonnement
            $subscription->setExpirationDate($newExpirationDate);
        }

    }

    public function getSubscription() {
        return $this->subscriptions;
    }

    public function addSubscription($subscription)
    {
    }


}