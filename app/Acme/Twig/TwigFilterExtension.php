<?php

namespace Acme\Twig;

use Twig_Filter;
use Twig_Extension;

class TwigFilterExtension extends Twig_Extension
{
    public function getFilters()
    {
        return [
            new Twig_Filter('price', array($this, 'priceFilter')),
        ];
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }


}