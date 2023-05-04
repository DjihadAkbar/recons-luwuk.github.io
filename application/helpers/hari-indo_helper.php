<?php

function getHari($date){
    $datetime = DateTime::createFromFormat('Y-m-d', $date);
     $day = $datetime->format('l');
    switch ($day) {
     case 'Sunday':
      $hari = 'Minggu';
      break;
     case 'Monday':
      $hari = 'Senin';
      break;
     case 'Tuesday':
      $hari = 'Selasa';
      break;
     case 'Wednesday':
      $hari = 'Rabu';
      break;
     case 'Thursday':
      $hari = 'Kamis';
      break;
     case 'Friday':
      $hari = 'Jum\'at';
      break;
     case 'Saturday':
      $hari = 'Sabtu';
      break;
     default:
      $hari = 'Tidak ada';
      break;
    }
    return $hari;
   }
function getBulan($date){
     $month = date("F", strtotime($date));
    switch ($month) {
     case 'January':
      $month = 'Januari';
      break;
     case 'February':
      $month = 'Februari';
      break;
     case 'March':
      $month = 'Maret';
      break;
     case 'April':
      $month = 'April';
      break;
     case 'May':
      $month = 'Mei';
      break;
     case 'June':
      $month = 'Juni';
      break;
     case 'July':
      $month = 'Juli';
      break;
     case 'August':
      $month = 'Agustus';
      break;
     case 'September':
      $month = 'September';
      break;
     case 'October':
      $month = 'Oktober';
      break;
     case 'November':
      $month = 'November';
      break;
     case 'December':
      $month = 'Desember';
      break;
     default:
      $month = 'Tidak ada';
      break;
    }
    return $month;
   }