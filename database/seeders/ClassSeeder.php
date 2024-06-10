<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    public function run(): void //Seeds data into classes table
  {
    $classes = [
      [
        'studentID' => '100',
        'className' => 'CLASS 1',
        'studentName' => 'NURUL ATHIRAH',
      ],
      [
        'studentID' => '101',
        'className' => 'CLASS 1',
        'studentName' => 'NURUL AFIQAH',
      ],
      [
        'studentID' => '102',
        'className' => 'CLASS 1',
        'studentName' => 'MUHAMMAD AIDIL',
      ],
      [
        'studentID' => '103',
        'className' => 'CLASS 1',
        'studentName' => 'MUHAMMAD AIMAN',
      ],
      [
        'studentID' => '104',
        'className' => 'CLASS 1',
        'studentName' => 'NUR QISTINA',
      ],
      [
        'studentID' => '105',
        'className' => 'CLASS 2',
        'studentName' => 'HAZIQ NAZLI',
      ],
      [
        'studentID' => '106',
        'className' => 'CLASS 2',
        'studentName' => 'FAISAL HALIM',
      ],
      [
        'studentID' => '107',
        'className' => 'CLASS 2',
        'studentName' => 'AKHYAR RASHID',
      ],
      [
        'studentID' => '108',
        'className' => 'CLASS 2',
        'studentName' => 'NUR MAISARAH',
      ],
      [
        'studentID' => '109',
        'className' => 'CLASS 2',
        'studentName' => 'MUHAMMAD ISKANDAR',
      ],
      [
        'studentID' => '110',
        'className' => 'CLASS 3',
        'studentName' => 'NURUL AYESHA',
      ],
      [
        'studentID' => '111',
        'className' => 'CLASS 4',
        'studentName' => 'MUHAMMAD ZAMIR',
      ],
      [
        'studentID' => '112',
        'className' => 'CLASS 5',
        'studentName' => 'ARIF AIMAN',
      ],
    ];

    foreach ($classes as $classes) {
      DB::table('classes')->insert($classes);
    }
  }
}
