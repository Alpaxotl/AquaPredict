<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pond;
use App\Models\WaterLog;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin AquaPredict',
            'email' => 'admin@aquapredict.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Petani User
        $petani = User::create([
            'name' => 'Pak Joko (Petani)',
            'email' => 'joko@aquapredict.com',
            'password' => Hash::make('password'),
            'role' => 'petani',
        ]);

        // Create Ponds
        $pond1 = Pond::create([
            'name' => 'Kolam Nila A1',
            'commodity' => 'Nila Merah',
            'location' => 'Sektor Utara',
        ]);

        $pond2 = Pond::create([
            'name' => 'Kolam Gurame B2',
            'commodity' => 'Gurame',
            'location' => 'Sektor Selatan',
        ]);

        $pond3 = Pond::create([
            'name' => 'Kolam Patin C3',
            'commodity' => 'Patin',
            'location' => 'Sektor Timur',
        ]);

        $pond4 = Pond::create([
            'name' => 'Bioflok Lele D4',
            'commodity' => 'Lele Bioflok',
            'location' => 'Sektor Barat',
        ]);

        // Create Sample Water Logs
        WaterLog::create([
            'pond_id' => $pond1->id,
            'ph' => 7.20,
            'temperature' => 27.50,
            'dissolved_oxygen' => 5.20,
            'status' => 'Optimal',
            'recommendation' => 'Kondisi air optimal untuk budidaya Nila Merah. Pertahankan sirkulasi air berjalan normal.',
            'recorded_by' => $petani->id,
            'created_at' => now()->subDays(2),
        ]);

        WaterLog::create([
            'pond_id' => $pond2->id,
            'ph' => 6.00,
            'temperature' => 26.00,
            'dissolved_oxygen' => 4.10,
            'status' => 'Atensi',
            'recommendation' => 'Tingkat pH agak asam (6.00) untuk Gurame. Disarankan menambahkan kapur dolomit dosis ringan (~10g/m3) untuk menaikkan alkalinitas.',
            'recorded_by' => $petani->id,
            'created_at' => now()->subDay(),
        ]);

        WaterLog::create([
            'pond_id' => $pond3->id,
            'ph' => 7.50,
            'temperature' => 33.00,
            'dissolved_oxygen' => 2.50,
            'status' => 'Kritis',
            'recommendation' => 'Kadar Oksigen Terlarut kritis (2.50 mg/L) & Suhu terlalu tinggi (33.00°C) untuk Patin. Aktifkan aerator darurat segera dan tambahkan air bersih dingin secara berkala.',
            'recorded_by' => $admin->id,
            'created_at' => now(),
        ]);
    }
}
