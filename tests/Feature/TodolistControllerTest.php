<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
	public function testTodolist()
	{
		$this->withSession([
			"user" => "Joko",
			"todolist" => [
				[
					"id" => "1",
					"todo" => "Budi"
				],
				[
					"id" => "2",
					"todo" => "Doremi"
				]
			]
		])->get('/todolist')
			->assertSeeText("1")->assertSeeText("Budi")
			->assertSeeText("2")->assertSeeText("Doremi");
	}

	public function testAddTodoFailed()
	{
		$this->withSession([
			"user" => "aztrea"
		])->post("/todolist", [])->assertSeeText("Todo is required");
	}

	public function testAddTodoSuccess()
	{
		$this->withSession([
			"user" => "joko"
		])->post("/todolist", [
			"todo" => "aztrea"
		])->assertRedirect("/todolist");
	}
}
