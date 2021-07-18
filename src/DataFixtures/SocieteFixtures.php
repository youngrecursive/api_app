<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Societe;
use Doctrine\Persistence\ObjectManager;

class SocieteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $societe = new Societe();
        $societe->setSiret('12345678987456');
        $societe->setNic('0056');
        $societe->setSiren('156956364');
        $societe->setDateCreation(new \DateTime());
        $societe->setEtablissementSiege(true);
        $societe->setNomUniteLegale('Germain');
        $societe->setCodePostal('75000');
        $societe->setVille('Paris');
        $societe->setNomSociete('boite1');
        $societe->setNumeroVoieEtablissement('32');
        $societe->setTypeVoieEtablissement('rue');
        $societe->setLibelleVoieEtablissement('Republique');


        $societe1 = new Societe();
        $societe1->setSiret('12345678987444');
        $societe1->setNic('0042');
        $societe1->setSiren('156956368');
        $societe1->setDateCreation(new \DateTime());
        $societe1->setEtablissementSiege(true);
        $societe1->setNomUniteLegale('Martin');
        $societe1->setCodePostal('72000');
        $societe1->setVille('Le Mans');
        $societe1->setNomSociete('boite2');
        $societe1->setNumeroVoieEtablissement('60');
        $societe1->setTypeVoieEtablissement('rue');
        $societe1->setLibelleVoieEtablissement('Marcel Pagnol');


        $manager->persist($societe);
        $manager->persist($societe1);
        $manager->flush();
    }
}
