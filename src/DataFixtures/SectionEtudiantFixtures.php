<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;

class SectionEtudiantFixtures extends Fixture
{
    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $tab = [
            'Sc. Informatiques',
            'Mathématique',
            'Sc. Expérimentales',
            'Sc. Techniques',
            'Sc. Economiques',
            'Littéraire',
            'Sport'
        ];

        $faker = Factory::create('fr_FR');
        $t = 0;
        while($t < 100) {
            for ($i = 0; $i < 7; $i++) {
                $sect = new Section();
                $sect->setDesignation($tab[$i]);
                $tot = 0;
                $EparS = random_int(0, 30);
                while (($tot+$EparS) >= 100) {
                    $EparS = random_int(0, 30);
                }
                $tot = $tot + $EparS;
                for ($j = 0; $j < $EparS; $j++) {
                    $etud = new Etudiant();
                    $etud->setNom($faker->lastName);
                    $etud->setPrenom($faker->firstName);
                    $sectORno = random_int(0, 1);
                    if ($sectORno == 0) {
                        $sect->addEtudiant($etud);
                    }
                    $manager->persist($etud);
                }
                $manager->persist($sect);
            }
            $t=$tot;
        }

        $manager->flush();
    }
}
