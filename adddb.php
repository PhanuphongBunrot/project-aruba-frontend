<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<?php 
//include'testtime.php';
require '../vendor/autoload.php';
$conn = new MongoDB\Client();
$companydb  = $conn->iparuba;
$empcollection = $companydb->ipaps;
$Ap = $_POST['Ap'];
$Sn = $_POST['Sn'];
 
if (isset($_GET['max'])) {

    $max = $_GET['max'];
   
   $updateResult = $empcollection->replaceOne( //Update ข้อมูล
    ['Max' => $max],
    ['Max' => $max, 
     'Apname' => $Ap ,
     'S/N'=> $Sn
    ]
  );
}


// echo ".";
//                 echo "<script>";
//                 echo "Swal.fire({
//                     icon: 'success',
//                     title: 'บันทึกข้อมูลสำเร็จ',
//                     showConfirmButton: false,
//                     timer: 2000
//                     }).then((result) => {
//                         if (result.isDismissed) {
//                             window.location.href ='/project/';
//                         }
//                       })";
//                 echo "</script>";
?>