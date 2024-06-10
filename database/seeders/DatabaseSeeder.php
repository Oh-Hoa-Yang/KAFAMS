<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([       //add other seeders here!
      UserSeeder::class,
      ClassSeeder::class,
      SubjectSeeder::class,
    ]);
    $this->activitySeeder();
  }

  public function activitySeeder() //Seeds data into Activities table, more than 8 to test pagination function
  {
    $datas = [
      [
        'activityName' => 'Perhimpunan Besar 2024',
        'activityDetails' => 'Perhimpunan sambutan 2024',
        'location' => 'Dewan Besar',
        'activityDate' => '2024-05-22',
        'startTime' => '13:00:00',
        'endTime' => '16:00:00',
      ],
      [
        'activityName' => 'Kem KAFA 2024',
        'activityDetails' => 'Kem latihan KFA 2024 untuk pelajar-pelajar',
        'location' => 'Hutan Pekan',
        'activityDate' => '2024-06-10',
        'startTime' => '08:00:00',
        'endTime' => '18:00:00',
      ],
      [
        'activityName' => 'Majlis Berbuka Puasa 2024',
        'activityDetails' => 'Majlis berbuka puasa bersama pelajar dan guru KAFA',
        'location' => 'Dewan Makan',
        'activityDate' => '2024-06-20',
        'startTime' => '18:30:00',
        'endTime' => '20:00:00',
      ],
      [
        'activityName' => 'Majlis Khatam Quran 2024',
        'activityDetails' => 'Majlis khatam Quran oleh pelajar-pelajar',
        'location' => 'Surau',
        'activityDate' => '2024-07-05',
        'startTime' => '09:00:00',
        'endTime' => '11:00:00',
      ],
      [
        'activityName' => 'Kursus Asas Sukan 2024',
        'activityDetails' => 'Kursus asas sukan untuk pelajar-pelajar',
        'location' => 'Padang Sukan',
        'activityDate' => '2024-07-15',
        'startTime' => '14:00:00',
        'endTime' => '17:00:00',
      ],
      [
        'activityName' => 'Lawatan Ke Kilang Coklat',
        'activityDetails' => 'Lawatan ke kilang coklat bagi pelajar-pelajar 2024',
        'location' => 'Kilang Coklat, Bandar Seri Putra',
        'activityDate' => '2024-08-02',
        'startTime' => '10:00:00',
        'endTime' => '12:00:00',
      ],
      [
        'activityName' => 'Persembahan Teater 2024',
        'activityDetails' => 'Persembahan teater oleh pelajar-pelajar',
        'location' => 'Dewan Serbaguna',
        'activityDate' => '2024-08-20',
        'startTime' => '19:30:00',
        'endTime' => '21:30:00',
      ],
      [
        'activityName' => 'Karnival Sukan 2024',
        'activityDetails' => 'Karnival sukan yang melibatkan perniagaan skala kecil',
        'location' => 'Padang Sukan',
        'activityDate' => '2024-09-10',
        'startTime' => '08:00:00',
        'endTime' => '17:00:00',
      ],
      [
        'activityName' => 'Majlis Hari Raya 2024',
        'activityDetails' => 'Majlis sambutan Hari Raya bersama pelajar dan guru KFA 2024',
        'location' => 'Dewan Makan',
        'activityDate' => '2024-09-25',
        'startTime' => '18:00:00',
        'endTime' => '22:00:00',
      ],
      [
        'activityName' => 'Lawatan Ke Zoo Negara',
        'activityDetails' => 'Lawatan ke Zoo Negara bagi pelajar-pelajar',
        'location' => 'Zoo Negara, Kuala Lumpur',
        'activityDate' => '2024-10-10',
        'startTime' => '09:00:00',
        'endTime' => '15:00:00',
      ],
    ];

    foreach ($datas as $data) {
      DB::table('activities')->insert($data);
    }
  }
}
