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
        $albumRepo = $this->entityManager->getRepository(Album::class);
        $albums = $albumRepo->findBy(['name' => $data['name'], 'type' => $data['type']]);
        if (empty($albums)) {
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
        }
        else{
            $album = $albums[0];
        }


        $user = $this->getUser();
        if(!empty($user)){
            $album->addUser($user);

            $user->addAlbum($album);

            $this->entityManager->persist($album);
            $this->entityManager->persist($user);
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
            $album = $albumRepo->findBy(['name' => $data['name'], 'type' => $data['type']]);
            if(!empty($album)) {
                $toReturn = false;
                foreach ($album as $a) {
                    if ($user->getAlbums()->contains($a)) {
                        $user->removeAlbum($a);
                        $a->removeUser($user);
                        $this->entityManager->persist($a);

                        $toReturn = true;
                    }
                }
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $toReturn;
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
            foreach ($album as $a){
                if($user->getAlbums()->contains($a)){
                    return true;
                }
            }
        }

        return false;
    }

}