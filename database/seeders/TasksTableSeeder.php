<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->command->error('Nenhum usuário foi cadastrado no banco para gerar a seed de tarefas.');
            return;
        }

        for ($i = 1; $i <= 5; $i++) {
            Task::create([
                'title' => 'Task ' . $i,
                'description' => 'Description ' . $i,
                'date' => now()->addDays($i)->toDateString(),
                'time' => now()->addHours($i)->format('H:i:s'),
                'status' => 'PENDING',
                'user_id' => $users->random()->id,
            ]);
        }
    }
}
