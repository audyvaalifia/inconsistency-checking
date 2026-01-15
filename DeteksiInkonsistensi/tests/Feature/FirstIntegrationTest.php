<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Facades\SWRequirementFacade;


use App\Http\Controllers\HomeControl; // Ganti ini
use App\Models\SWRequirement;
use Mockery;

class FirstIntegrationTest extends TestCase
{
    use WithoutMiddleware; 


    public function test_normalizeSentenceJalur1()
    {
        // Kalimat uji
        $inputSentence = 'The system shall be able to slap a patient virtually while they are asleep';

        $csvPath = storage_path('app/kalimatNormal.csv');
        if (file_exists($csvPath)) {
            unlink($csvPath);
        }

        $response = $this->postJson(route('normalisasi.nlp'), [
            'sentence' => $inputSentence
        ]);
        // dump('Status code:', $response->status());
        echo "Status code: " . $response->getStatusCode() . "\n";
        echo "Response JSON:\n";
        print_r($response->json());
        dump('Response JSON:', $response->json());

        if ($response->getStatusCode() !== 200) {
            dump($response->json());
        }

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Data berhasil diproses dan disimpan'
        ]);

        $this->assertFileExists($csvPath);

        $content = file_get_contents($csvPath);
        $this->assertStringContainsString('No,Kalimat', $content);
    }

    public function test_normalizeSentenceJalur2()
    {
        // Kalimat kosong
        $inputSentence = '';

        $response = $this->postJson(route('normalisasi.nlp'), [
            'sentence' => $inputSentence
        ]);
        echo "Status code: " . $response->getStatusCode() . "\n";
        echo "Response JSON:\n";
        print_r($response->json());
        dump('Response JSON:', $response->json());

        if ($response->getStatusCode() !== 400) {
            dump($response->json());
        }

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'Input kalimat kosong'
        ]);
    }


    // UNCOMMENT SEMUA KODE DIBAWAH INI UNTUK BISA JALANIN KODE DI ATAS
// protected bool $mockWriteNLPresult = false;

// protected function setUp(): void
// {
//     parent::setUp();

//     if ($this->mockWriteNLPresult) {
//         Mockery::mock('alias:' . SWRequirement::class)
//             ->shouldReceive('writeNLPresult')
//             ->andReturn(false);
//     }
// }

//     public function tearDown(): void
// {
//     Mockery::close();
//     parent::tearDown();
// }

// public function test_normalizeSentenceJalur3()
// {
//     // Mock hanya untuk test ini
//     Mockery::mock('alias:' . SWRequirement::class)
//         ->shouldReceive('writeNLPresult')
//         ->andReturn(false);

//     $response = $this->postJson(route('normalisasi.nlp'), [
//         'sentence' => 'The system shall be able to slap a psychologist virtually while they are asleep',
//     ]);

//     echo "Status code: " . $response->getStatusCode() . "\n";
//     echo "Response JSON:\n";
//     print_r($response->json());
//     $this->assertEquals(500, $response->status());
//     $this->assertEquals('Gagal menyimpan CSV', $response['message']);
// }


    // public function test_gagal_shell_exec_null()
    // {
    //     $this->mock(YourControllerName::class, function ($mock) {
    //         $mock->makePartial()
    //             ->shouldReceive('shellExec')
    //             ->andReturn(null);
    //     });

    //     $response = $this->postJson(route('normalisasi.nlp'), [
    //         'sentence' => 'Test gagal'
    //     ]);

    //     $response->dump();
    //     $this->assertEquals(500, $response->status());
    //     $this->assertEquals('Gagal menjalankan NLP', $response['message']);
    // }

    // public function test_invalid_json_output()
    // {
    //     $this->mock(YourControllerName::class, function ($mock) {
    //         $mock->makePartial()
    //             ->shouldReceive('shellExec')
    //             ->andReturn("INI BUKAN JSON");
    //     });

    //     $response = $this->postJson(route('normalisasi.nlp'), [
    //         'sentence' => 'Test JSON fail'
    //     ]);

    //     $response->dump();
    //     $this->assertEquals(500, $response->status());
    //     $this->assertEquals('Gagal menyimpan CSV', $response['message']);
    // }

    


// public function test_normalizeSentenceJalur2()
//     {
//         $inputSentence = '';

//         $response = $this->postJson(route('normalisasi.nlp'), [
//             'sentence' => $inputSentence
//         ]);
//         dump('Status code:', $response->status());
//         dump('Response JSON:', $response->json());

//         if ($response->getStatusCode() !== 400) {
//             dump($response->json());
//         }

//         $response->assertStatus(400);
//         $response->assertJson([
//             'message' => 'Input kalimat kosong'
//         ]);
//     }






    



}









                                   //TEST CARI PSIKOLOG
// public function test_cari_psikologJalur1()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'namaPsikologTerm' => 'harimauxxx',
//     ];

//     $response = $this->postJson('/pasien/cari_psikolog', $data);
//     $response->dump();

//     $response->assertStatus(404);
//     $response->assertJson([
//         'message' => 'Data Psikolog tidak ditemukan'
//     ]);

//     dump($response->status());  
//     dump($response->getData()); 
    
// }

// public function test_cari_psikologJalur2()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'namaPsikologTerm' => 'eka alicia',
//     ];

