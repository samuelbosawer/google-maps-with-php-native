<?php
header('Content-type: text/xml');
header('Pragma: public');
header('Cache-control: private');

include("koneksi.php");

echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
echo "<markers>";
$query="SELECT * FROM pariwisata";
$query=mysqli_query($koneksi, $query);
while ($data=mysqli_fetch_array($query)) {
 echo "<marker id='".$data['id']."' nama_tempat='".$data['nama_tempat']."'  alamat='".$data['alamat']."' lat='".$data['lat']."' long='".$data['long']."'/>";
};
echo "</markers>";