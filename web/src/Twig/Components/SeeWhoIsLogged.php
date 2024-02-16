<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class SeeWhoIsLogged
{
    public String $beforeName = 'Hello ';
    public String $name;
}