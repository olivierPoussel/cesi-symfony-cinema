<?php

namespace App\DataFixtures;

use App\Entity\Acteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $acteurJson = '	[
            {
                "id": 1,
                "nom": "DiCaprio",
                "prenom": "Leonardo"
            },
            {
                "id": 2,
                "nom": "WINSLET",
                "prenom": "KATE"
            },
            {
                "id": 3,
                "nom": "Cotillard",
                "prenom": "Marion"
            },
            {
                "id": 4,
                "nom": "Page",
                "prenom": "Ellen"
            },
            {
                "id": 5,
                "nom": "Bale",
                "prenom": "Christian"
            },
            {
                "id": 6,
                "nom": "HATHAWAY",
                "prenom": "ANNE"
            },
            {
                "id": 7,
                "nom": "Bale",
                "prenom": "Christian"
            },
            {
                "id": 8,
                "nom": "FREEMAN",
                "prenom": "MORGAN"
            },
            {
                "id": 9,
                "nom": "Damon",
                "prenom": "Matt"
            },
            {
                "id": 10,
                "nom": "Balfe",
                "prenom": "Caitriona"
            }
        ]';

        $acteurs = json_decode($acteurJson);
        foreach ($acteurs as $acteurSource) {
            $acteur = new Acteur();
            $acteur
                ->setNom($acteurSource->nom)
                ->setPrenom($acteurSource->prenom);

            $manager->persist($acteur);
        }
        $manager->flush();
    }
}
