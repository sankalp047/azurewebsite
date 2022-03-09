<?php
use Phppot\DataSource;

require_once 'DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();

if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            
            $time = "";
            if (isset($column[0])) {
                $time = mysqli_real_escape_string($conn, $column[0]);
            }
            $latitude = "";
            if (isset($column[1])) {
                $latitude = mysqli_real_escape_string($conn, $column[1]);
            }
            $longitude = "";
            if (isset($column[2])) {
                $longitude = mysqli_real_escape_string($conn, $column[2]);

            }
            $depth = "";
            if (isset($column[3])) {
                $depth = mysqli_real_escape_string($conn, $column[3]);
            }
            $mag = "";
            if (isset($column[4])) {
                $mag = mysqli_real_escape_string($conn, $column[4]);
            }
            $magType = "";
            if (isset($column[5])) {
                $magType = mysqli_real_escape_string($conn, $column[5]);
            }
            
            $nst = "";
            if (isset($column[6])) {
                $nst =  mysqli_real_escape_string($conn, $column[6]);
            }

            $gap = "";
            if (isset($column[7])) {
                $gap = mysqli_real_escape_string($conn, $column[7]);
            }

            $dmin = "";
            if (isset($column[8])) {
                $dmin = mysqli_real_escape_string($conn, $column[8]);
            }

            $rms = "";
            if (isset($column[9])) {
                $rms = mysqli_real_escape_string($conn, $column[9]);
            }

            $net = "";
            if (isset($column[10])) {
                $net = mysqli_real_escape_string($conn, $column[10]);
            }

            $id = "";
            if (isset($id[11])) {
                $id = mysqli_real_escape_string($conn, $column[11]);
            }
            $updated = "";
            if (isset($column[12])) {
                $updated = mysqli_real_escape_string($conn, $column[12]);
            }

            $place = "";
            if (isset($column[13])) {
                $place = mysqli_real_escape_string($conn, $column[13]);
            }

            $type = "";
            if (isset($column[14])) {
                $type = mysqli_real_escape_string($conn, $column[14]);
            }

            $horizantalError = "";
            if (isset($column[15])) {
                $horizantalError = mysqli_real_escape_string($conn, $column[15]);
            }

            $depthError = "";
            if (isset($column[16])) {
                $depthError = mysqli_real_escape_string($conn, $column[16]);
            }

            $magError = "";
            if (isset($column[17])) {
                $magError = mysqli_real_escape_string($conn, $column[17]);
            }

            $magNst = "";
            if (isset($column[18])) {
                $magNst = mysqli_real_escape_string($conn, $column[18]);
            }

            $status = "";
            if (isset($column[19])) {
                $status = mysqli_real_escape_string($conn, $column[19]);
            }

            $locationSource = "";
            if (isset($column[20])) {
                $locationSource = mysqli_real_escape_string($conn, $column[20]);
            }

            $magSource = "";
            if (isset($column[21])) {
                $magSource = mysqli_real_escape_string($conn, $column[21]);
            }

            $sqlInsert = "INSERT into users (time,latitude,longitude,depth,mag,magType,nst,gap,dmin,rms,net,id,updated,place,type,horizantalError,depthError,magError,magNst,status,locationSource,magSource)
                   values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $paramType = "ssssssisssssssssssisss";
            $paramArray = array(
                $time,
                $latitude,
                $longitude,
                $depth,
                $mag,
                $magType,
                $nst,
                $gap,
                $dmin,
                $rms,
                $net,
                $id,
                $updated,
                $place,
                $type,
                $horizantalError,
                $depthError,
                $magError,
                $magNst,
                $status,
                $locationSource,
                $magSource
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            
            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 550px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
	<h3>Sankalp Sandeep Singh<br> UTA - 1001964065</h3>
    <h2>Finding data in range</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                name="frmCSVImport" id="frmCSVImport"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label"></label> <input type="text" name="file"
                        id="file">
			<label class="col-md-4 control-label"></label> <input type="text" name="file"
                        id="file"
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Search</button>
                    <br />

                </div>

            </form>
		

        </div>
               <?php
            $sqlSelect = "SELECT * FROM ni";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='ni'>
            <thead>
                <tr>
			<th>name</th>
			<th>id</th>

                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['name']; ?></td>
                    <td><?php  echo $row['id']; ?></td>
                   
                </tr>
                    <?php
                }
                ?>
                </tbody>
        </table>
        <?php } ?>
    </div>

</body>
</html>
