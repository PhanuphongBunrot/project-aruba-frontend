<?php
session_start();

?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<?php


require '../vendor/autoload.php';
$conn =  new MongoDB\Client();
$companydb  = $conn->iparuba;
$empcollection = $companydb->ipmaster;

$mon = new MongoDB\Client();
$conn = $mon->iparuba->ipmaster;
$data = $conn->find()->toArray();

$ipm = $_POST['ipm'];
$add = $_POST['add'];
$la = $_POST['la'];
$lon = $_POST['lon'];
$sn = $_POST['sn'];
//echo $ipm;

for ($y = 0; $y < count($data); $y++) {

    if ($ipm === $data[$y]['ip']) {
        $_SESSION["mgeadd"] = "redundant information";
        $ipm = null;
    }
}
if ($ipm != null) {
    $inser = $empcollection->insertMany([
        [
            'ip' => $ipm,
            'address' => $add,
            'Longitude' => $la,
            'Latitude' => $lon,
            'Serial' => $sn,
            'Status' => "-",
            'd/m/y' =>"-",
            'time' => "-"
        ]
    ]);
}

echo ".";
                echo "<script>";
                echo "Swal.fire({
                    icon: 'success',
                    title: 'บันทึกข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 2000
                    }).then((result) => {
                        if (result.isDismissed) {
                            window.location.href ='../?page=4';
                        }
                      })";
                echo "</script>";

?>