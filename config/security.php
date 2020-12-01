<?php
$servername = "localhost";
$username = "xxxxxxxxx";
$password = "xxxxxxxxxxx";
$dbname = "xxxxxxxx";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

include 'excel_reader.php';     // include the class
// creates an object instance of the class, and read the excel file data
$excel = new PhpExcelReader;
$company = $_POST['company'];
$allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet','application/octet-stream'];
  $allowedFileType_ = ['xls','xlsx'];
 if(in_array($_FILES["file"]["type"],$allowedFileType))
  {

    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if(in_array($ext, $allowedFileType_))
    {
      $targetPath = 'uploads/'.time().'_'.$_FILES['file']['name'];
       if(move_uploaded_file($_FILES['file']['tmp_name'], $targetPath))
       {

       }else{
        echo 'There is something wrong with file';
       // header("Location:index.php?error=fileupload");
        echo '<script>window.location.href = "index.php?error=fileupload";exit;</script>';
        exit();
       }
    }else{
        echo 'There is something wrong with file';
       // header("Location:index.php?error=fileupload");
        echo '<script>window.location.href = "index.php?error=extension";exit;</script>';
        exit();
       }
  }else
  {
        echo 'File Extension not supported!';
       // header("Location:index.php?error=extension");
         echo '<script>window.location.href = "index.php?error=extension";exit;</script>';
        exit();
  }

$excel->read($targetPath);
//$excel->read("AIT_CIP855_20190711_SIN22_00000495306.xls");
$sheets = $excel->sheets;
$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = array();              // to store the the tables with data of each sheet
// traverses the number of sheets and sets  table with each sheet data in excel_data array
for($i=0; $i<$nr_sheets; $i++) 
{
  $l=1;
  if(count($sheets[$i]['cells'])>3)
  {
    $cells = $sheets[$i]['cells'];
    $preTaxi_Number ='';
    $preTrans_Type ='';
    for($k=1; $k<=count($sheets[$i]['cells']); $k++) 
    {
      if($k>3)
      {
        $Taxi_Number ='';
        if(isset($sheets[$i]['cells'][$k][1]))
        {
          $Taxi_Number = $sheets[$i]['cells'][$k][1];
        }
        $Trans_Type='';
        if(isset($sheets[$i]['cells'][$k][2]))
        {
         $Trans_Type=$sheets[$i]['cells'][$k][2];
        }
        $Trip_Date='';
        if(isset($sheets[$i]['cells'][$k][3]))
        {
          $Trip_Date=$sheets[$i]['cells'][$k][3];
        }
        $Trip_Time='';
        if(isset($sheets[$i]['cells'][$k][4]))
        {
          $Trip_Time=$sheets[$i]['cells'][$k][4];
        }
        $RRN='';
        if(isset($sheets[$i]['cells'][$k][5]))
        {
          $RRN=$sheets[$i]['cells'][$k][5];
        }
        $Terminal='';
        if(isset($sheets[$i]['cells'][$k][6]))
        {
          $Terminal=$sheets[$i]['cells'][$k][6];
        }
        $Driver_DA='';
        if(isset($sheets[$i]['cells'][$k][7]))
        {
          $Driver_DA=$sheets[$i]['cells'][$k][7];
        }
        $Amount='';
        if(isset($sheets[$i]['cells'][$k][8]))
        {
          $Amount=$sheets[$i]['cells'][$k][8];
        }
        $Date_Total='';
        if(isset($sheets[$i]['cells'][$k][9]))
        {
          $Date_Total=$sheets[$i]['cells'][$k][9];

        }
        $Type_Total='';
        if(isset($sheets[$i]['cells'][$k][10]))
        {
          $Type_Total=$sheets[$i]['cells'][$k][10];
        }
        $Taxi_Total='';
        if(isset($sheets[$i]['cells'][$k][11]))
        {
          $Taxi_Total=$sheets[$i]['cells'][$k][11];
        }

        if(trim($Taxi_Number)!='' && trim($Trans_Type)!='')
        {
          $preTaxi_Number =$Taxi_Number;
          $preTrans_Type =$Trans_Type;
        }
        

       // $excel_data[] = array($l,$preTaxi_Number,$preTrans_Type,$Trip_Date,$Trip_Time,$RRN,$Terminal,$Driver_DA,$Amount,$Date_Total,$Type_Total,$Taxi_Total);
        $mydate = strtotime(str_replace('/','-',$Trip_Date).' '.$Trip_Time);

        if($Trip_Date!='')
        {
          $excel_data[] = array($l,$preTaxi_Number,$preTrans_Type,$mydate,$RRN,$Driver_DA,$Amount,$company);
          $l++;
        }
        /*if($Taxi_Number!='' && $Trans_Type!='')
        {
          $preTaxi_Number =$Taxi_Number;
          $preTrans_Type =$Trans_Type;
        }*/
      }
    }
  }
}
if(count($excel_data)>0)
{
  $sql = "INSERT INTO EFTPOS (id,car,dateFor,ref,driver,credit,company) VALUES ";
  $i=0;
  foreach ($excel_data as $txy) 
  {
    if($i>0)
    {
      $sql .=',';
    }
    $i++;
  $sql .= " (NULL,'".trim($txy[1])."','".$txy[3]."','".$txy[4]."','".trim($txy[5])."','".$txy[6]."','".$txy[7]."')";
  }

  if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
    //header("Location:index.php?success=alldone");
    echo '<script>window.location.href = "index.php?success=alldone";exit;</script>';
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  // header("Location:index.php?error=InsertError");
     echo '<script>window.location.href = "index.php?error=InsertError";exit;</script>';
}
}

$conn->close();

?>