<?php

use Illuminate\Database\Seeder;
use App\Task;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        factory(Task::class,30)->create(


        );
    }
}
