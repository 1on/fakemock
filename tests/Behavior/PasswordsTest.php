<?php

namespace Tests\Er1z\FakeMock\Behavior;

use Er1z\FakeMock\FakeMock;
use PHPUnit\Framework\TestCase;
use Tests\Er1z\FakeMock\AssertsTestTrait;
use Tests\Er1z\FakeMock\Mocks\Struct\Passwords;

class PasswordsTest extends TestCase
{
    use AssertsTestTrait;

    public function testPasswords()
    {
        $f = new FakeMock();
        $obj = new Passwords();

        $f->fill($obj);

        $this->assertInternalType('string', $obj->password);
        $this->assertEquals($obj->password, $obj->passwordConfirm);
    }
}
