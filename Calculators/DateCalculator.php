<?php

class DateCalculator
{
    public function calculateNewExpirationDate(string $activeExpirationDate, string $term): string
    {
        $expirationDate = new DateTime($activeExpirationDate);

        // Bereken de nieuwe vervaldatum op de 25e van de maand
        $newExpirationDate = $expirationDate->modify('next month')->setDate(
            $expirationDate->format('Y'),
            $expirationDate->format('m'),
            25
        );

        // Als de 25e van de maand in het weekend valt, verschuif de datum naar de eerstvolgende werkdag
        if (in_array($newExpirationDate->format('N'), [6, 7])) {
            $newExpirationDate = $newExpirationDate->modify('next monday');
        }

        // Bereken de nieuwe vervaldatum met dezelfde termijn als het huidige abonnement
        switch ($term) {
            case 'm':
                $newExpirationDate = $newExpirationDate->modify('+1 month');
                break;
            case 'k':
                $newExpirationDate = $newExpirationDate->modify('+3 months');
                break;
            case 'j':
                $newExpirationDate = $newExpirationDate->modify('+1 year');
                break;
        }

        return $newExpirationDate->format('m-d-y');
    }

}