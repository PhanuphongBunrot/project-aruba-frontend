<?php 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body>
    <script type="text/javascript">
        function chkNumber(ele)
	{
	var vchar = String.fromCharCode(event.keyCode);
	if ((vchar<'0' || vchar>'9') && (vchar != '.')) return false;
	ele.onKeyPress=vchar;
	}
        function fncSubmit() {
            let form = document.form1
            if (form.ipm.value == "") {
                alert('กรุณากรอก IP ด้วยครับ!!!');
                return false;
            } else if (form.add.value == "") {
                alert('กรุณากรอก ที่อยู่ ด้วยครับ!!!');
                return false;
            } else if (form.la.value == "") {
                alert('กรุณากรอก พิกกัด ด้วยครับ!!!');
                return false;
            } else if (form.lon.value == "") {
                alert('กรุณากรอก พิกกัด ด้วยครับ!!!');
                return false;
            } else if (form.sn.value == ""){
                alert('กรุณากรอก  Serial number ด้วยครับ!!!');
                return false;
            }
        }
    </script>
<div class="container">
    
        <div class="   fs-2 shadow p-3 mb-5 bg-body rounded">
            <form name="form1"  class="container" action="pages/addmg.php" method="POST" onSubmit="JavaScript:return fncSubmit();">
                <div style="width: 700px; " class="container">
                    <label>IP Master </label> <label class="text-danger fs-6"> (ใส่ได้เฉพาะตัวเลขเท่านั้น )</label> 
                    <input type="text" name="ipm" class="form-control " OnKeyPress="return chkNumber(this)">
                    <div   class="container fs-6" style="color:#C81111 "><?php if(isset($_SESSION['mgeadd'])){
								echo $_SESSION['mgeadd'] ;
								unset($_SESSION['mgeadd']);
							}  ?></div>
                    <label>Address</label>
                    <input type="text" name="add" class="form-control fs-5 ">
                    <label>Latitude </label> <label class="text-danger fs-6"> (Ex. 13....) </label>
                    <input type="text" name="la" class="form-control " OnKeyPress="return chkNumber(this)">
                    <label>Longitude </label> <label class="text-danger fs-6"> (Ex. 100....)</label>
                    <input type="text" name="lon" class="form-control " OnKeyPress="return chkNumber(this)">   
                    <label>Serial number </label>                
                    <input type="text" name="sn" class="form-control " > 
                    <br>
                    <button type="submit" class="btn btn-success">SAVE </button>

            </form>
        </div>
        
        
    
    </div>
</body>

</html>