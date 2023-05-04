<?php defined('BASEPATH') OR exit('No direct script access allowed');
function penyebut($nilai) {
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ((int) $nilai < 12) {
        $temp = " ". $huruf[(int) $nilai];
    } else if ((int) $nilai <20) {
        $temp = penyebut((int) $nilai - 10). " belas";
    } else if ((int) $nilai < 100) {
        $temp = penyebut((int) $nilai/10)." puluh". penyebut((int) $nilai % 10);
    } else if ((int) $nilai < 200) {
        $temp = " seratus" . penyebut((int) $nilai - 100);
    } else if ((int) $nilai < 1000) {
        $temp = penyebut((int) $nilai/100) . " ratus" . penyebut((int) $nilai % 100);
    } else if ((int) $nilai < 2000) {
        $temp = " seribu" . penyebut((int) $nilai - 1000);
    } else if ((int) $nilai < 1000000) {
        $temp = penyebut((int) $nilai/1000) . " ribu" . penyebut((int) $nilai % 1000);
    } else if ((int) $nilai < 1000000000) {
        $temp = penyebut((int) $nilai/1000000) . " juta" . penyebut((int) $nilai % 1000000);
    } else if ((int) $nilai < 1000000000000) {
        $temp = penyebut((int) $nilai/1000000000) . " milyar" . penyebut(fmod((int) $nilai,1000000000));
    } else if ((int) $nilai < 1000000000000000) {
        $temp = penyebut((int) $nilai/1000000000000) . " trilyun" . penyebut(fmod((int) $nilai,1000000000000));
    }     
    return $temp;
}
function terbilang($nilai) {
    if($nilai<0) {
        $hasil = "minus ". trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }           
    return $hasil;
}