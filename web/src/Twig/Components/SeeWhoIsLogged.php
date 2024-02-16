<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class SeeWhoIsLogged
{
    public String $beforeName = 'Hello ';
    public String $name;
    public String $logoutButtonName = 'Log out';

    public String $profilePicturePath = 'images/userDefaultProfile.png';
}