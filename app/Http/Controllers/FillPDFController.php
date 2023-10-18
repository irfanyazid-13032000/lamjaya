<?php

namespace App\Http\Controllers; 


use App\Models\Divisi;
use App\Models\User;
use setasign\Fpdi\Fpdi;
class FillPDFController extends Controller
{
    public function process($id)
    {

        $data = User::where('id', $id)->first();
        $nama = $data['name'];
        $divisi = $data->divisi->name;
        $tgl_in = $data['tanggal_masuk'];
        $tgl_out = $data['tanggal_keluar'];
        $tgl = $tgl_in.' s/d '.$tgl_out;
        $outputfile = public_path().'dcc.pdf';
        $this->fillPDF(public_path().'/master/dcc.pdf', $outputfile, $nama, $divisi, $tgl);

        return response()->file($outputfile);
 

    }

 

   public function fillPDF($file,$outputfile, $nama, $divisi,$tgl){
     $fpdi = new FPDI ;
     $fpdi->setSourceFile($file);
     $template = $fpdi->importPage(1);
     $size = $fpdi->getTemplateSize($template);
     $fpdi->AddPage($size['orientation'],array($size['width'],$size['height']));
     $fpdi->useTemplate($template);
     $top_name =98;
     $right_name = 130;
     $top_divisi =124;
     $right_divisi = 140;
     $top_tgl = 132;
     $right_tgl = 65;
     $name  = $nama;
     if(str_word_count($name)>1){
      $right_name = $right_name - (str_word_count($name)*5);
     }
     $fpdi->SetFont("helvetica","",30);
     
     $fpdi->SetTextColor(25,26,25);
     $fpdi->Text($right_name,$top_name,$name);
     $fpdi->SetFont("helvetica","",15 );
     $fpdi->Text($right_divisi,$top_divisi,$divisi);
     $fpdi->SetFont("helvetica","",15 );
     $fpdi->Text($right_tgl,$top_tgl,$tgl);
     return $fpdi->Output($outputfile,'F');
   }

   public function show($email)
    {
      $user = User::where('email', $email)->first();
      return view('dashboard.magang.sertifikat.show', compact('user'));
  

}
}
