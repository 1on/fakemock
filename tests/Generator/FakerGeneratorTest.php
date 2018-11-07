<?php


namespace Tests\Er1z\FakeMock\Generator;


use Er1z\FakeMock\Annotations\AnnotationCollection;
use Er1z\FakeMock\Annotations\FakeMockField;
use Er1z\FakeMock\FieldMetadata;
use Er1z\FakeMock\Generator\FakerGenerator;
use Faker\Generator;
use Faker\Guesser\Name;
use phpDocumentor\Reflection\Type;
use PHPUnit\Framework\TestCase;

class FakerGeneratorTest extends TestCase
{

    public function testFakerExplicit()
    {
        $faker = new FakerGenerator();

        $obj = new \stdClass();
        $obj->test = 'me';

        $prop = new \ReflectionProperty($obj, 'test');

        $config = new FakeMockField([
            'faker'=>'imageUrl',
            'arguments'=>[
                320, 240, 'cats'
            ]
        ]);

        $field = new FieldMetadata(
            $obj,
            $prop,
            $this->createMock(Type::class),
            $this->createMock(AnnotationCollection::class),
            $config
        );


        $result = $faker->generateForProperty($field);
        $this->assertNotNull(filter_var($result, FILTER_VALIDATE_URL, FILTER_NULL_ON_FAILURE));
        $this->assertContains('320', $result);
        $this->assertContains('240', $result);
    }

    protected function runGuess(FakerGenerator $faker){
        $obj = new \stdClass();
        $obj->created_at = null;

        $prop = new \ReflectionProperty($obj, 'created_at');

        $field = new FieldMetadata(
            $obj,
            $prop,
            $this->createMock(Type::class),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $result = $faker->generateForProperty($field);

        return $result;
    }

    public function testFakerGuess(){
        $faker = new FakerGenerator();
        $result = $this->runGuess($faker);

        $this->assertInstanceOf(\DateTime::class, $result);
    }

    public function testOwnGuesser(){
        $guesser = $this->createMock(Name::class);

        $guesser->expects($this->once())->method('guessFormat');

        $faker = new FakerGenerator($guesser);
        $this->runGuess($faker);

    }

    public function testOwnGenerator(){
        $generator = $this->createMock(Generator::class);

        $generator->expects($this->once())->method('__get');

        $faker = new FakerGenerator(null, $generator);
        $this->runGuess($faker);

    }

}