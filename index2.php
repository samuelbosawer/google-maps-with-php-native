<?php 
 include("koneksi.php");

 $sql="SELECT * FROM pariwisata ORDER BY id DESC";
 $query=mysqli_query($koneksi, $sql);
 
 if($_POST != null)
 {
    $_GET = null;
    $nama_tempat = $_POST['nama_tempat'];
    $alamat = $_POST['alamat'];
    $long = $_POST['long'];
    $lat = $_POST['lat'];
    $id_icon = $_POST['id_icon'];

    $insert = "INSERT INTO pariwisata (`nama_tempat`, `alamat`, `lat`, `long`, `id_icon`)
    VALUES ('$nama_tempat', '$alamat', '$lat', '$long', '$id_icon')";

    if (mysqli_query($koneksi, $insert)) {
        echo "
        <script>
            alert('Data berhasil ditambahkan');
        </script>
        ";
    } else {
        echo"
          <script>
            alert('Data gagal ditambahkan');
        </script>";
    }
    $_POST = null;
 }

 if($_GET != null)
 {
    $_POST = null;
    $id = $_GET['id'];
    $delete = "DELETE FROM pariwisata WHERE id =  '$id' ";

    if (mysqli_query($koneksi, $delete)) {
        echo "
        <script>
            alert('Data berhasil dihapus');
        </script>
        ";
    } else {
        echo"
          <script>
            alert('Data gagal dihapus');
        </script>";
    }
    $_GET = null;

 }

 mysqli_close($koneksi);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GIS Demo 
Medicinal Plants in Papua</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Montserrat', sans-serif;
        }
        #map {
        height: 70%;
        width: 100%;
        margin-top: 300px
      }
      html, body {
        height: 100%;
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <a class="navbar-brand p-3 fw-bolder" href="#">GIS Demo 
Medicinal Plants in Papua </a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="row mt-3 text-center mb-5">
        <div class="col-12">
            <h2 class="fw-bolder">GIS Demo 
Medicinal Plants in Papua </h2>
        </div>
    </div>
    <div id="map" class="p-5 mb-5 mt-5"></div>

    <div class="container">
        <div class="row mt-5 text-center ">
            <div class="col">
                <h2 class="fw-bolder">GIS Demo 
Medicinal Plants in Papua </h2>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-6 mb-4">
                    <form action="" method="post">
                        <h3>Tambahkan tempat Baru</h3>
                        <div class="mb-3">
                            <label for="namaTempat" class="form-label">Nama Tempat</label>
                            <input type="text" class="form-control" id="namaTempat" name="nama_tempat" required placeholder="masukan nama tempat">
                        </div>
                            <div class="mb-3">
                            <label for="alamat" class="form-label">Keterangan</label>
                            <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                        </div>  
                        <div class="mb-3">
                            <label for="lat" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" required placeholder="masukan nama latitude">
                        </div>          
                        <div class="mb-3">
                            <label for="long" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="long" name="long" required placeholder="masukan nama longitude">
                        </div>
                       
                        <div class="mb-3">
                            <label for="" class="form-label">Icon</label>
                            <select class="form-select form-select-lg" name="id_icon" id="">
                                <option value="2">Daun merah </option>
                                <option value="1">Pohon hijau</option>
                            </select>
                        </div>
                        <!-- <div class="form-check mb-5">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckChecked" name="label">
                        <label class="form-check-label" for="flexCheckChecked">
                            Tambah nama tempat pada icon 
                        </label>
                        </div> -->
                        <button class="btn btn-primary" name="simpan" type="submit">Simpan</button>
                    </form>
                        
                </div>
            <div class="col-md-6">
                <h2>Daftar Tempat</h2>
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered" >
                        <tr class="bg-dark text-white text-center">
                            <th>No</th>
                            <th>Nama Tempat</th>
                            <th>Keterangan</th>
                            <th>Long</th>
                            <th>Lat</th>
                            <th></th>
                        </tr>
                            <?php $i=0; while($data=mysqli_fetch_assoc($query)){
                                    ?>
                                <tr>
                                    <td><?= ++$i?></td>
                                    <td><?= $data['nama_tempat']?></td>
                                    <td><?= $data['alamat']?></td>
                                    <td><?= $data['long'] ?></td>
                                    <td><?= $data['lat'] ?></td>
                                    <td>
                                        <a href="?id=<?=$data['id']?>" class="">Hapus</a>
                                    </td>
                                </tr>
                            <?php }?>
                    </table>
                </div>
                    
            </div>
          
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="js/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min"> </script> -->
<script>
function initMap() {
  
       var mapCanvas = document.getElementById('map');      
       // Center maps
       var myLatlng = new google.maps.LatLng(-4.8591005,133.311057);
       // Map Options    
       var mapOptions = {
         zoom: 6,
         center: myLatlng
       };
       
       // Create the Map
       map = new google.maps.Map(mapCanvas, mapOptions);

       var infoWindow = new google.maps.InfoWindow;

       //request data from data-maps.php
       $.getJSON( "data-maps.php", function( data ) {
        console.info(data)
         //parsing data json 
         $.each( data, function( i, item ) {

           //set point marker
           var point = new google.maps.LatLng(
                       parseFloat(item.lat),
                       parseFloat(item.long));

           //create pop up info header
           var infowincontent = document.createElement('div');
           var strong = document.createElement('strong');
           strong.textContent = item.nama_tempat;
           infowincontent.appendChild(strong);
           
           infowincontent.appendChild(document.createElement('br'));

           //create pop up info content
           var text = document.createElement('text');
           text.textContent = item.alamat
           infowincontent.appendChild(text);

           //marker option
           var marker = new google.maps.Marker({
               map: map,
               position: point,
               icon: item.image_path
           });

           //popup info 
           marker.addListener('click', function() {
             infoWindow.setContent(infowincontent);
             infoWindow.open(map, marker);
           });

         });
         
       });
       }
 

    </script>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSnEURuYDaHRh-CG1gwhXa-ozT72ugHbc&callback=initMap"
    async defer></script>
</html>
