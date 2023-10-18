<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
    public function eksporPDF()
    {
        $absensi = Absensi::all();

        $data = [
            'absensi' => $absensi,
        ];

        $pdf = PDF::loadView('dashboard.magang.absensi.pdf', $data);

        return $pdf->download('semua-data.pdf');
    }
    public function eksporPDFBulan()
    {
        // Mendapatkan bulan dan tahun saat ini
        $bulanIni = date('m');
        $tahunIni = date('Y');

        // Filter data absensi berdasarkan bulan dan tahun saat ini
        $absensi = Absensi::whereMonth('tanggal', $bulanIni)->whereYear('tanggal', $tahunIni)->get();

        $data = [
            'absensi' => $absensi,
        ];

        $pdf = PDF::loadView('dashboard.magang.absensi.pdf', $data);

        return $pdf->download('data-bulan.pdf');
    }
    public function eksporPDFMinggu()
    {
        // Mendapatkan tanggal 7 hari sebelum hari ini
        $tanggalMingguIni = date('Y-m-d');
        $tanggal7HariSebelumnya = date('Y-m-d', strtotime('-7 days', strtotime($tanggalMingguIni)));

        // Filter data absensi berdasarkan rentang tanggal
        $absensi = Absensi::whereBetween('tanggal', [$tanggal7HariSebelumnya, $tanggalMingguIni])->get();

        $data = [
            'absensi' => $absensi,
        ];

        $pdf = PDF::loadView('dashboard.magang.absensi.pdf', $data);

        return $pdf->download('data-minggu.pdf');
    }
    public function eksporPDFHari()
    {
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = date('Y-m-d');

        // Filter data absensi berdasarkan tanggal hari ini
        $absensi = Absensi::where('tanggal', $tanggalHariIni)->get();

        $data = [
            'absensi' => $absensi,
        ];

        $pdf = PDF::loadView('dashboard.magang.absensi.pdf', $data);

        return $pdf->download('data-hari.pdf');
    }
}
