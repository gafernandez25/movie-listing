<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Entities\User;
use App\Redirect;
use App\Services\AuthService;
use App\Services\PasswordService;
use App\Services\UserService;
use Exception;
use PHPUnit\Framework\TestCase;

class AuthServiceTest extends TestCase
{
    public function testAuthenticate()
    {
        $mockUserService = $this->createMock(UserService::class);
        $mockUserService->method("getByUsername")
            ->willReturn(
                new User(
                    "fakeuser",
                    "+123456789",
                    "fake@email.com",
                    (new PasswordService())->hashPassword("fakePass")
                )
            );

        $mockRedirect = $this->createMock(Redirect::class);

        $authService = new AuthService(
            $mockUserService,
            new PasswordService(),
            $mockRedirect
        );

        $this->assertInstanceOf(
            User::class,
            $authService->authenticate("fakeUser", "fakePass")
        );
    }

    public function testAuthenticateWrongPassword()
    {
        $mockUserService = $this->createMock(UserService::class);
        $mockUserService->method("getByUsername")
            ->willReturn(
                new User(
                    "fakeuser",
                    "+123456789",
                    "fake@email.com",
                    (new PasswordService())->hashPassword("fakePass")
                )
            );

        $mockRedirect = $this->createMock(Redirect::class);
        //Exception instead of redirect
        $mockRedirect->method("backWithInput")->will(
            $this->throwException(new \Exception("Mock false response"))
        );

        $authService = new AuthService(
            $mockUserService,
            new PasswordService(),
//            $mockRedirect
        );

        $this->expectException(Exception::class);
//        $this->expectErrorMessage("Mock false response");
        $authService->authenticate("fakeUser", "wrongPass");
    }

    public function testAuthenticateWrongUsername()
    {
        $mockUserService = $this->createMock(UserService::class);
        //Method returns null when user does not exist
        $mockUserService->method("getByUsername")
            ->willReturn(null);

        $mockRedirect = $this->createMock(Redirect::class);
        //Exception instead of redirect
        $mockRedirect->method("backWithInput")->will(
            $this->throwException(new \Exception("Mock false response"))
        );

        $authService = new AuthService(
            $mockUserService,
            new PasswordService(),
            $mockRedirect
        );

        $this->expectException(Exception::class);
        $this->expectErrorMessage("Mock false response");
        $authService->authenticate("wrongUser", "fakePass");
    }
}