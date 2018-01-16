<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace fpdf;

/**
 * Description of Pdfku
 *
 * @author eries
 */
class Pdfetab extends FPDF {
    
    public $awal,$akhir;
    
    public function setAwal($val){
        $this->awal = $val;
    }
    public function setAkhir($val){
        $this->akhir = $val;
    }

    //put your code here
    function Header() {
        // Logo
        //$this->Image('logo.png', 10, 6, 30);
        // Courier bold 15
        // Move to the right
        // Title
        $this->SetFont('Courier', 'B', 12);
        $this->Cell($this->w - $this->rMargin - $this->lMargin, 5, 'REKAPITULASI TRANSAKSI TABUNGAN', 0, 1, 'C');
        //show periode
        if($this->awal !='' && $this->akhir != ''){
            $this->SetFont('Courier', 'B', 10);
            $this->Cell($this->w - $this->rMargin - $this->lMargin, 5, 'PERIODE (' . date('d-m-Y',strtotime($this->awal)) . ') - (' . date('d-m-Y',strtotime($this->akhir)) . ')', 0, 1, 'C');
        }
            
        $this->SetFont('Courier', 'B', 10);
        $this->Cell($this->w - $this->rMargin - $this->lMargin, 5, 'SDI SABILIL HUDA', 0, 1, 'C');
        $this->SetFont('Courier', 'B', 8);
        $this->Cell($this->w - $this->rMargin - $this->lMargin, 5, 'Jl. Singokarso 54 Sumorame Candi Sidoarjo', 0, 1, 'C');
        $this->Line(10, 30, $this->w - 10, 30);
        $this->Line(10, 30.1, $this->w - 10, 30.1);
        $this->Line(10, 30.2, $this->w - 10, 30.2);
        $this->Line(10, 30.3, $this->w - 10, 30.3);
        $this->Line(10, 30.7, $this->w - 10, 30.7);
        $this->ln();

        //show tanggal cetak
//        if ($this->PageNo() == 1) {
//            $this->SetFont('Courier', 'B', 8);
//            $this->Cell($this->w - $this->rMargin - $this->lMargin, 5, 'Dicetak pada : ' . date('d-m-Y [H:i:s]'), 0, 1, 'R');
//        }

        $this->SetFont('Courier', 'B', 12);
        $colNo = 10;
        $colNis = 10;
        $colNama = 45;
        $colRombel = 45;
        $colTgl = 20;
        $colDebet = 30;
        $colKredit = 30;
        $stdFontSize = 10;
        $this->Cell($colNo, 8, 'NO', 1, 0, 'C');
        $this->Cell($colNis, 8, 'NIS', 1, 0, 'C');
        $this->Cell($colNama, 8, 'NAMA', 1, 0, 'C');
        $this->Cell($colRombel, 8, 'ROMBEL', 1, 0, 'C');
        $this->Cell($colTgl, 8, 'TGL', 1, 0, 'C');
        $this->Cell($colDebet, 8, 'DEBET', 1, 0, 'C');
        $this->Cell($colKredit, 8, 'KREDIT', 1, 1, 'C');
    }

    // Page footer
    function Footer() {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Courier', 'I', 8);
        // Page number
        //$this->Cell(0, 10, 'Page ' . $this->PageNo(), 1, 0, 'R');
        $this->Cell(($this->w - $this->rMargin - $this->lMargin)/2, 10, 'Print at : ' . date('d-m-Y [H:i:s]'), 0, 0, 'L');
        $this->Cell(($this->w - $this->rMargin - $this->lMargin)/2, 10, 'Page ' . $this->PageNo(), 0, 0, 'R');
    }

}
