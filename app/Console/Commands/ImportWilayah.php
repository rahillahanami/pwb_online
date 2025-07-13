<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\SimpleExcel\SimpleExcelReader;
use App\Models\Provinsi;
use App\Models\Kabupaten;

class ImportWilayah extends Command
{
    protected $signature = 'import:wilayah';

    protected $description = 'Import provinsi dan kabupaten dari file Excel fix';

    public function handle()
    {
        $filePath = storage_path('app/provinsi_kabupaten_clean_fixed.xlsx');

        if (!file_exists($filePath)) {
            $this->error("File tidak ditemukan di: $filePath");
            return;
        }

        $this->info('Memulai import dari file fix...');

        $rows = SimpleExcelReader::create($filePath)->getRows();
        $count = 0;

        foreach ($rows as $row) {
            $namaProvinsi = trim($row['Provinsi'] ?? '');
            $namaKabupaten = trim($row['Kabupaten/Kota'] ?? '');

            if (!$namaProvinsi || !$namaKabupaten) {
                continue;
            }

            // Cegah duplikasi provinsi
            $provinsi = Provinsi::firstOrCreate(['nama' => $namaProvinsi]);

            // Tambahkan kabupaten/kota
            Kabupaten::firstOrCreate([
                'nama' => $namaKabupaten,
                'provinsi_id' => $provinsi->id,
            ]);

            $count++;
        }

        $this->info("Import selesai. Total baris berhasil diproses: $count");
    }
}
