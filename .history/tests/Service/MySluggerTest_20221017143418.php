<?php

namespace App\Tests\Service;

use App\Service\MySlugger;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MySluggerTest extends KernelTestCase
{
    public function testSlugify(): void
    {
        // on boot le Kernel de Symfo
        $kernel = self::bootKernel();

        /** @var MySlugger $mySlugger notre slugger */
        // on demande à récupérer le service à tester
        $mySlugger = static::getContainer()->get(MySlugger::class);

        // test de slugify()
        $result = $mySlugger->slugify('Hello World');

        // lower case ?
        
        $this->assertSame('hello-world', $result);
    }
}
