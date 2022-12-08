<?php

namespace App\Service;

/**
 * Classe bidon pour faire un test unitaire simple
 */
class Calculator
{
    /**
     * Somme de 2 nombres
     * 
     * @param float $a nombre 1
     * @param float $b nombre 2
     * @return float La somme des 2 nombres
     */
    public function somme(float $a, float $b): float
    {
        return $a + $b;
    }
}
