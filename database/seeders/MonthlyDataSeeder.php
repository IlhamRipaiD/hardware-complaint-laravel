<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InsertModel;
use Carbon\Carbon;

class MonthlyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        // Loop through each day of the month
        while ($startDate->lte($endDate)) {
            // Generate dummy data
            $dummyData = [
                'user_id' => rand(1, 10), // Example random user_id from 1 to 10
                'unit_ruangan' => 'Unit ' . rand(1, 5), // Example random unit
                'nama' => 'Dummy Name',
                'media' => 'Media Type',
                'masalah' => 'Dummy Issue',
                'kategori' => 'Dummy Category',
                'isi_laporan' => 'Dummy Report',
                'foto' => 'dummy.jpg',
                'solusi' => 'Dummy Solution',
                'status' => 'Pending', // Example status
                'created_at' => $startDate,
                'updated_at' => $startDate,
            ];

            // Create a new InsertData instance and fill it with the dummy data
            InsertModel::create($dummyData);

            $startDate->addDay(); // Move to the next day
        }
    }
}
