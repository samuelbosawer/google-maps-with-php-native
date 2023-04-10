<?php
 header('Content-Type: application/json; charset=utf8');
 include("koneksi.php");

 $sql="SELECT * FROM pariwisata";
 $query=mysqli_query($koneksi, $sql);

 $array=array();
 while($data=mysqli_fetch_assoc($query)) $array[]=$data; 
 
 echo json_encode($array);