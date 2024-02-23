<?php

namespace App\Twig\Components;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
#[AsTwigComponent]
class LogRegister
{
    public String $logButtonName = 'Log in';
    public String $registerButtonName = 'Register';

}