<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
	public function testLoginPage()
	{
		$this->get('/login')->assertSeeText("Login");
	}

	public function testLoginPageForMember()
	{
		$this->withSession([
			"user" => "joko"
		])->get('/login')->assertRedirect("/");
	}

	public function testLoginSuccess()
	{
		$this->post('/login', [
			"user" => "joko",
			"password" => "05120512"
		])->assertRedirect("/")
			->assertSessionHas("user", "joko");
	}

	public function testLoginForUserAlreadyLogin()
	{
		$this->withSession([
			"user" => "joko"
		])->post('/login', [
			"user" => "joko",
			"password" => "05120512"
		])->assertRedirect("/");
	}

	public function testLoginValidationError()
	{
		$this->post("/login", [])
			->assertSeeText("User or password is required");
	}

	public function testLoginFailed()
	{
		$this->post('/login', [
			'user' => "wrong",
			"password" => "wrong"
		])->assertSeeText("User or password is wrong");
	}

	public function testLogout()
	{
		$this->withSession([
			"user" => "joko"
		])->post('/logout')->assertRedirect("/")
			->assertSessionMissing("user");
	}

	public function testLogoutGuest()
	{
		$this->post('/logout')->assertRedirect("/");
	}
}
