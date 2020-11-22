<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Novay\WordTemplate\WordTemplate;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function surat()
    {
        $file = public_path('doc/surat_pernyataan.rtf');
	
        $array = array(
            '[NOMOR_SURAT]' => '015/BT/SK/V/2017',
            '[PERUSAHAAN]' => 'Rage Bali Developer',
            '[NAMA]' => 'I Gede Adi Surya Eka Pramana Putra',
            '[NIP]' => '9988778829292',
            '[ALAMAT]' => 'Jl. Bukit Jangkrik, Samplangan, Gianyar, Balo',
            '[PERMOHONAN]' => 'Permohonan Pengangakatan Jadi Presiden of Republic Monkey',
            '[KOTA]' => 'Gianyar',
            '[DIRECTOR]' => 'Mr. Beast',
            '[TANGGAL]' => date('d F Y'),
        );

        $nama_file = 'surat-keterangan-kerja.rtf';
        $tujuan_upload = public_path('data_file');

        
        $surats = (new WordTemplate)->export($file, $array, $nama_file);

        // $surats = Storage::get($surats, $tujuan_upload);
        // return response()->download($surats);
        return $surats;
        $data = file_get_contents($surats);
        $surats = Storage::get($data, $tujuan_upload);
        
        return response()->json($surats);

        $file = Storage::move($surats, $tujuan_upload);

        // return WordTemplate::export($file, $array, $nama_file);
    }


    public function export($file = null, $replace = null, $filename = 'default.doc') 
    {
        if(is_null($file))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        if(is_null($replace))
            return response()->json(['error' => 'This method needs some parameters. Please check documentation.']);

        $dokumen = $this->verify($file);
        
        foreach($replace as $key => $value) {
            $dokumen = str_replace($key, $value, $dokumen);
        }
        
        header("Content-type: application/msword");
        header("Content-disposition: inline; filename={$filename}");
        header("Content-length: ".strlen($dokumen));
        
        // return response()->download($dokumen);
        // echo $dokumen;
    }


    public function verify($file) 
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );

        $response = file_get_contents($file, false, stream_context_create($arrContextOptions));

        return $response;
    }
}
