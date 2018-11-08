<?php


namespace Tests\Er1z\FakeMock\Decorator\AssertDecorator;


use Er1z\FakeMock\Annotations\AnnotationCollection;
use Er1z\FakeMock\Annotations\FakeMockField;
use Er1z\FakeMock\Decorator\AssertDecorator\GreaterThanOrEqual;
use Er1z\FakeMock\Decorator\AssertDecorator\LessThanOrEqual;
use Er1z\FakeMock\Metadata\FieldMetadata;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\TestCase;

class GreaterThanOrEqualTest extends TestCase
{

    public function testWithoutNumericValue()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 'asdasd';
        $this->expectException(\InvalidArgumentException::class);

        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value'=>10
        ]));
    }

    public function testWithoutPropertyNumericValue()
    {
        $obj = new \stdClass();
        $obj->test = ['asd'];

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Float_(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $num = 10.0;

        $decorator = new GreaterThanOrEqual();

        $this->expectException(\InvalidArgumentException::class);

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath'=>'test'
        ]));
    }

    public function testScalarValueInt()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10;

        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value'=>10
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $num = 11;
        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value'=>10
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

    }

    public function testScalarValueFloat()
    {
        $decorator = new GreaterThanOrEqual();

        $obj = new \stdClass();
        $obj->test = null;

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Float_(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $num = 10.0;

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value'=>10.0
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $num = 10.1;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value'=>10.0
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

    }

    public function testPropertyPathInt()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10;

        $obj = new \stdClass();
        $obj->test = 10;

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Integer(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath'=>'test'
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $obj = new \stdClass();
        $obj->test = 10;

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Integer(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $num = 11;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath'=>'test'
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

    }

    public function testPropertyPathFloat()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10.0;

        $obj = new \stdClass();
        $obj->test = 10.0;

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Integer(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath'=>'test'
        ]));

        $this->assertGreaterThanOrEqual(10.0, $num);

        $obj = new \stdClass();
        $obj->test = 10.0;

        $fieldMetadata = new FieldMetadata(
            $obj,
            new \ReflectionProperty($obj, 'test'),
            new Integer(),
            $this->createMock(AnnotationCollection::class),
            new FakeMockField()
        );

        $num = 11.0;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath'=>'test'
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

    }

}