<?php

namespace Tests\Er1z\FakeMock\Decorator\AssertDecorator;

use Er1z\FakeMock\Annotations\AnnotationCollection;
use Er1z\FakeMock\Annotations\FakeMock;
use Er1z\FakeMock\Annotations\FakeMockField;
use Er1z\FakeMock\Decorator\AssertDecorator\GreaterThanOrEqual;
use Er1z\FakeMock\Metadata\FieldMetadata;
use phpDocumentor\Reflection\Types\Float_;
use phpDocumentor\Reflection\Types\Integer;
use PHPUnit\Framework\TestCase;
use Tests\Er1z\FakeMock\AssertsTestTrait;

class GreaterThanOrEqualTest extends TestCase
{
    use AssertsTestTrait;

    public function testWithoutNumericValue()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 'asdasd';
        $this->expectException(\InvalidArgumentException::class);

        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value' => 10,
        ]));
    }

    public function testWithoutPropertyNumericValue()
    {
        $obj = new \stdClass();
        $obj->test = ['asd'];

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Float_();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $num = 10.01;

        $decorator = new GreaterThanOrEqual();

        $this->expectException(\InvalidArgumentException::class);

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath' => 'test',
        ]));
    }

    public function testScalarValueInt()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10;

        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value' => 10,
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $num = 9;
        $decorator->decorate($num, $this->createMock(FieldMetadata::class), new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value' => 10,
        ]));

        $this->assertGreaterThanOrEqual(10, $num);
    }

    public function testScalarValueFloat()
    {
        $decorator = new GreaterThanOrEqual();

        $obj = new \stdClass();
        $obj->test = null;

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Float_();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $num = 10.01;

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value' => 10.01,
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $num = 9.9;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'value' => 10.01,
        ]));

        $this->assertGreaterThanOrEqual(10.01, $num);
    }

    public function testPropertyPathInt()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10;

        $obj = new \stdClass();
        $obj->test = 10;

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Integer();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath' => 'test',
        ]));

        $this->assertGreaterThanOrEqual(10, $num);

        $obj = new \stdClass();
        $obj->test = 10;

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Integer();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $num = 9;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath' => 'test',
        ]));

        $this->assertGreaterThanOrEqual(10, $num);
    }

    public function testPropertyPathFloat()
    {
        $decorator = new GreaterThanOrEqual();

        $num = 10.01;

        $obj = new \stdClass();
        $obj->test = 10.01;

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Float_();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath' => 'test',
        ]));

        $this->assertGreaterThanOrEqual(10.01, $num);

        $obj = new \stdClass();
        $obj->test = 10.01;

        $fieldMetadata = new FieldMetadata();
        $fieldMetadata->object = $obj;
        $fieldMetadata->property = new \ReflectionProperty($obj, 'test');
        $fieldMetadata->type = new Float_();
        $fieldMetadata->annotations = $this->createMock(AnnotationCollection::class);
        $fieldMetadata->configuration = new FakeMockField();
        $fieldMetadata->objectConfiguration = new FakeMock();

        $num = 9.01;
        $decorator->decorate($num, $fieldMetadata, new \Symfony\Component\Validator\Constraints\GreaterThanOrEqual([
            'propertyPath' => 'test',
        ]));

        $this->assertGreaterThanOrEqual(10.01, $num);
    }
}
