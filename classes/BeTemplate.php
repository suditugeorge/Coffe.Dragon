<?php

use util\Microdata;

class BeTemplate extends Template
{
    public function trim($value)
    {
        return trim($value);
    }

    public function get($value)
    {
        $f3 = \Base::instance();
        return $f3->get($value);
    }
}
