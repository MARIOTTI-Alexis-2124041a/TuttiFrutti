<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $path = 'Fruits.json';
        $jsonString = file_get_contents($path);
        $jsonData = json_decode($jsonString, true);
        var_dump("test", $jsonData);

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
