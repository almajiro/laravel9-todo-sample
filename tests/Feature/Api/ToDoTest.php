<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ToDo;
use Tests\TestCase;

class ToDoTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAll()
    {
        ToDo::factory()->count(3)->create();

        $response = $this->get('/api/todo');
        $response->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('total', $response);
        $this->assertArrayHasKey('todos', $response);

        $this->assertEquals(3, $response['total']);
    }

    public function testGet()
    {
        ToDo::factory()->count(1)->create();

        $response = $this->get('/api/todo/1');
        $response->assertStatus(200);

        $response = json_decode($response->getContent(), true);

        $this->assertEquals(1, $response['id']);
    }

    public function testCreate()
    {
        $response = $this->postJson(
            '/api/todo',
            [
                'todo' => 'Test ToDo',
                'tags' => [
                    'sample',
                    'testing'
                ]
            ]
        );

        $response->assertStatus(200);
        $this->assertInstanceOf(ToDo::class, ToDo::find(1));
    }

    public function testUpdate()
    {
        ToDo::factory()->create(['id' => 1]);

        $response = $this->putJson(
            '/api/todo/1',
            [
                'todo' => 'UPDATE',
                'tags' => [
                    'sample',
                    'testing'
                ]
            ]
        );

        $response->assertStatus(200);

        $toDo = ToDo::find(1);
        $this->assertEquals('UPDATE', $toDo->todo);
    }

    public function testDelete()
    {
        ToDo::factory()->create(['id' => 1]);

        $response = $this->delete('/api/todo/1');
        $response->assertStatus(200);

        $this->assertNull(ToDo::find(1));
    }
}
