<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JobVacancy;

class JobVacancySeeder extends Seeder
{
    public function run()
    {
        $jobs = [
            [
                'title' => 'Operator Alat Berat',
                'division' => 'Produksi',
                'description' => 'Mengoperasikan alat berat tambang.',
                'requirements' => "1. Pria, usia maks 35 tahun\n2. Pendidikan minimal SMA/SMK\n3. Memiliki SIM B2\n4. Pengalaman minimal 2 tahun",
                'prospects' => 'Karir sebagai Supervisor Tambang.',
                'quota' => 5,
                'status' => 'open',
                'is_open' => true,
            ],
            [
                'title' => 'Mekanik Tambang',
                'division' => 'Maintenance',
                'description' => 'Perawatan alat berat tambang.',
                'requirements' => "1. Pria, usia maks 40 tahun\n2. SMK Teknik Mesin/Otomotif\n3. Menguasai perbaikan mesin diesel\n4. Bersedia ditempatkan di site",
                'prospects' => 'Karir sebagai Supervisor Maintenance.',
                'quota' => 3,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Staff HRD',
                'division' => 'Human Resource',
                'description' => 'Administrasi karyawan dan rekrutmen.',
                'requirements' => "1. Pria/Wanita, usia maks 30 tahun\n2. S1 Psikologi / Manajemen SDM\n3. Mahir menggunakan Microsoft Excel\n4. Memahami UU Ketenagakerjaan",
                'prospects' => 'Karir sebagai HR Manager.',
                'quota' => 2,
                'status' => 'open',
                'is_open' => true,
            ],
            [
                'title' => 'Safety Officer (K3)',
                'division' => 'HSE',
                'description' => 'Pengawasan keselamatan kerja.',
                'requirements' => "1. D3/S1 Kesehatan Masyarakat / Teknik\n2. Memiliki sertifikat Ahli K3 Umum\n3. Pengalaman 1 tahun di tambang",
                'prospects' => 'Karir sebagai HSE Manager.',
                'quota' => 2,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Driver Dump Truck',
                'division' => 'Produksi',
                'description' => 'Mengemudikan dump truck tambang.',
                'requirements' => "1. Pria, usia maks 35 tahun\n2. Memiliki SIM B2 Umum\n3. Pengalaman minimal 1 tahun",
                'prospects' => 'Karir sebagai Team Leader Produksi.',
                'quota' => 10,
                'status' => 'open',
                'is_open' => true,
            ],
            [
                'title' => 'Geologist',
                'division' => 'Eksplorasi',
                'description' => 'Pemetaan dan analisis geologi tambang.',
                'requirements' => "1. S1 Teknik Geologi\n2. Pengalaman minimal 3 tahun\n3. Menguasai software pemetaan",
                'prospects' => 'Karir sebagai Chief Geologist.',
                'quota' => 1,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Admin Logistik',
                'division' => 'Supply Chain',
                'description' => 'Pencatatan keluar masuk barang.',
                'requirements' => "1. D3/S1 Administrasi\n2. Teliti dan detail\n3. Mahir Excel & sistem inventori",
                'prospects' => 'Karir sebagai Staff Ahli Logistik.',
                'quota' => 2,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Teknisi Listrik',
                'division' => 'Engineering',
                'description' => 'Perawatan panel listrik dan genset.',
                'requirements' => "1. SMK/D3 Teknik Listrik\n2. Memahami panel kontrol & genset\n3. Pengalaman 2 tahun",
                'prospects' => 'Karir sebagai Supervisor Elektrikal.',
                'quota' => 2,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Surveyor',
                'division' => 'Engineering',
                'description' => 'Pengukuran area tambang.',
                'requirements' => "1. D3/S1 Geodesi\n2. Mahir Total Station & GPS Geodetik\n3. Pengalaman 1 tahun",
                'prospects' => 'Karir sebagai Survey Manager.',
                'quota' => 2,
                'status' => 'open',
                'is_open' => false,
            ],
            [
                'title' => 'Staff Finance',
                'division' => 'Finance',
                'description' => 'Pembukuan dan administrasi keuangan.',
                'requirements' => "1. S1 Akuntansi\n2. Pengalaman 1 tahun\n3. Mahir menggunakan Accurate / SAP",
                'prospects' => 'Karir sebagai Finance Manager.',
                'quota' => 1,
                'status' => 'open',
                'is_open' => false,
            ],
        ];

        foreach ($jobs as $job) {
            JobVacancy::create($job);
        }
    }
}