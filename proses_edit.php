<?php

include 'koneksi.php';


  $id = $_POST['id'];
  $nama   = $_POST['nama'];
  $pangkat     = $_POST['pangkat'];
  $gajiawal    = $_POST['gajiawal'];
  $gajiakhir    = $_POST['gajiakhir'];
  $gambar = $_FILES['gambar']['name'];
  
  if($gambar != "") {
    $ekstensi_diperbolehkan = array('png','jpg'); 
    $x = explode('.', $gambar); 
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['gambar']['tmp_name'];   
    $angka_acak     = rand(1,999);
    $nama_gambar_baru = $angka_acak.'-'.$gambar; 
    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true)  {
                  move_uploaded_file($file_tmp, 'gambar/'.$nama_gambar_baru); 
                   $query  = "UPDATE data_gaji SET nama = '$nama', pangkat = '$pangkat', gajiawal = '$gajiawal', gajiakhir = '$gajiakhir', gambar = '$nama_gambar_baru'";
                    $query .= "WHERE id = '$id'";
                    $result = mysqli_query($koneksi, $query);
                    
                    if(!$result){
                        die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
                    } else {
                  
                      echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
                    }
              } else {     
               
                  echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
              }
    } else {
     
      $query  = "UPDATE data_gaji SET nama = '$nama', pangkat = '$pangkat', gajiawal = '$gajiawal', gajiakhir = '$gajiakhir'";
      $query .= "WHERE id = '$id'";
      $result = mysqli_query($koneksi, $query);
    
      if(!$result){
            die ("Query gagal dijalankan: ".mysqli_errno($koneksi).
                             " - ".mysqli_error($koneksi));
      } else {
        
          echo "<script>alert('Data berhasil diubah.');window.location='index.php';</script>";
      }
    }
