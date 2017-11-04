<?php

namespace App\Acme\Twig;

use Ozone\Token;
use Ozone\Validate;
use Twig_Function;
use Twig_Extension;
use Slim\Flash\Messages as Flash;

class TwigFunctionExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('csrf', array($this, 'csrfFunction')),
            new Twig_Function('flash', array($this, 'flashFunction')),
            new Twig_Function('old', array($this, 'oldInputFunction')),
            new Twig_Function('error', array($this, 'errorFunction')),
        ];
    }

    //CSRF
    public function csrfFunction()
    {
        return Token::csrf();
    }

    /**
     * @return Flash
     */
    public function flashFunction()
    {
        return new Flash();
    }

    /**
     * @param $inputName
     * @param bool $valueReset
     * @return string
     */
    public function oldInputFunction($inputName, $valueReset = false)
    {
        return Validate::rePopulate($inputName, $valueReset);
    }

    /**
     * @param $displayName
     * @return mixed|string
     */
    public function errorFunction($displayName)
    {
        return Validate::GetError($displayName);
    }
}
