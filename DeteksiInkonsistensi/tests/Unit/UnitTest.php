<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User; 
use App\Models\SWRequirement;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithoutEvents;


class UnitTest extends TestCase
{
    use WithoutMiddleware; 
    public function test_writeNLPresultJalur1()
    {
        $sentences = [
            "The system shall be able to update session logs every 15 minutes.",
            "The system shall be able to provide relaxation techniques from stored recommendations.",
            "The system shall be able to notify family members while detecting critical conditions.",
            "The system shall be able to generate periodic reports every 30 days."

        ];
        // KEADAAN CSV BELUM ADA
        $path = storage_path('app/kalimatNormal.csv');
        if (file_exists($path)) {
            unlink($path);
        }
    
        $result = SWRequirement::writeNLPresult($sentences);
    
        $this->assertTrue($result);
        $this->assertFileExists($path);
    
        $expectedContent = "No,Kalimat\n";
        foreach ($sentences as $index => $text) {
            $expectedContent .= ($index + 1) . ",\"" . trim($text) . "\"\n";
        }
    
        $actualContent = file_get_contents($path);
        echo "\nIsi CSV jalur 1:\n" . $actualContent;
        $this->assertEquals($expectedContent, $actualContent);
    }



    public function test_writeNLPresultJalur2()
    {
        $sentences = [
            "The system shall be able to process mood trend analysis every 24 hours.",
            "The system shall be able to provide relaxation techniques from stored recommendations.",
            "The system shall be able to notify family members while detecting critical conditions.",
            "The system shall be able to process mood assessments even while the user is inactive."

        ];
        // KEADAAN CSV SUDAH ADA DARI JALUR 1
        $path = storage_path('app/kalimatNormal.csv');
        if (file_exists($path)) {
            unlink($path);
        }
    
        $result = SWRequirement::writeNLPresult($sentences);
    
        $this->assertTrue($result);
        $this->assertFileExists($path);
    
        $expectedContent = "No,Kalimat\n";
        foreach ($sentences as $index => $text) {
            $expectedContent .= ($index + 1) . ",\"" . trim($text) . "\"\n";
        }
    
        $actualContent = file_get_contents($path);
        echo "\nIsi CSV jalur 2:\n" . $actualContent;
        $this->assertEquals($expectedContent, $actualContent);
    }



    public function test_writeNLPresultJalur3()
{
    // tes isi csv jikalau lebih dr 1 kalimat
    $sentences = [
        "The system shall be able to log failed authentication attempts while tracking security threats.", 
        "The system shall not provide AI-generated responses within 5 seconds",
        "The system shall not be able to store psychologists data from a failed user verification."

    ];

    $path = storage_path('app/kalimatNormal.csv');
    if (file_exists($path)) {
        unlink($path);
    }

    $result = SWRequirement::writeNLPresult($sentences);

    $this->assertTrue($result, "Fungsi tidak mengembalikan true");
    $this->assertFileExists($path, "File CSV tidak ditemukan");

    $expectedContent = "No,Kalimat\n";
    $expectedContent .= "1,\"Ini kalimat tunggal untuk pengujian.\"\n";

    $actualContent = file_get_contents($path);

    echo "\nIsi CSV jalur 3:\n" . $actualContent;

}

public function test_writeNLPresultJalur4()
{
    // tes isi csv jikalau satu kalimat saja
    $sentences = [
        "The system shall be able to update appointment statuses from user confirmations."
    ];

    $path = storage_path('app/kalimatNormal.csv');
    if (file_exists($path)) {
        unlink($path);
    }

    $result = SWRequirement::writeNLPresult($sentences);

    $this->assertTrue($result, "Fungsi tidak mengembalikan true");
    $this->assertFileExists($path, "File CSV tidak ditemukan");

    $expectedContent = "No,Kalimat\n";
    $expectedContent .= "1,\"Ini kalimat tunggal untuk pengujian.\"\n";

    $actualContent = file_get_contents($path);

    echo "\nIsi CSV jalur 3:\n" . $actualContent;

}


}


                         