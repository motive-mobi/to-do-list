<?php

namespace Tests\Unit;

use Tests\TestCase;

use App\Models\Task;

class TaskTest extends TestCase
{
    /**
     * Get all tasks test.
     */
    public function test_get_all_tasks(): void
    {
        $task = Task::create([
            'title'     => 'Get All Test Task',
            'completed' => 0,
        ]);

        $response = $this->get('/api/tasks');
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'tasks' => [
                        '*' => [
                            'id',
                            'title',
                            'completed',
                            'created_at',
                            'updated_at',
                        ],
                    ],
                ]);
    }

    /**
     * Store task test.
     */
    public function test_store_task(): void
    {
        $response = $this->post('/api/tasks', [
            'title'     => 'Store Test Task',
            'completed' => 0,
        ]);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'task' => [
                        'id',
                        'title',
                        'completed',
                        'created_at',
                        'updated_at',
                    ],
                ]);
    }

    /**
     * Store task fail test.
     */
    public function test_store_task_fail(): void
    {
        $response = $this->post('/api/tasks', [
            'title'     => '',
            'completed' => 0,
        ]);
        $response->assertStatus(422)
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'title' => [
                            'The title field is required.',
                        ]
                ]])
                ->assertJsonStructure([
                    'message',
                    'errors',
                ]);
    }

    /**
     * Update task test.
     */
    public function test_update_task(): void
    {
        $task = Task::create([
            'title'     => 'Update Test Task',
            'completed' => 0,
        ]);
        $response = $this->put('/api/tasks/' . $task->id, [
            'title'     => 'Updated Task',
            'completed' => 1,
        ]);
        $response->assertStatus(200)
                ->assertJsonStructure([
                    'task' => [
                        'id',
                        'title',
                        'completed',
                        'created_at',
                        'updated_at',
                    ],
                ]);
    }

    /**
     * Update task fail test.
     */
    public function test_update_task_fail(): void
    {
        $task = Task::create([
            'title'     => 'Update Fail Test Task',
            'completed' => 0,
        ]);
        $response = $this->put('/api/tasks/' . $task->id, [
            'title'     => '',
            'completed' => 1,
        ]);
        $response->assertStatus(422)
                ->assertJson([
                    'message' => 'The given data was invalid.',
                    'errors' => [
                        'title' => [
                            'The title field is required.',
                        ]
                ]])
                ->assertJsonStructure([
                    'message',
                    'errors',
                ]);
    }

    /**
     * Delete task test.
     */
    public function test_delete_task(): void
    {
        $task = Task::create([
            'title'     => 'Delete Test Task',
            'completed' => 0,
        ]);
        $response = $this->delete('/api/tasks/' . $task->id);
        $response->assertStatus(200);
    }
}
