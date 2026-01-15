<?php
//CHECKPOINT

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class SWRequirement extends Model
{
    public static function writeNLPresult(array $processedSentences)
    {
        $csvPath = storage_path('app/kalimatNormal.csv');

        if (Storage::exists('kalimatNormal.csv')) {
            Storage::delete('kalimatNormal.csv');
        }

        $csvContent = "No,Kalimat\n"; 

        // kalo ada dobel sapsi dipotong
        foreach ($processedSentences as $index => $text) {
            $csvContent .= ($index + 1) . ",\"" . trim($text) . "\"\n";
        }

        Storage::put('kalimatNormal.csv', $csvContent);

        return Storage::exists('kalimatNormal.csv');
    }

    public static function reasonOntology(): string
{
    // ngambil/baca file kalimatNormal.csv buat diproses ke def spacy s.d rdf
    $csvPath = storage_path('app/kalimatNormal.csv');

    if (!file_exists($csvPath)) {
        throw new \Exception("File CSV tidak ditemukan di path: $csvPath");
    }

    // run file membangunRDF.py 
    $rdfProcess = new Process([
        'C:\\Python311\\python.exe',
        storage_path('app/membangunRDF.py'),
        $csvPath
    ]);
    $rdfProcess->run();

    if (!$rdfProcess->isSuccessful()) {
        throw new ProcessFailedException($rdfProcess);
    }

    // output py disimpan ke file ontologi.owl
    $rdfOutput = trim($rdfProcess->getOutput());
    Storage::put('ontologi.owl', $rdfOutput);

    // PROSES BARU
    // langsung jalankan reasoner -> manggil ontologi.owl nya di file py reasoner
    $reasonerProcess = new Process([
        'C:\\Python311\\python.exe',
        storage_path('app/reasoner.py')
    ]);
    $reasonerProcess->run();

    if (!$reasonerProcess->isSuccessful()) {
        throw new ProcessFailedException($reasonerProcess);
    }

    // Kembalikan hasil dari reasoning
    return trim($reasonerProcess->getOutput());
}


// public static function writeOWLfile(string $sentence): string
//     {
//         $nlpProcess = new Process([
//             'C:\\Python311\\python.exe',
//             storage_path('app/nlpuntukanalisisreq.py'),
//             $sentence
//         ]);
//         $nlpProcess->run();

//         if (!$nlpProcess->isSuccessful()) {
//             throw new ProcessFailedException($nlpProcess);
//         }

//         // Simpan output NLP ke file ontologi.owl
//         $owlOutput = trim($nlpProcess->getOutput());
//         Storage::put('ontologi.owl', $owlOutput);

//         // Jalankan reasoning
//         $reasonerProcess = new Process([
//             'C:\\Python311\\python.exe',
//             storage_path('app/reasoner.py')
//         ]);
//         $reasonerProcess->run();

//         if (!$reasonerProcess->isSuccessful()) {
//             throw new ProcessFailedException($reasonerProcess);
//         }

//         return trim($reasonerProcess->getOutput());
//     }


}