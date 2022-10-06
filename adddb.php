<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<?php 
//include'testtime.php';
require '../vendor/autoload.php';
session_start();
$conn = new MongoDB\Client();
$companydb  = $conn->iparuba;
$empcollection = $companydb->ipaps;

  $apname = $_POST['apname'];
  $sn = $_POST['sn'];

 

     $max = $_SESSION['mac'];
  

   $updateResult = $empcollection->replaceOne( //Update ข้อมูล
    ['Max' => $max],
    ['Max' => $max, 
     'Apname' => $apname ,
     'S/N'=> $sn,
     'ip'=> $_SESSION['ip'],
    ]
  );


unset($_SESSION['mac']);
unset($_SESSION['ip']);
echo ".";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        if (result.isDismissed) {
                            window.location.href ='/project/?page=3';
                        }
                      })";
                echo "</script>";
?>