//     $response = $this->postJson('/pasien/cari_psikolog', $data);
//     $response->dump();

//     $response->assertStatus(200);
//     $response->assertJson([
//         'message' => 'Data Psikolog ditemukan'
//     ]);

//     dump($response->status());  
//     dump($response->getData()); 
    
// }













//                          //TEST BUAT JADWAL!!!!!

//     public function test_tambahJalur1()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-22',
//         'jam_konseling' => '18:00:00',
//     ];

//     $response = $this->postJson('/pasien/tambah_jadwal', $data);
//     $response->dump();

//     $response->assertStatus(200);
//     $response->assertJson([
//         'message' => 'Berhasil membuat jadwal konseling'
//     ]);

//     dump($response->status());  
//     dump($response->getData()); 

//     // $response->assertSessionHas('success', 'Berhasil membuat jadwal konseling');

//     $this->assertDatabaseHas('jadwal_konselings', [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-22',
//         'jam_konseling' => '18:00:00',
//     ]);

//     $this->assertDatabaseHas('pembayarans', [
//         'qr' => '1231231',
//     ]);
// }

// public function test_tambahJalur2()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-22',
//         'jam_konseling' => '18:00:00',
//     ];

//     $response = $this->postJson('/pasien/tambah_jadwal', $data);
//     $response->dump();

//     $response->assertStatus(409);
//     $response->assertJson([
//         'message' => 'Jadwal telah terpakai'
//     ]);

//     $this->assertDatabaseHas('jadwal_konselings', [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-22',
//         'jam_konseling' => '18:00:00',
//     ]);

//     $this->assertDatabaseHas('pembayarans', [
//         'qr' => '1231231',
//     ]);
// }

// public function test_tambahJalur3()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         // 'tanggal_konseling' => '',
//         'jam_konseling' => '18:00:00',
//     ];

//     $response = $this->postJson('/pasien/tambah_jadwal', $data);
//     $response->dump();

//     $response->assertStatus(500);
//     $response->assertJson([
//         'message' => 'Gagal membuat jadwal'
//     ]);

//     $this->assertDatabaseMissing('jadwal_konselings', [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '',
//         'jam_konseling' => '18:00:00',
//     ]);
// }

// public function test_tambahJalur4()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-23',
//         // 'jam_konseling' => '',
//     ];

//     $response = $this->postJson('/pasien/tambah_jadwal', $data);
//     $response->dump();

//     $response->assertStatus(500);
//     $response->assertJson([
//         'message' => 'Gagal membuat jadwal'
//     ]);

//     $this->assertDatabaseMissing('jadwal_konselings', [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-07-23',
//         'jam_konseling' => '',
//     ]);
// }

// public function test_tambahJalur5()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-06-30',
//         'jam_konseling' => '18:00:00',
//     ];

//     $response = $this->postJson('/pasien/tambah_jadwal', $data);
//     $response->dump();

//     $response->assertStatus(422);
//     $response->assertJson([
//         'message' => 'Jadwal telah terlewat'
//     ]);

//     $this->assertDatabaseMissing('jadwal_konselings', [
//         'id_psikolog' => '36',
//         'id_pasien' => '25',
//         'tanggal_konseling' => '2024-06-30',
//         'jam_konseling' => '18:00:00',
//     ]);
// }




//                                   //TEST CHAT!!!
// public function test_broadcastJalur1()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_jadwal_konsultasi' => '97421281',
//         'username' => 'emma',
//         'message' => 'saya harus gimana',
//         'timestamp' => now(), 
//         'username_psikolog' => 'giyuu',
//         'nama_psikolog' => 'Giyuu',
//         'username_pasien' => 'emma',
//         'nama_pasien' => 'Emma',
//     ];

//     $response = $this->postJson('/pasien/chat/{id}/broadcast', $data);
//     $response->dump();

//     $response->assertStatus(200);
//     $response->assertJson([
//         'message' => 'Broadcast berhasil dikirim'
//     ]);

//     dump($response->status());  
//     dump($response->getData()); 


//     $this->assertDatabaseHas('chats', [
//         'id_jadwal_konsultasi' => '97421281',
//         'username' => 'emma',
//         'message' => 'saya harus gimana',
//         'created_at' => now(), 
//     ]);
// }

// public function test_broadcastJalur2()
// {
//     $this->withoutMiddleware();
//     $data = [
//         'id_jadwal_konsultasi' => '76635360',
//         'username' => 'emma',
//         'message' => '',
//         'timestamp' => now(), 
//         'username_psikolog' => 'giyuu',
//         'nama_psikolog' => 'Giyuu',
//         'username_pasien' => 'emma',
//         'nama_pasien' => 'Emma',
//     ];

//     $response = $this->postJson('/pasien/chat/{id}/broadcast', $data);
//     $response->dump();

//     $response->assertStatus(422);
//     $response->assertJson([
//         'error' => 'Kosong, Tulis chat terlebih dahulu'
//     ]);

//     dump($response->status());  
//     dump($response->getData()); 

//     $this->assertDatabaseMissing('chats', [
//         'id_jadwal_konsultasi' => '76635360',
//         'username' => 'emma',
//         'message' => '',
//         'created_at' => now(), 
//     ]);
// }

// }