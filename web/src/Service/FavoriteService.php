<?php

namespace App\Service;

use App\Entity\Favorite;
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
        $favoriteRepo = $this->entityManager->getRepository(Favorite::class);
        $favorites = $favoriteRepo->findBy(['name' => $data['name'], 'type' => $data['type']]);
        if (empty($favorites)) {
            $favorite = new Favorite();
            $favorite->setName($data['name']??'');
            $favorite->setType($data['type']??'');
            $favorite->setCountry($data['country']??'');
            $favorite->setYear($data['year']??'');
            $favorite->setGenre($data['genre']??'');
            $favorite->setFormat($data['format']??'');
            $favorite->setCover($data['imageUrl']??'');
            $favorite->setUrl($data['url']??'');
            $favorite->setLabel($data['label']??'');
        }
        else{
            $favorite = $favorites[0];
        }


        $user = $this->getUser();
        if(!empty($user)){
            $favorite->addUser($user);

            $user->addfavorite($favorite);

            $this->entityManager->persist($favorite);
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
            $favoriteRepo = $this->entityManager->getRepository(Favorite::class);
            $favorite = $favoriteRepo->findBy(['name' => $data['name'], 'type' => $data['type']]);
            if(!empty($favorite)) {
                $toReturn = false;
                foreach ($favorite as $a) {
                    if ($user->getfavorites()->contains($a)) {
                        $user->removefavorite($a);
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
            $favoriteRepo = $this->entityManager->getRepository(Favorite::class);
            $favorite = $favoriteRepo->findBy(['name' => $name, 'type' => $type]);
            foreach ($favorite as $a){
                if($user->getfavorites()->contains($a)){
                    return true;
                }
            }
        }

        return false;
    }

}