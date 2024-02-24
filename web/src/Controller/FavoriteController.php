<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class FavoriteController extends AbstractController
{
    #[Route('/user/addFavorite', name: 'search')]
    public function updateItem(int $id, string $newData, MyService $myService): Response
    {
        if ($myService->updateData($id, $newData)) {
            $this->addFlash('success', 'Item inserted successfully!');
        } else {
            $this->addFlash('error', 'Failed to update item!');
        }

        return $this->json([
            'success' => true, // Send status in the response
            'message' => $this->container->get('translator')->trans('Item updated successfully!') // Use translator for i18n
        ]);
    }
}