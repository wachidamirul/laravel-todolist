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
}
