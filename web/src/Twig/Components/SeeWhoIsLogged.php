<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class SeeWhoIsLogged
{
    public String $name;
    public String $logoutButtonName = 'Se déconnecter';

    public String $profilePicturePath = 'images/userDefaultProfile.png';
}