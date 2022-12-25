<?php

declare(strict_types=1);

namespace DalliSDK\Test\Unit\Models;

use DalliSDK\Models\Auth;
use DalliSDK\Requests\CreateBasketRequest;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    public function testConstruct()
    {
        $auth = new Auth('123456789');
        $this->assertSame('123456789', $auth->getToken());
    }

    public function testSetAuth()
    {
        $request = new CreateBasketRequest();
        $request->setAuth('123456789');
        $this->assertSame('123456789', $request->getAuth()->getToken());
    }
}
