<?php

namespace App\Tests\Service;

use App\Service\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    // chaque test est préfixé par "test"
    public function testSomme(): void
    {
        // instancie la classe Calculator
        $calculator = new Calculator;

        // on appelle la fonction somme
        $result = $calculator->somme(40, 2);

        // attendu : 42, versus résultat trouvé
        $this->assertEquals(42, $result);
    }
}
