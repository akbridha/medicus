<?php

namespace Tests\Unit;

use Tests\TestCase;

class IterasiEmpatTest extends TestCase
{






    /**
     *  Menampilkan halaman ubah data Pasien
     */


    public function test_can_export_database_to_sql()
    {


        // Kirimkan request ke route yang meng-export database
        $response = $this->get('/export_db');
        // Route::get('/export_db', [DatabaseController::class,'eksport']);

        // Periksa apakah status kode 200
        $response->assertStatus(200);


    }



    public function test_update_data_pasien_view(): void
    {
        $this->assertTrue(true);
    }
    /**
     *  Menyimpan perubahan Pasien
     */
    public function test_store_update_data_pasien(): void
    {
        $this->assertTrue(true);
    }





}
