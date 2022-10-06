<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <link href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
    <link href="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <title>Document</title>
</head>
<style>
    html {
        font-family: Tahoma, Geneva, sans-serif;
        padding: 20px;
        background-color: #F8F9F9;
    }

    table {
        border-collapse: collapse;
        width: 500px;
    }

    td,
    th {
        padding: 10px;
    }

    th {
        background-color: #54585d;
        color: #ffffff;
        font-weight: bold;
        font-size: 13px;
        border: 1px solid #54585d;
    }

    td {
        color: #636363;
        border: 1px solid #dddfe1;
    }

    tr {
        background-color: #f9fafb;
    }

    tr:nth-child(odd) {
        background-color: #ffffff;
    }

    .pagination {
        list-style-type: none;
        padding: 10px 0;
        display: inline-flex;
        justify-content: space-between;
        box-sizing: border-box;
    }

    .pagination li {
        box-sizing: border-box;
        padding-right: 10px;
    }

    .pagination li a {
        box-sizing: border-box;
        background-color: #e2e6e6;
        padding: 8px;
        text-decoration: none;
        font-size: 12px;
        font-weight: bold;
        color: #616872;
        border-radius: 4px;
    }

    .pagination li a:hover {
        background-color: #d4dada;
    }

    .pagination .next a,
    .pagination .prev a {
        text-transform: uppercase;
        font-size: 12px;
    }

    .pagination .currentpage a {
        background-color: #518acb;
        color: #fff;
    }

    .pagination .currentpage a:hover {
        background-color: #518acb;
    }


 
</style>

<body>
    <?php
    error_reporting(E_ALL ^ E_NOTICE);
    include  '../vendor/autoload.php';
    $mon = new MongoDB\Client();
    $conn = $mon->iparuba->statustotals;
    $ip_status = $conn->find()->toArray();



    $total_pages = count($ip_status);

    $num_results_on_page = 10;







    $page = isset($_GET['pagev']) && is_numeric($_GET['pagev']) ? $_GET['pagev'] : 1;


    $url = "http://127.0.0.1:8000/test?page=" . $page;

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
    curl_close($curl);
    $json = json_decode($resp, true);






    ?>
    <div class="container">

        <div class=" fs-2   shadow p-3 mb-5 bg-body rounded">
            
            <div class="table-responsive fs-3">
                <table class="table table-striped gy-7 gs-7" id="test">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                            <!-- <th class="min-w-200px fs-3">#</th> -->

                            <th class="min-w-100px fs-3">Mac IP</th>
                            <th class="min-w-100px fs-3">IP</th>
                            <th class="min-w-100px fs-3">Ap name</th>
                            <th class="min-w-100px fs-3">Status</th>
                            <th class="min-w-100px fs-3">Last day</th>
                            <th class="min-w-100px fs-3">Time</th>


                        </tr>
                    </thead>
                    <tbody></tbody>
                    <?php
                    //print_r($data[0][1]);
                    for ($i = 0; $i < count($json["data"]); $i++) :

                    ?>
                        <tr class=" fs-5">

                            <td> <?php echo ($json["data"][$i]["Max"]) ?></td>
                            <td><?php echo ($json["data"][$i]["ip"]) ?></td>
                            <td><?php echo ($json["data"][$i]["Apname"]) ?></td>
                            <?php if ($json["data"][$i]["Status"] === 'Online') { ?>
                                <td style="color:#65CF01"><?php echo ($json["data"][$i]["Status"]) ?></td>
                                <td><?php echo ($json["data"][$i]["d/m/y"]) ?></td>
                                <td><?php echo ($json["data"][$i]["time"]) ?></td>
                            <?php } else if ($json["data"][$i]["Status"] === 'Offline') {
                            ?>
                                <td style="color:#E10808"><?php echo $json["data"][$i]["Status"]; ?></td>

                                <td><?php echo ($json["data"][$i]["d/m/y"]); ?></td>

                                <td><?php echo ($json["data"][$i]["time"]); ?></td>
                                
 

                            <?php } ?>


                        </tr>
                    <?php endfor ?>

                    </tbody>
                </table>

                <?php if (ceil($total_pages / $num_results_on_page) > 0) : ?>
                    <ul class="pagination">
                        <?php if ($page > 1) : ?>
                            <li class="prev"><a href="?page=3&pagev=<?php echo $page - 1 ?>">
                                    << </a>
                            </li>
                        <?php endif; ?>
                        <?php if ($page > 3) : ?>
                            <li class="start"><a href="?page=3&pagev=1">1</a></li>
                            <li class="dots">...</li>
                        <?php endif; ?>

                        <?php if ($page - 2 > 0) : ?><li class="page"><a href="?page=3&pagev=<?php echo $page - 2 ?>"><?php echo $page - 2 ?></a></li><?php endif; ?>
                        <?php if ($page - 1 > 0) : ?><li class="page"><a href="?page=3&pagev=<?php echo $page - 1 ?>"><?php echo $page - 1 ?></a></li><?php endif; ?>

                        <li class="currentpage"><a href="?page=3&pagev=<?php echo $page ?>"><?php echo $page ?></a></li>

                        <?php if ($page + 1 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="?page=3&pagev=<?php echo $page + 1 ?>"><?php echo $page + 1 ?></a></li><?php endif; ?>
                        <?php if ($page + 2 < ceil($total_pages / $num_results_on_page) + 1) : ?><li class="page"><a href="?page=3&pagev=<?php echo $page + 2 ?>"><?php echo $page + 2 ?></a></li><?php endif; ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page) - 2) : ?>
                            <li class="dots">...</li>
                            <li class="end"><a href="?page=3&pagev=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a></li>
                        <?php endif; ?>

                        <?php if ($page < ceil($total_pages / $num_results_on_page)) : ?>
                            <li class="next"><a href="?page=3&pagev=<?php echo $page + 1 ?>"> >> </a></li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
            </div>
            
        </div>
    </div>



</body>

</html>