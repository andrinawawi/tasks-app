<?php

namespace App\Services;

use App\Models\{User, Task};
use Illuminate\Support\Facades\DB;

class DeleteUser
{
    private static function deleteTasks(int $user_id)
    {
        $tasks = Task::query()
            ->where('user_id', $user_id)->get();


        if ($tasks->isNotEmpty()) {
            DB::transaction(function () use ($tasks, $user_id) {
                foreach ($tasks as $task) {
                    Task::destroy($task->id);
                }
            });
        }
    }

    public static function delete(int $user_id)
    {
        self::deleteTasks($user_id);
        User::destroy($user_id);
    }
}
