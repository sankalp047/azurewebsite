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
    <h2>Import CSV file into Mysql Azure</h2>

    <div id="response"
        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
        <?php if(!empty($message)) { echo $message; } ?>
        </div>
    <div class="outer-scontainer">
        <div class="row">

            <form class="form-horizontal" action="" method="post"
                enctype="multipart/form-data">
                <div class="input-row">
                    <label class="col-md-4 control-label">Choose CSV
                        File</label> <input type="text" name="file"
                        id="file">
			 <input type="text" name="file"
                        id="file">
                    <button type="submit" id="submit" name="import"
                        class="btn-submit">Import</button>
                    <br />

                </div>

            </form>
		<div>
			<button type="submit" id="submit" name="import2"
                        class="btn-submit">Find EarthQuake mag 5+</button>
		</div>

        </div>
               <?php
            $sqlSelect = "SELECT * FROM users";
            $result = $db->select($sqlSelect);
            if (! empty($result)) {
                ?>
            <table id='userTable'>
            <thead>
                <tr>
                    <th>time</th>
                    <th>latitude</th>
                    <th>longitude</th>
                    <th>depth</th>
                    <th>mag</th>
                    <th>magType</th>
                    <th>nst</th>
                    <th>gap</th>
                    <th>dmin</th>
                    <th>rms</th>
                    <th>net</th>
                    <th>id</th>
                    <th>updated</th>
                    <th>place</th>
                    <th>type</th>
                    <th>horizantalError</th>
                    <th>depthError</th>
                    <th>magError</th>
                    <th>magNst</th>
                    <th>status</th>
                    <th>locationSource</th>
                    <th>magSource</th>

                </tr>
            </thead>
<?php
                
                foreach ($result as $row) {
                    ?>
                    
                <tbody>
                <tr>
                    <td><?php  echo $row['time']; ?></td>
                    <td><?php  echo $row['latitude']; ?></td>
                    <td><?php  echo $row['longitude']; ?></td>
                    <td><?php  echo $row['depth']; ?></td>
                    <td><?php  echo $row['mag']; ?></td>
                    <td><?php  echo $row['magType']; ?></td>
                    <td><?php  echo $row['nst']; ?></td>
                    <td><?php  echo $row['gap']; ?></td>
                    <td><?php  echo $row['dmin']; ?></td>
                    <td><?php  echo $row['rms']; ?></td>
                    <td><?php  echo $row['net']; ?></td>
                    <td><?php  echo $row['id']; ?></td>
                    <td><?php  echo $row['updated']; ?></td>
                    <td><?php  echo $row['place']; ?></td>
                    <td><?php  echo $row['type']; ?></td>
                    <td><?php  echo $row['horizantalError']; ?></td>
                    <td><?php  echo $row['depthError']; ?></td>
                    <td><?php  echo $row['magError']; ?></td>
                    <td><?php  echo $row['magNst']; ?></td>
                    <td><?php  echo $row['status']; ?></td>
                    <td><?php  echo $row['locationSource']; ?></td>
                    <td><?php  echo $row['magSource']; ?></td>
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
