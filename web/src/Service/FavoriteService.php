<?php

namespace App\Service;

use App\Entity\Album;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\SecurityBundle\Security;


class FavoriteService
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        private Security $security,
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

        $user = $this->getUser();
        if(!empty($user)){
            $album->addUser($user);

            $this->entityManager->persist($album);
            $this->entityManager->flush();

            return true;
        }

        return false;
    }

    public function removeFavorite(array $data) : bool{
        // Remove favorite
        $user = $this->getUser();
        if(!empty($user)){
            $albumRepo = $this->entityManager->getRepository(Album::class);
            $album = $albumRepo->findBy(['name' => $data['name'], 'type' => $data['type']])[0];
            if(!empty($album)){
                $user->removeAlbum($album);
                $album->removeUser($user);
                $this->entityManager->persist($user);
                $this->entityManager->persist($album);
                $this->entityManager->flush();

                return true;
            }
        }

        return false;
    }

    private function getUser(): ?User
    {
        $userSecu = $this->security->getUser();
        if(!empty($userSecu)){
            $userId = $userSecu->getId();

            $userRepo = $this->entityManager->getRepository(User::class);

            $user = $userRepo->find($userId);
            return $user;
        }
        return null;
    }

    public function checkIfFavorite(string $name, string $type) : bool{
        // Check if favorite
        $user = $this->getUser();
        if(!empty($user)){
            $albumRepo = $this->entityManager->getRepository(Album::class);
            $album = $albumRepo->findBy(['name' => $name, 'type' => $type]);
            if(!empty($album)){
                return true;
            }
        }

        return false;
    }

}