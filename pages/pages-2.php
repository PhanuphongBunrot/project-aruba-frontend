<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
   <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"/>
    <link href="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"/>
  
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<link href="popup/style.css"/>
</head>
<body>
  

<?php 

if(isset($_GET['ip'])){
  $_SESSION['ip'] = $_GET['ip'];
}
?>


<div class="container">

  <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    require '../vendor/autoload.php';
    $mon = new MongoDB\Client();
    $conn = $mon->iparuba->ipmaster;
    $data = $conn->find()->toArray();
    ?>
    <div class="table-responsive fs-3">
        <table class="table table-striped gy-7 gs-7" id="test">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                <!-- <th class="min-w-200px fs-3">#</th> -->
                    <th class="min-w-100px fs-3">No.</th>
                    <th class="min-w-100px fs-3">iP Master</th>
                    <th class="min-w-100px fs-3">Address</th>
                    <th class="min-w-100px fs-3">Serial</th>
                    <th class="min-w-100px fs-3">Status</th>
                    

                </tr>
            </thead>
            <tbody>
                <?php
                
                for ($i = 0; $i < count($data); $i++) { 
                    $num = $i +1;
                ?>
                    <tr class=" fs-5">
        <td><?php echo $num; ?> </td>   
        <td> <a class="menu-link <?php if($page === '5'){echo 'active';} ?>" href="?page=5&ip=<?php echo $data[$i]["ip"] ?>"><?php echo $data[$i]["ip"] ?></a></td>
        <td><?php echo $data[$i]['address'] ;?> </td>
        <td><?php echo $data[$i]['Serial'] ;?> </td>
        <?php if ($data[$i]['Status'] === "Online") { ?>
        <td style="color:#65CF01;"><?php echo $data[$i]['Status'] ;?> </td> 
         <?php } else if ($data[$i]['Status'] === "Offline"){?>  
         <td style="color:#E10808;"><?php echo $data[$i]['Status'] ;?> </td> 
         <?php } ?>         
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    
  </div>
</div>
<script>

$(document).ready( function () {
    $('.table').DataTable();
} );
    </script>
</body>
</html>