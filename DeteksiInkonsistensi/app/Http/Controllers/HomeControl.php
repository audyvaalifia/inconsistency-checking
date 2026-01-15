<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use App\Models\SWRequirement;

class HomeControl extends Controller
{
    public function index()
    {
        return view('index', ['title' => 'Halaman Awal']);
    }
    // public function ontology()
    // {
    //     $result = OntologyProcessor::runReasoner();
    //     return view('ontology', compact('result'));
    // }


    public function simpanKeCSV(Request $request)
    {
        $sentence = $request->input('sentence', 'Default message');

        // misahin tiap kalimat array pake |
        if (!is_array($sentence)) {
            $sentence = explode('|', $sentence); 
        }

        $csvPath = storage_path('app/sentencesRaw.csv');

        if (Storage::exists('sentencesRaw.csv')) {
            Storage::delete('sentencesRaw.csv');
        }
        $csvContent = "No,Kalimat\n"; 

        foreach ($sentence as $index => $text) {
            $csvContent .= ($index + 1) . ",\"" . trim($text) . "\"\n"; // Trim buat hapus sobel spasi
        }
        Storage::put('sentencesRaw.csv', $csvContent);
        // Debug file csv 
        if (Storage::exists('sentencesRaw.csv')) {
            return response()->json(['message' => 'Data berhasil disimpan dan CSV di-reset']);
        } else {
            return response()->json(['message' => 'Gagal menyimpan CSV'], 500);
        }
    }


    public function normalizeSentence(Request $request)
{
    $sentence = $request->input('sentence', 'Default message');
    // Log::info('Isi sentence:', ['tipe' => gettype($sentence), 'isi' => $sentence]);

    // debug isian kosong
    if (empty($sentence)) {
        return response()->json(['message' => 'Input kalimat kosong'], 400);
    }
    // misahin tiap kalimat aray pake |
    // if (is_string($sentence)) {
    //     $sentence = explode('|', $sentence);
    // }
    // else {
    //     return response()->json(['message' => 'Input harus berupa string'], 400);
    // }

    // ngambil var sentencelist di file py (buat ambil hasil def normalisasi doang)
    $pythonScript = storage_path('app/nlpuntukanalisisreq.py');
    $command = "python \"$pythonScript\" " . escapeshellarg($sentence) . " sentencelist";
    $output = shell_exec($command);

    // if ($output === null) {
    //     return response()->json(['message' => 'Gagal menjalankan NLP'], 500);
    // }

    $processedSentences = json_decode($output, true);
    // if (!is_array($processedSentences)) {
    //     return response()->json(['message' => 'Format output tidak valid'], 500);
    // }

    // lanjutkeun ke Laravel model
    $success = SWRequirement::writeNLPresult($processedSentences);

    if ($success) {
        return response()->json(['message' => 'Data berhasil diproses dan disimpan'], 200);
    } else {
        return response()->json(['message' => 'Gagal menyimpan CSV'], 500);
    }
}



//CHECKPOINT


public function buildRDF(Request $request)
{
    try {
        $reasonerOutput = SWRequirement::reasonOntology();
        return response($reasonerOutput)->header('Content-Type', 'text/plain');
    } catch (\Exception $e) {
        return response()->json(['error' => 'Gagal memproses NLP atau Reasoner', 'detail' => $e->getMessage()], 500);
    }
}


// public function detectConflict(Request $request)
// {
//     $sentence = $request->input('sentence', 'Default message');

//     try {
//         $reasonerOutput = SWRequirement::writeOWLfile($sentence);
//         return response($reasonerOutput)->header('Content-Type', 'text/plain');
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'Gagal memproses NLP atau Reasoner', 'detail' => $e->getMessage()], 500);
//     }
// }



}