<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample tasks data
        $tasks = [
            [
                'user_id' => 1, // Adjust according to your user setup
                'description' => 'Finish the report for the project.',
                'due_date' => Carbon::now()->addDays(3),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Schedule the meeting with the client.',
                'due_date' => Carbon::now()->addDays(5),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Prepare the presentation slides.',
                'due_date' => Carbon::now()->addDays(2),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Review the budget for next quarter.',
                'due_date' => Carbon::now()->addDays(10),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Conduct a performance review for team members.',
                'due_date' => Carbon::now()->addDays(7),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Follow up with the supplier about the order.',
                'due_date' => Carbon::now()->addDays(4),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Update the project timeline.',
                'due_date' => Carbon::now()->addDays(6),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Draft the newsletter for the month.',
                'due_date' => Carbon::now()->addDays(12),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Research new marketing strategies.',
                'due_date' => Carbon::now()->addDays(9),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'description' => 'Organize the team-building event.',
                'due_date' => Carbon::now()->addDays(14),
                'is_completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert the tasks into the database
        DB::table('tasks')->insert($tasks);
    }
    }


