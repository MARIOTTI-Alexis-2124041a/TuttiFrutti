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
        //TODO: fix path one day maybe inshallah
        $path = './Fruits.json';
        if (file_exists($path)) {
            $jsonString = file_get_contents($path);
            $jsonData = json_decode($jsonString, true);
            var_dump("test", $jsonData);
            foreach ($jsonData as $fruitName=>$value) {
                var_dump($fruitName);
                var_dump($value);
                $fruit = new Fruit();
                $fruit->setName($fruitName);
                $fruit->setSeason($value);
                $manager->persist($fruit);
            }
        } else {
            echo "The file does not exist at the specified path.";
            $finder = new Finder();

            $finder->files()->in('./');
            foreach ($finder as $file) {
                $fileNameWithExtension = $file->getRelativePathname();
                echo sprintf('File %s found in directory', $fileNameWithExtension);
            }
        }

        $manager->flush();
    }
}
