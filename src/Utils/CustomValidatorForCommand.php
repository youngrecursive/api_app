<?php 

namespace App\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;


class CustomValidatorForCommand 
{
    public function validateSiret(?string $siretEntered): string
    {
        if(empty($siretEntered))
        {
            throw new InvalidArgumentException('Veuillez saisir un numéro de siret');
        }

        if (!is_numeric($siretEntered) || mb_strlen($siretEntered) != 14)
        {
            throw new InvalidArgumentException('Veuillez saisir un numéro de siret, il doit contenir 14 chiffres');
        }


        return $siretEntered;
    }

}