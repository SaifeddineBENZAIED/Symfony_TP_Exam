<?php

namespace App\DataFixtures;

//use App\Entity\Etudiant;
//use App\Entity\Section;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
//use Exception;
//use Faker\Factory;


class EtudiantFixtures extends Fixture
{
//    /**
//     * @throws Exception
 //    */
 public function load(ObjectManager $manager): void
 {
 //       $tab = [
 //           'Sc. Informatique',
 //           'Mathématique',
 //           'Sc. Technique',
 //           'Sc. Economique'
 //       ];
 //       $faker = Factory::create('fr_FR');
 //       for ($i=0;$i<100;$i++) {
 //           $etud = new Etudiant();
 //           $etud->setNom($faker->lastName);
 //           $etud->setPrenom($faker->firstName);
 //           $sectORno = random_int(0,1);
 //           if($sectORno==0){
//                $i = random_int(0,3);
 //               $mySection = new Section();
 //               $mySection->addEtudiant($etud);
 //           }
 //           $manager->persist($etud);
 //       }
//
 //       $manager->flush();
 }

}
