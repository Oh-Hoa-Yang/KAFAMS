<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            [
                'subjectName' => 'Matapelajaran Adab',
                'subjectExamDate' => '2024-04-16',
            ],
            [
                'subjectName' => 'Matapelajaran Aqidah',
                'subjectExamDate' => '2024-04-17',
            ],
            [
                'subjectName' => 'Matapelajaran Sirah',
                'subjectExamDate' => '2024-04-18',
            ],
            [
                'subjectName' => 'Matapelajaran Al-Quran',
                'subjectExamDate' => '2024-04-18',
            ],
            [
                'subjectName' => 'Matapelajaran Akhlak',
                'subjectExamDate' => '2024-04-19',
            ],
        ];

        foreach ($subjects as $subject) {
            DB::table('subjects')->insert($subject);
        }
    }
}
