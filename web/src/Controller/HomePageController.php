<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    #[Route('/')]
    public function number(): Response
    {
        $finder = new Finder();

        $finder->files()->in('/');
        foreach ($finder as $file) {
            $fileNameWithExtension = $file->getRelativePathname();
            echo sprintf('File %s found in directory', $fileNameWithExtension);
        }

        return $this->render('homepage.html.twig', [
            'number' => "",
        ]);
    }
}