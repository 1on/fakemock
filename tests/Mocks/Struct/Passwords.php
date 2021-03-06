<?php

namespace Tests\Er1z\FakeMock\Mocks\Struct;

use Er1z\FakeMock\Annotations\FakeMock;
use Er1z\FakeMock\Annotations\FakeMockField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @FakeMock()
 */
class Passwords
{
    /**
     * @var string
     * @FakeMockField()
     */
    public $password;

    /**
     * @Assert\EqualTo(propertyPath="password")
     *
     * @var string
     * @FakeMockField()
     */
    public $passwordConfirm;
}
