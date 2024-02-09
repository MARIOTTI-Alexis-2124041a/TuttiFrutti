<?php

namespace App\DataFixtures;

use App\Entity\Fruit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Finder\Finder;

class AppFixtures extends Fixture
{
    private string $projectDir;

    public function __construct(string $projectDir)
    {
        $this->projectDir = $projectDir;
    }
    public function load(ObjectManager $manager): void
    {
        $path = './src/DataFixtures/Fruits.json';
        if (file_exists($path)) {
            $jsonString = file_get_contents($path);
            $jsonData = json_decode($jsonString, true);
            var_dump("test", $jsonData);
            foreach ($jsonData as $fruitName=>$value) {
                $fruit = new Fruit();
                $fruit->setName($fruitName);
                $fruit->setSeason($value);
                $manager->persist($fruit);
            }
        } else {
            echo "The file does not exist at the specified path.";
        }

        $manager->flush();
    }
}