<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Turbo\TurboBundle;

class RegistrationController extends AbstractController
{
    public function __construct(public EntityManagerInterface $entityManager)
    {

    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setUsername($form->get('username')->getData());
            $user->setRoles(array());
            $this->entityManager->persist($user);
            $this->entityManager->flush();
            // do anything else you need here, like send an email

            $this->addFlash('success', 'Votre inscription a été effectuée avec succès.');

            return $this->redirectToRoute('app_login');
        }
        /*
        if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
            // If the request comes from Turbo, set the content type as text/vnd.turbo-stream.html and only send the HTML to update
            $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
        }*/
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
        //, new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200)
        //does not work in debug
    }
}
