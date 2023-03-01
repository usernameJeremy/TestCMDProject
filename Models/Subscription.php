<?php

class Subscription
{
    private $subscriptionNumber;
    private $name;
    private $term;
    private $expirationDate;

    public function __construct($subscriptionNumber, $name, $term, $expirationDate) {
        $this->subscriptionNumber = $subscriptionNumber;
        $this->name = $name;
        $this->term = $term;
        $this->expirationDate = $expirationDate;
    }

    public function renewSubscription(): DateTime
    {
        // bepaal de verlengdatum op de 25e van de huidige maand
        $renewSubscriptionDate = new DateTime($this->renewSubscriptionDate->format('m-25-y'));

        // als de 25e in het weekend valt, verschuif dan naar de dichtstbijzijnde werkdag
        if ($renewSubscriptionDate->format('N') >= 6) {
            $renewSubscriptionDate->modify('next Monday');
        }

        return $renewSubscriptionDate;
    }


    public function getSubscriptionNumber() {
        return $this->subscriptionNumber;
    }

    public function setSubscriptionNumber($subscriptionNumber) {
        $this->subscriptionNumber = $subscriptionNumber;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTerm() {
        return $this->term;
    }

    public function setTerm($term) {
        $this->term = $term;
    }

    public function getExpirationDate() {
        return $this->expirationDate;
    }

    public function setExpirationDate($expirationDate) {
        $this->expirationDate = $expirationDate;
    }

}