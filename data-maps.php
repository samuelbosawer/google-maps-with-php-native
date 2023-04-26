<?php

 header('Content-Type: application/json; charset=utf8');
 
 $con = mysqli_connect("feq50y.stackhero-network.com","root","mU2BSaSELn4jz7jBLRW4Hz0dgFVjKB0x","db_gis");

 //query untuk menampilkan data maps dan icon image
 $sql="SELECT
   pariwisata.nama_tempat,
   pariwisata.alamat,
   pariwisata.lat,
   pariwisata.long,
   pariwisata.id_icon,
   icon.tipe,
   icon.image_path
  FROM
  pariwisata
   LEFT JOIN icon ON pariwisata.id_icon=icon.id_icon";

 $query=mysqli_query($con, $sql);

 $array=array();
 while($data=mysqli_fetch_assoc($query)) $array[]=$data; 
 
 echo json_encode($array);
?>