<?php

class Application
{
    private $subscriptionManager;
    private $csvReader;
    private $csvWriter;

    public function __construct(string $csvFilePath)
    {
        $this->subscriptionManager = new SubscriptionManager(new DateCalculator());
        $this->csvReader = new CSVReader($csvFilePath);
        $this->csvWriter = new CSVWriter($csvFilePath);
    }

    public function run()
    {
        // Lees de abonnementen uit het CSV-bestand en converteer ze naar Subscription objecten
        $subscriptions = $this->csvReader->readSubscriptions();

        // Voeg de Subscription objecten toe aan de SubscriptionManager
        foreach ($subscriptions as $subscription) {
            $this->subscriptionManager->addSubscription($subscription);
        }

        // Werk alle vervaldatums bij
        $this->subscriptionManager->updateVervaldatums();

        // Schrijf de bijgewerkte abonnementen terug naar het CSV-bestand
        $this->csvWriter->saveSubscriptionsToCSV($this->subscriptionManager->getSubscriptions());
    }



}

