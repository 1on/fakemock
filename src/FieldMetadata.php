<?php


namespace Er1z\FakeMock;


use Er1z\FakeMock\Annotations\AnnotationCollection;
use Er1z\FakeMock\Annotations\FakeMockField;
use phpDocumentor\Reflection\Type;

class FieldMetadata
{

    /**
     * @var object
     */
    public $object;
    /**
     * @var \ReflectionProperty
     */
    public $property;
    /**
     * @var Type
     */
    public $type;
    /**
     * @var AnnotationCollection
     */
    public $annotations;

    /**
     * @var FakeMockField
     */
    public $configuration;

    public function __construct(
        object $object, \ReflectionProperty $property, Type $type, AnnotationCollection $annotations, FakeMockField $configuration
    )
    {
        $this->object = $object;
        $this->property = $property;
        $this->type = $type;
        $this->annotations = $annotations;
        // todo: fetching from annotations collection?
        $this->configuration = $configuration;
    }

}