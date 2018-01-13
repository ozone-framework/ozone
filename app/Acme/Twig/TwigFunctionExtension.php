<?php

namespace App\Acme\Twig;

use Core\FlashMessage;
use Ozone\Token;
use Ozone\Validate;
use Twig_Extension;
use Twig_Function;

class TwigFunctionExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new Twig_Function('csrf', array($this, 'csrfFunction')),
            new Twig_Function('old', array($this, 'oldInputFunction')),
            new Twig_Function('error', array($this, 'errorFunction')),
            new Twig_Function('flashMessage', array($this, 'flashMessage')),
        ];
    }

    //CSRF
    public function csrfFunction()
    {
        return Token::csrf();
    }

    /**
     * @param $inputName
     * @return string
     */
    public function oldInputFunction($inputName)
    {
        return Validate::rePopulate($inputName);
    }

    /**
     * @param $displayName
     * @return mixed|string
     */
    public function errorFunction($displayName)
    {
        return Validate::GetError($displayName);
    }

    public function flashMessage()
    {
        $flash = new FlashMessage();
        $msg = $flash::defaultType;

        if ($flash->hasMessages($flash::INFO)) {
            $msg = $flash::INFO;

        } elseif ($flash->hasMessages($flash::SUCCESS)) {
            $msg = $flash::SUCCESS;

        } elseif ($flash->hasMessages($flash::ERROR)) {
            $msg = $flash::ERROR;

        } elseif ($flash->hasMessages($flash::WARNING)) {
            $msg = $flash::WARNING;

        }

        return $flash->display([$msg]);
    }

}
