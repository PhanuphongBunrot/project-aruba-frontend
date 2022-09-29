<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link href="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link href="popup/style.css" />
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">

            <?php
            require '../vendor/autoload.php';
            error_reporting(E_ALL ^ E_NOTICE);
            $ip = $_GET['ip'];
            $num = $_GET['num'];

            $mon = new  MongoDB\Client();
            $conn = $mon->iparuba->ipgroup;
            $ip_group = $conn->find()->toArray();
            $data = [
                'user' => 'admin',
                'passwd' => 'ssit1234',
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://" . $ip . ":4343/rest/login",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,

                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $resp = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $json = json_decode($resp, true);
                $sid = $json["sid"];
            }


            $url = "https://" . $ip . ":4343/rest/show-cmd?iap_ip_addr=" . $ip . "&cmd=show%20aps&sid=" . $sid;


            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $headers = array(
                "Content-Type: application/json",
            );
            //for debug only!
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

            $resp = curl_exec($curl);
            $expl = explode('\n', $resp);
            $t = 0;
            for ($x = 9; $x < count($expl); $x++) {
                $keywords = preg_split("/[\s,]+/", $expl[$x]);


                if (strlen($keywords[0]) == 1) {
                    $keywords[0] = null;
                } else if ($keywords[0] != null) {
                    $mac_ap[] = $keywords[0];
                }
            }


            for($u = 0 ; $u <count($ip_group); $u++){
                if ($ip_group[$u][$ip] != null){
                    $t =$t +1;
                    $arr_ip[]=$ip_group[$u][$ip];
                }else if($ip_group[$u][$ip] == null){
                    unset($ip_group[$u][$ip]);
                }
                  

            }
            echo $ip . " ".$t;
          
            ?>
            <div class="table-responsive fs-4">
                <table class="table table-striped gy-7 gs-7" id="test">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <!-- <th class="min-w-200px fs-3">#</th> -->

                            <th class="min-w-200px fs-4">MAC</th>
                            <th class="min-w-200px fs-4">Status</th>
                            


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $o = 0;
                        $f = 0;

                        $online = array_intersect($arr_ip, $mac_ap);
                        $online = array_values($online);
                        for ($k = 0; $k < count($online); $k++) {
                            $o = $o + 1;
                            ?> <tr>
                                <td><?php echo $online[$k] ?></td>
                                <td><?php echo "Online" ?></td>
                            </tr> <?php 
                            // echo ($online[$k] . " " . $ip_db[$k]['Apname'] . " Online" . " " . $d . "/" . $m . "/" . $Y . " " . $h . ":" . $min  . " ");
                        }
                        $f =0;

                        $offline = array_diff($arr_ip,$mac_ap);
                        $offline = array_values($offline);
                        for ($g = 0 ; $g < count($offline) ; $g++){
                             $f = $f + 1;
                             ?> <tr>
                             <td><?php echo $offline[$k] ?></td>
                             <td><?php echo "Offline" ?></td>
                         </tr>
                        <?php 
                             //echo ($offline[$g] . " " . $ip_db[$g]['Apname']. " Offline" . " " . $d . "/" . $m . "/" . $Y . " " . $h . ":" . $min  . " ");       
                        }
                        ?>
                        

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