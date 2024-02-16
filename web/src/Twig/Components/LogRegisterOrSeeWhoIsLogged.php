<?php
namespace App\Twig\Components;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;


#[AsTwigComponent]
class LogRegisterOrSeeWhoIsLogged
{

    public String $beforeName = 'Hello ';
    public String $logButtonName = 'Log in';
    public String $registerButtonName = 'Register';
}