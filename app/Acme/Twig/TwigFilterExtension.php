<?php

namespace App\Acme\Twig;

use Twig_Filter;
use Twig_Extension;

class TwigFilterExtension extends Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new Twig_Filter('price', array($this, 'priceFilter')),
        ];
    }

    /**
     * @param $number
     * @param int $decimals
     * @param string $decPoint
     * @param string $thousandsSep
     * @return string
     */
    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

}
