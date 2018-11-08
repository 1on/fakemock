<?php


namespace Er1z\FakeMock\Generator\PhpDocGenerator;


use Er1z\FakeMock\FieldMetadata;
use Faker\Generator;

class Boolean implements GeneratorInterface
{

    public function generateForProperty(FieldMetadata $field, Generator $faker)
    {
        return (bool)mt_rand(0, 1);
    }
}