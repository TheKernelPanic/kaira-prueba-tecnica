<?php

namespace Tests\Unit\Utils;

use App\Utils\TokenValidator;
use Tests\TestCase;

class TokenValidatorTest extends TestCase
{
    /**
     * @return void
     */
    public function test_valid_token(): void
    {
        $this->assertTrue(
            (new TokenValidator('[]{}()'))->isValid()
        );

        $this->assertTrue(
            (new TokenValidator('{{}}()()((()))'))->isValid()
        );

        $this->assertTrue(
            (new TokenValidator('[]{{}{}}()'))->isValid()
        );

        $this->assertTrue(
            (new TokenValidator('[][[]]{{}{}}()'))->isValid()
        );

        $this->assertTrue(
            (new TokenValidator('([][[]]{{}{}}((())))'))->isValid()
        );
    }

    /**
     * @return void
     */
    public function test_invalid_token(): void
    {
        $this->assertFalse(
            (new TokenValidator('[]{}()))'))->isValid()
        );

        $this->assertFalse(
            (new TokenValidator('[[}}'))->isValid()
        );

        $this->assertFalse(
            (new TokenValidator('[][][][['))->isValid()
        );

        $this->assertFalse(
            (new TokenValidator('{}}((})'))->isValid()
        );

        $this->assertFalse(
            (new TokenValidator('[][][]{}{}))))'))->isValid()
        );

        $this->assertFalse(
            (new TokenValidator('[]{}[]][[['))->isValid()
        );
    }
}
