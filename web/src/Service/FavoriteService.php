<?php

namespace App\Service;

use App\Entity\Album;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class FavoriteService
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        private Security $security
    )
    {
        $this->entityManager = $entityManager;
    }

    public function addFavorite(array $data) : bool{
        // Add favorite
        $album = new Album();
        $album->setName($data['name']??'');
        $album->setType($data['type']??'');
        $album->setCountry($data['country']??'');
        $album->setYear($data['year']??'');
        $album->setGenre($data['genre']??'');
        $album->setFormat($data['format']??'');
        $album->setCover($data['imageUrl']??'');
        $album->setUrl($data['url']??'');
        $album->setLabel($data['label']??'');

        $userSecu = $this->security->getUser();
        if(!empty($userSecu)){
            $userId = $userSecu->getId();

            $userRepo = $this->entityManager->getRepository(User::class);

            $user = $userRepo->find($userId);


            $album->addUser($user);

            $this->entityManager->persist($album);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    public function removeFavorite(array $data) : bool{


        return true;
    }

}