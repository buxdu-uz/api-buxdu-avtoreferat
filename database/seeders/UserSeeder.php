<?php

namespace Database\Seeders;

use App\Domain\Universities\Models\University;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::updateOrCreate([
            'employee_id_number' => '3042311060',
        ],[
            'login' => '3042311060',
            'firstname' => 'BEHRUZBEK',
            'lastname' => 'SALIMOV',
            'surname' => 'SOBIROVICH',
            'password' => '3042311060'
        ]);
        UserProfile::updateOrCreate([
            'user_id' => $teacher->id,
        ],[
            'department_id' => 16,
            'university_id' => University::query()->where('code',304)->first()->id,
        ]);

        $teacher2 = User::updateOrCreate([
            'employee_id_number' => '3042311059',
        ],[
            'login' => '3042311059',
            'firstname' => 'ISTAMOV',
            'lastname' => 'BEXZOD',
            'surname' => 'BAFOQULLOVICH',
            'password' => '3042311059'
        ]);
        UserProfile::updateOrCreate([
            'user_id' => $teacher2->id,
        ],[
            'department_id' => 16,
            'university_id' => University::query()->where('code',304)->first()->id,
        ]);

        $teacher2->assignRole('teacher');
    }
}
