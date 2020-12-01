
<?php
  
//include_once 'config.php';
include_once 'config/config.php';
class Dbconfig
{
  function __construct(){
  }
  function __destruct()
  {
    mysqli_close($con);
  }
}
/**
 * Created class for getting data of categories
 */
class Category extends Dbconfig
{
   public function __construct() {
        parent::__construct();
        error_reporting(E_ALL);
        //echo 1111;die;
    }

    function getinvoices_id($accNum,$POST)
    {
      global $con; 
      $sql="SELECT * from invoices";
      $result=mysqli_query($con,$sql);
      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      return $row;

    }

    function Dashboard_data_Report($accNum)
    {
      global $con;

      $sql="SELECT sum(info2) as total_pax,count(id) as open_table FROM `invoices` WHERE acNum=$accNum and invoiceNum<=0 and info1!='' ";
      $result = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
       $total_pax = $row['total_pax'];   
       $open_table = $row['open_table'];
           
          
         $sql="SELECT COUNT(id) as que_order,(SELECT COUNT(id) as picup_order FROM `invoice_items` WHERE acNum=$accNum AND status=3 and id not in (SELECT id FROM `invoice_items` WHERE acNum=$accNum AND status=3 and invoiceNum > 0) ) as picup_order FROM `invoice_items` WHERE acNum=$accNum AND status=2 and id not in (SELECT id FROM `invoice_items` WHERE acNum=$accNum AND status=2 and invoiceNum > 0)"; 


        $result = mysqli_query($con,$sql);
         $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $que_order = $row['que_order']; 
        $picup_order = $row['picup_order']; 
          
        $data=array('picup_order'=>$picup_order,'que_order'=>$que_order,'open_table'=>$open_table,'total_pax'=>$total_pax);
        return $data;
   }
    function Get_item_prepared($accNum,$POST,$id)
    {
      global $con;
      $sql="UPDATE `invoice_items` SET status=3 where id='$id' and acNum='$accNum'";

       echo $res = mysqli_query($con,$sql);
      

    }
    function set_all_prepared($accNum,$POST,$invoiceId)
    {
      global $con;
      $sql="UPDATE `invoice_items` SET status=3 where invoiceId='$invoiceId' and acNum='$accNum' and status in (2,3)";

       echo $res = mysqli_query($con,$sql);
      

    }
    function set_all_pickedup($accNum,$POST,$invoiceId)
    {
      global $con;
      $sql="UPDATE `invoice_items` SET status=4 where invoiceId='$invoiceId' and acNum='$accNum' and status in (2,3)";

       echo $res = mysqli_query($con,$sql);
      

    }
    function Get_item_pickedup($accNum,$POST,$id)
    {
      global $con;
      $sql="UPDATE `invoice_items` SET status=4 where id='$id' and acNum='$accNum'";

       echo $res = mysqli_query($con,$sql);

    }
 
    function getstaff($accNum,$POST)
    {
      global $con;
       $draw = 1;

      $sql="SELECT  * FROM `Staff` WHERE accNum=$accNum and type=4 order by id desc";
      $result=mysqli_query($con,$sql);
       $total_record = mysqli_num_rows($result);
       $p = 0;
       $data_arr = array();
       
        while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
          {
            $p++;
            $categoryArrayid[] = $row;
             // $view_link = "<a href='javascript:void(0)' class='btn btn-primary'java onclick='view_order_details(".$order_id.")'><span class='description'>View </span></a> <a class='btn btn-primary' href='ajax.php?action=download_invoice&order_id=".$order_id."'><span class='description'>Download Invoice </span></a> ";

            $view_link="<a href='javascript:void(0)' data-toggle='modal' data-target='#editMember_model' class='btn btn-primary'java onclick='edit_member(".$row['id'].")'><span class='description'>Edit </span></a>";

             $type = $row['jobType'];
              //Gold=1,silver=2,Bronze=3

              if($type == 1){
                $type = "Gold";
              }

              else if($type == 2){
                $type = "Silver";
              }

              if($type == 3){
                $type = "Bronze";
              }


            $data_arr[]= array($p,$row['name'],$row['mobile'],$row['email'],$row['jobTitle'],$type,$view_link);
            
          }

          

          $data = array("draw"=>$draw , "recordsTotal" => $total_record, "recordsFiltered" => $total_record, "data" => $data_arr);
          return $data;
       
       // return $categoryArrayid;

    }

    function checkActiveSaleRegister($accNum,$userNum)
    {
      global $con;
       $draw = 1;

      $sql="SELECT  * FROM `sale_register` WHERE accNum=$accNum and status=1 and userNum = '$userNum' order by id desc";
      $result=mysqli_query($con,$sql);
      $total_record = mysqli_num_rows($result);
      $p = 0;
      $row = array();
       
      if (mysqli_num_rows($result) > 0 ) 
      {
         $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        
      }

      return $row;
       
       // return $categoryArrayid;

    }
function getopenregisterId($accNum,$userNum)
    {
      global $con;

      // print_r($userNum);

      $sql="SELECT regNo from sale_register where accNum=$accNum and status=1 and userNum='$userNum'";
      $result=mysqli_query($con,$sql);
     
       
      if($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
         $registerId=$row['regNo'];      
      } 
      else
      {
        $registerId=0;
      }
      return $registerId;
        
       
       // return $categoryArrayid;

    }


    function getActiveSaleRegister($accNum,$userNum,$regNo = 0)
    {
      global $con;
       $draw = 1;

       $where = '';

       if($regNo!=0)
       {
          $where = ' and regNo = '.$regNo;
       }

      $sql="SELECT  * FROM `sale_register` WHERE accNum=$accNum and status in (1,0) and userNum = '$userNum' ".$where." order by id desc";
      $result=mysqli_query($con,$sql);
      $total_record = mysqli_num_rows($result);
      $p = 0;
      $data_arr = array();

      $order_details = array();

       $p = 0;
       
      if (mysqli_num_rows($result) > 0 ) 
      {
         $order_details[$p]=mysqli_fetch_array($result,MYSQLI_ASSOC);
         $regNo= $order_details[0]['regNo']; 

          
           $sql_order = "SELECT DISTINCT(invoices.id), invoices.*,trxn.type,trxn.amount  as total_amount, Staff.name,Staff.jobType,(SELECT sum(subtotal)  FROM `invoice_items`  where invoiceId = invoices.id and acNum = $accNum) as invoice_total FROM `invoices` inner join Staff on Staff.staffNum = invoices.clientNum and Staff.accNum='$accNum' inner join invoice_transactions as trxn on trxn.invoiceId = invoices.id  where invoices.invoiceNum>0  and invoices.acNum = $accNum and invoices.bookingId = $regNo "; 


        $result_order=mysqli_query($con,$sql_order);
        //echo mysqli_num_rows($result_users);
        
       

        $total_sale_amount = 0;
        $total_bank_amount = 0;
        $total_cc_amount = 0;
        $total_account_amount = 0;
        $total_cash_amount = 0;

        while($row_order = mysqli_fetch_array($result_order,MYSQLI_ASSOC)){
           // $order_details[$p] = $row_order;

            $total_sale_amount = $total_sale_amount+$row_order['total_amount'];

            $txn_type = $row_order['type'];


            if($txn_type == 1)
            {
              // cash
              $total_cash_amount = $total_cash_amount+$row_order['total_amount'];

            }elseif($txn_type == 2)
            {
              // cc
              $total_cc_amount = $total_cc_amount+$row_order['total_amount'];
            }elseif($txn_type == 3)
            {
              // bank
              $total_bank_amount = $total_bank_amount+$row_order['total_amount'];
            }elseif($txn_type == 4)
            {
              // account
              $total_account_amount = $total_account_amount+$row_order['total_amount'];
            }

            

           // $p++;
        }

           $order_details[$p]['total_cash_amount'] = $total_cash_amount; 
            $order_details[$p]['total_cc_amount'] = $total_cc_amount; 
            $order_details[$p]['total_bank_amount'] = $total_bank_amount; 
            $order_details[$p]['total_account_amount'] = $total_account_amount; 
            $order_details[$p]['total_sale_amount'] = $total_sale_amount; 

        
      }else{
        $regNo = 0;
        $sql_max_id = mysqli_query($con,"SELECT max(regNo) as regNo FROM sale_register");
        if($row_max_id = mysqli_fetch_array($sql_max_id,MYSQLI_ASSOC)){
          $regNo = $row_max_id['regNo'];
        }

        $regNo = $regNo+1;
        $created_at = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `sale_register`(`accNum`, `userNum`, `started_at`, `closed_at`, `opening_balance`, `closing_balance`, `regNo`, `status`,message) VALUES ('$accNum','$userNum','$created_at','$created_at','0','0','$regNo',0,'')"; 

        $result2=mysqli_query($con,$sql);
        $inserted_id = mysqli_insert_id($con);

        $sql="SELECT  * FROM `sale_register` WHERE id=$inserted_id ";
        $result=mysqli_query($con,$sql);
        $total_record = mysqli_num_rows($result);
        $p = 0;
        $order_details = array();
         
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

        $order_details[0] = $row;

        $order_details[0]['total_cash_amount'] = $total_cash_amount; 
        $order_details[0]['total_cc_amount'] = $total_cc_amount; 
        $order_details[0]['total_bank_amount'] = $total_bank_amount; 
        $order_details[0]['total_account_amount'] = $total_account_amount; 
        $order_details[0]['total_sale_amount'] = $total_sale_amount; 
        
      }

      return $order_details;
       
       // return $categoryArrayid;

    }


    function submitOpeningBalance($regNum,$userNum,$opening_balance)
    {
      global $con;
      $draw = 1;
      $current_date = date("Y-m-d H:i:s");

      $sql=" UPDATE `sale_register` SET opening_balance = '$opening_balance',status=1,started_at='$current_date' WHERE userNum='$userNum' and id = '$regNum'";
      $result=mysqli_query($con,$sql);
      
      return $result;
       
       // return $categoryArrayid;

    }

    function submitClosingBalance($regNum,$userNum,$closing_balance,$POST)
    {
      global $con;
       $draw = 1;
       $current_date = date("Y-m-d H:i:s");
       $message=$POST['close_message'];
       // print_r($POST);
        // echo $note = mysqli_real_escape_string($message);die;

// print_r($POST);die;
      

       $sql=" UPDATE `sale_register` SET closing_balance = '$closing_balance',status=2,closed_at='$current_date',message='$message' WHERE userNum='$userNum' and status=1 and id = '$regNum'";
      $result=mysqli_query($con,$sql);
      // echo mysqli_error($con);die;
      return $result;
       
       // return $categoryArrayid;

    }

    function getmemberAdd($accNum,$POST){
    global $con;

    // $accNum = $POST['accNum'];
    $username = $POST['username'];
    $dob = $POST['dob'];
    $mobile = $POST['mobile'];
    $email = $POST['email'];
    $memberNum = $POST['memberNum'];
    $job_type = $POST['job_type'];
    $password = md5($POST['password']);
    $created_at = date("Y-m-d H:i:s");

    $staffNum = 0;
    $sql_max_id = mysqli_query($con,"SELECT max(staffNum) as max_staffNum FROM Staff where accNum = '$accNum'");
    if($row_max_id = mysqli_fetch_array($sql_max_id,MYSQLI_ASSOC)){
      $staffNum = $row_max_id['max_staffNum'];
    }

    $new_staffNum = $staffNum+1;

       $sql = "INSERT INTO `Staff`(`accNum`, `staffNum`, `name`, `code`, `dob`, `mobile`, `email`, `jobType`, `gender`,  `type`, `status`, `Req_tags`, `img`,  `Grouping`) VALUES ('$accNum','$new_staffNum','$username','','$dob','$mobile','$email','$job_type','','4','0','0','0','0')"; 


    $result2=mysqli_query($con,$sql);
   if($result2){
      return $result2;
   }
   else
   {
    // echo mysqli_error($con);
    echo $sql;
   }

  }

  function updateMember_profile($accNum,$POST)
  {
     global $con;
     // print_r($POST);
      $user_id=$POST['user_id'];
      $username = $POST['username'];
      $dob = $POST['dob'];
      $mobile = $POST['mobile'];
      $email = $POST['email'];
      $memberNum = $POST['memberNum'];
      $job_type = $POST['job_type'];

       $sql=" UPDATE `Staff` SET `name`='$username',`dob`='$dob',`mobile`='$mobile',`email`='$email',`jobType`='$job_type',`jobTitle`='$memberNum' WHERE accNum=$accNum and id=$user_id";
       $res = mysqli_query($con,$sql);
       return $res;




  }
  function getMemberdetails($accNum,$POST,$user_id)
  {
       global $con;
       $sql="SELECT * FROM `Staff` WHERE accNum=$accNum and id=$user_id ";

        $result=mysqli_query($con,$sql);
      // $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
         $jobnumarray[]=$row;      
      } 
      return $jobnumarray;

  }


    function getjobItems($accNum,$jobId,$location,$invoiceId)
    {
       global $con;

       // location ecom_item -> info2 

        $sql="SELECT invoice_items.*,ecom_varieties.variety as itemName,ecom_item.info1,ecom_item.itemNum,ecom_varieties.info1 as itemCode from invoice_items inner join ecom_item on ecom_item.itemNum=invoice_items.item_id and ecom_item.accNum=$accNum and ecom_item.info2 = $location inner join ecom_varieties on ecom_varieties.varietyNum=invoice_items.stock_id and ecom_varieties.accNum=$accNum  WHERE invoice_items.jobNumber= '$jobId' and invoice_items.invoiceId=$invoiceId  and invoice_items.acNum=$accNum  and invoice_items.status in(2,3)";

      $result=mysqli_query($con,$sql);
      // $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
        if(empty($row['invoiceNum'])){

         $jobnumarray[]=$row;
        }
      }

      // $jobnumarray['sql'] =  $sql;

      return $jobnumarray;

    }


    function getalljobItems($accNum,$jobId,$location,$invoiceId)
    {
       global $con;

       // location ecom_item -> info2 

      // $sql="SELECT invoice_items.*,ecom_varieties.variety as itemName,ecom_item.info1,ecom_item.itemNum,ecom_varieties.info1 as itemCode from invoice_items inner join ecom_item on ecom_item.itemNum=invoice_items.item_id and ecom_item.accNum=$accNum inner join ecom_varieties on ecom_varieties.varietyNum=invoice_items.stock_id and ecom_varieties.accNum=$accNum  WHERE invoice_items.jobNumber= '$jobId' and invoice_items.invoiceId=$invoiceId  and invoice_items.acNum=$accNum  and invoice_items.status in(2,3)";

      $sql="SELECT invoice_items.*,ecom_varieties.variety as itemName,ecom_item.info1,ecom_item.itemNum,ecom_varieties.info1 as itemCode,invoices.info1 as tableNam from invoice_items inner join ecom_item on ecom_item.itemNum=invoice_items.item_id and ecom_item.accNum=$accNum  inner join ecom_varieties on ecom_varieties.varietyNum=invoice_items.stock_id and ecom_varieties.accNum=$accNum inner join invoices on invoices.id=invoice_items.invoiceId  WHERE invoice_items.jobNumber= '$jobId' and invoice_items.invoiceId=$invoiceId  and invoice_items.acNum=$accNum  and invoice_items.status in(2,3)";

      $result=mysqli_query($con,$sql);
      // $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
      
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
      {
        if(empty($row['invoiceNum'])){
         $jobnumarray[]=$row;
        }
      }

      // $jobnumarray['sql'] =  $sql;
      return $jobnumarray;

    }


    function GetActiveJobs($accNum,$POST)
    {
     global $con; 

     $sql1= mysqli_query($con,"SELECT DISTINCT(info2) as kitchen FROM `ecom_item` where accNum = $accNum order by info2 asc");

     $jobs_data = array();
     $p = 0;
     while($row1=mysqli_fetch_array($sql1,MYSQLI_ASSOC)) 
      {
        if(!empty($row1['kitchen']))
        {
         $jobs_data[$p]["location"] = $row1['kitchen'];
         $jobs_data[$p]["jobs"] = array();
         $location = $row1['kitchen'];



        // $sql= "SELECT i.jobNumber,i.updated_at,i.invoiceId from invoice_items as i inner join invoices on invoices.id=i.invoiceId  where invoices.invoiceNum = 0 and  i.jobNumber!=0 and item_id in (SELECT DISTINCT(itemNum) FROM `ecom_item` where info2 = '$location' and accNum = $accNum) and i. acNum=$accNum group by i.jobNumber ORDER BY timestamp( i.updated_at ) DESC";
          $sql= "SELECT i.jobNumber,i.updated_at,i.invoiceId,invoices.info1 from invoice_items as i inner join invoices on invoices.id=i.invoiceId  where invoices.invoiceNum = 0 and  i.jobNumber!=0 and item_id in (SELECT DISTINCT(itemNum) FROM `ecom_item` where info2 = '$location' and accNum = $accNum) and i. acNum=$accNum group by i.jobNumber ORDER BY timestamp( i.updated_at ) DESC";
        

        $res = mysqli_query($con,$sql);
        while($rowid=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
        {
          $jobs_data[$p]["jobs"][] = $rowid;
        }

        $p++;
        }
      }

     //return $invoices_Id;
     
        
      return $jobs_data;
    
    }


    function GetJobColors($accNum)
    {
     global $con; 
         // $sql= "SELECT DISTINCT(jobNumber) as jobs from invoice_items as i inner join invoices on invoices.id=i.invoiceId  where invoices.invoiceNum = 0 and  i.jobNumber!=0  group by i.jobNumber"; 

         $sql= "SELECT DISTINCT(i.jobNumber) as jobs from invoice_items as i inner join invoices on invoices.id=i.invoiceId  where invoices.invoiceNum = 0 and  i.jobNumber!=0  group by i.jobNumber";
        $res = mysqli_query($con,$sql);
        $p=0;
        $colors = array("FFA500","FFFF00","#f44336","FFFF00","FFFAFA","E6E6FA","6A5ACD");
        while($rowid=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
        {
          $jobs_data[$rowid['jobs']] = $colors[$p];
          $p++;
        }
        //print_r($jobs_data);
      return $jobs_data;
    
    }


    function  categories_item_list($accNum)
    {
      global $con;
      $sql="SELECT * FROM `ecom_categories` where parent!=0 and accNum=$accNum";
      $res = mysqli_query($con,$sql);
      //$row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $categoryArrayid=array();
      while ($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
      {
        $categoryArrayid[] = $row;
      }
       mysqli_free_result($res);
       return $categoryArrayid;

    }

    function getCategoryItems($accNum,$POST)
    {
     global $con;
     $selected_cat=$POST['selected_cat'];
     //$sql="SELECT ecom_item .* FROM ecom_item INNER JOIN ecom_menu_categary ON ecom_menu_categary.itemNum= ecom_item.itemNum where ecom_menu_categary.categoryNum=$selected_cat"; 


     // $sql = "SELECT items.*,var.price,var.varietyNum,var.info1 as itemCode,var.info2 as gst,v.itemName FROM `ecom_item` as items left join ecom_varieties as var on var.itemNum = items.itemNum left join ecom_variety as v on v.varietyNum = var.variety INNER JOIN ecom_menu_categary as mc ON mc.itemNum= items.itemNum where items.accNum=$accNum and mc.categoryNum=$selected_cat";
       $sql = "SELECT items.*,var.price,var.varietyNum,var.info1 as itemCode,var.info2 as gst,v.itemName FROM `ecom_item` as items left join ecom_varieties as var on var.itemNum = items.itemNum left join ecom_variety as v on v.varietyNum = var.variety INNER JOIN ecom_menu_categary as mc ON mc.itemNum= items.itemNum where items.accNum=$accNum and mc.categoryNum=$selected_cat";

      $res = mysqli_query($con,$sql);
      $categoryArrayList=array();
      while ($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
      {
        $categoryArrayList[] = $row;
      }
      // return json_encode($categoryArrayList);
      return $categoryArrayList;

    }
     function getALLEcom_Items($accNum,$POST)
    {
     global $con;
     // $selected_cat=$POST['selected_cat'];
    
       $sql = "SELECT items.*,var.price,var.varietyNum,var.info1 as itemCode,var.info2 as gst,v.itemName FROM `ecom_item` as items left join ecom_varieties as var on var.itemNum = items.itemNum left join ecom_variety as v on v.varietyNum = var.variety INNER JOIN ecom_menu_categary as mc ON mc.itemNum= items.itemNum where items.accNum=$accNum and mc.categoryNum=$selected_cat";

      $res = mysqli_query($con,$sql);
      $categoryArrayList=array();
      while ($row=mysqli_fetch_array($res,MYSQLI_ASSOC)) 
      {
        $categoryArrayList[] = $row;
      }
      // return json_encode($categoryArrayList);
      return $categoryArrayList;

    }
    

    function dashboard_data($accNum)
    {
      global $con;
      // $sql="SELECT count(1) as total_order FROM `invoice` where invoiceNum!=0";

      $sql="SELECT count(1) as total_order FROM `invoices` where invoiceNum!=0";
      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $total_order = $row['total_order'];

      // $sql="SELECT count(1) as open_table FROM `invoice` where invoiceNum=0";
      $sql="SELECT count(1) as open_table FROM `invoices` where invoiceNum=0";

      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $open_table = $row['open_table'];

      // $sql="SELECT count(1) as que FROM `invoice_items` where jobNumber!=0";
      $sql="SELECT count(1) as que FROM `invoice_items` where jobNumber!=0";
      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $que_items = $row['que'];
    }

  public function insertConfirmedItem($accNum,$POST)
  {
      global $con;
        $invoiceId=$POST['invoiceId'];

       $itemCode = $POST['itemCode'];
       $itemId = $POST['itemId'];
       $item_quantity = $POST['item_quantity'];
       $search_member = $POST['search_member'];
       $created_at = date("Y-m-d H:i:s");
       $temp_cart_id = rand(99999999, 999999999);

       
        $sql =  "SELECT * FROM `ecom_varieties` where info1=$itemCode and accNum = $accNum";

        $result=mysqli_query($con,$sql);
        $row_data=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $itemNum = $row_data['itemNum'];
        $price = $row_data['price'];
        $gst = 10;//$row_data['info2'];
        $percentage = $row_data['info2'];
        $stock_id = $row_data['varietyNum'];
        $subtotal = $price*$item_quantity;
        $staffNum = $search_member;

       $sql="SELECT max(jobNumber) as jobNumber FROM `invoice_items`";
       $res = mysqli_query($con,$sql);
       $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
       $jobNumber=$row['jobNumber'];
       $newjob=$jobNumber+1;

     $menu_name_sql = mysqli_query($con,"SELECT info1 FROM `ecom_item` where itemNum =".$itemNum." and accNum = $accNum");

      $menu_result=mysqli_fetch_array($menu_name_sql,MYSQLI_ASSOC);
      $menu_name = $menu_result['info1'];


      if($itemId == 0){
          $sql = "INSERT INTO `invoice_items`(`acNum`, `invoiceId`, `product`,item_id, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `staffNum`, `status`, `createdAt`, `updated_at`, `jobNumber`) VALUES ('$accNum','$invoiceId','$menu_name','$itemNum','$item_quantity','$price','$gst','$percentage','$subtotal','$stock_id','$staffNum',2,'$created_at','$created_at','$newjob')"; 
      }else{
         $sql = "UPDATE `invoice_items` SET `acNum`='$accNum',`invoiceId`='$invoiceId',`product`='$menu_name',`item_id`='$itemNum',`qty`='$item_quantity',`unit_price`='$price',`unit_gst`='$gst',`percentage`='$percentage',`subtotal`='$subtotal',`stock_id`='$stock_id',`updated_at`='$created_at',jobNumber='$newjob',status=2 WHERE id=$itemId";
      }
     // echo $sql;
      
      echo $res = mysqli_query($con,$sql);
  }

    function confirmInvoice($accNum,$POST)
    {
      global $con;
      //print_r($POST);
      $invoice_id=$POST['invoice_id'];
      // $sgst_amount=$POST['sgst_amount'];
      // $cgst_amount=$POST['cgst_amount'];
      // $extra_amount=$POST['extra_amount'];
      $sql="SELECT max(invoiceNum) as invoiceNum FROM `invoices` where acNum = $accNum";
      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $invoiceNum=$row['invoiceNum'];
      $newinvoiceNum=$invoiceNum+1;


      $sql_order2 = "SELECT sum(subtotal) as invoice_amount,(SELECT sum(amount) FROM invoice_transactions where invoiceId = $invoice_id ) as txn_amount FROM `invoice_items` where invoiceId = $invoice_id and acNum = $accNum ";
      $result_order2=mysqli_query($con,$sql_order2);

      $result_txn=mysqli_fetch_array($result_order2,MYSQLI_ASSOC);
      $invoice_price=$result_txn['invoice_amount'];
      $received_price=$result_txn['txn_amount'];

      $sql_update="UPDATE `invoices` SET `invoiceNum`='$newinvoiceNum' WHERE id = $invoice_id";
      $res = mysqli_query($con,$sql_update);

      $sql_update="UPDATE `invoice_items` SET `invoiceNum`='$newinvoiceNum' WHERE invoiceId = $invoice_id";
      $res = mysqli_query($con,$sql_update);
      return $res;

    }

    function update_client_onInvoice($accNum,$POST)
    {
      global $con;
      //print_r($POST);
      $invoice_id=$POST['invoiceId'];
      $clientNum=$POST['clientNum'];
      // $sgst_amount=$POST['sgst_amount'];
      // $cgst_amount=$POST['cgst_amount'];
      // $extra_amount=$POST['extra_amount'];
      $sql_clientNum="SELECT jobType FROM Staff where accNum=$accNum and staffNum=$clientNum";
       $result = mysqli_query($con,$sql_clientNum);
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);

     

      $sql_update="UPDATE `invoices` SET `clientNum`='$clientNum',is_guest=0 WHERE id = $invoice_id";
      $res = mysqli_query($con,$sql_update);


      $sql_update="UPDATE `invoice_items` SET `staffNum`='$clientNum' WHERE invoiceId = $invoice_id";
      $res = mysqli_query($con,$sql_update);

      $res=$row['jobType'];
      return $res;

    }

    function InsertOrderPayment($POST)
    {
      global $con;
      // print_r($POST);die;
      $invoice_id=$POST['invoice_id'];
      $regNo=$POST['regNo'];
      $accNum=$POST['accNum'];
      $invoicenum=$POST['invoicenum'];
      $pay_discount=$POST['pay_discount'];
      $total_discount_price=$POST['total_discounted_item_price'];
      
      $pay_amount=$POST['pay_amount'];
      $payment_type=$POST['payment_type'];
      $created_at = date("Y-m-d H:i:s");

      if(empty($invoicenum))
      {

        $sql="SELECT invoiceNum FROM `invoices` where acNum = $accNum and id = $invoice_id";

        $res = mysqli_query($con,$sql);
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $invoiceNum=$row['invoiceNum'];

        if(empty($invoicenum))
        {
          $sql="SELECT max(invoiceNum) as invoiceNum FROM `invoices` where acNum = $accNum";
          $res = mysqli_query($con,$sql);
          $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
          $invoiceNum=$row['invoiceNum'];
          $invoiceNum = $newinvoiceNum=$invoiceNum+1;

          $sql_update="UPDATE `invoices` SET `invoiceNum`='$newinvoiceNum'  WHERE id = $invoice_id";
          $res = mysqli_query($con,$sql_update);

          $sql_update="UPDATE `invoice_items` SET `invoiceNum`='$newinvoiceNum' WHERE invoiceId = $invoice_id";
          $res = mysqli_query($con,$sql_update);
        }
      }



      // insert Discount in new item

      if($pay_discount > 0)
      {

         $sql="SELECT max(CAST(jobNumber as UNSIGNED)) as jobNumber FROM `invoice_items` ";
          $res = mysqli_query($con,$sql);
          $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
          $jobNumber=$row['jobNumber'];
          $newjob=$jobNumber+1;
// echo "<br>================744=====<br>";

        $sql2 = "INSERT INTO `invoice_items`(`acNum`, `invoiceNum`, `invoiceId`, `product`, `item_id`, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `staffNum`, `status`, `createdAt`, `updated_at`, `jobNumber`) VALUES ('$accNum','$invoiceNum','$invoice_id','Regular Discount','0','1','-".$pay_discount."','0','0','-".$pay_discount."','0','0','4','$created_at','$created_at','$newjob')";


        $res = mysqli_query($con,$sql2);

      }

     if($total_discount_price > 0)
      {

        $created_atD = date("Y-m-d H:i:s",strtotime("+1 minutes"));

         $sql3="SELECT max(CAST(jobNumber as UNSIGNED)) as jobNumber FROM `invoice_items` ";
          $res3 = mysqli_query($con,$sql3);
          $row=mysqli_fetch_array($res3,MYSQLI_ASSOC);
          $jobNumber=$row['jobNumber'];
          $newjob=$jobNumber+1;
// echo "<br>================761=====<br>";

      $sql4 = "INSERT INTO `invoice_items`(`acNum`, `invoiceNum`, `invoiceId`, `product`, `item_id`, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `staffNum`, `status`, `createdAt`, `updated_at`, `jobNumber`) VALUES ('$accNum','$invoiceNum','$invoice_id','Membership Discount','0','1','-".$total_discount_price."','0','0','-".$total_discount_price."','0','0','4','$created_atD','$created_atD','$newjob')";

        $res2 = mysqli_query($con,$sql4);

      }
      

      

      $sql="SELECT max(transactionNum) as transactionNum FROM `invoice_transactions` ";
      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $transactionNum=$row['transactionNum'];
      $transactionNum=$transactionNum+1;

        $sql_update1="UPDATE `invoices` SET `invoiceNum`='$newinvoiceNum',bookingId=$regNo WHERE id = $invoice_id";
       $res = mysqli_query($con,$sql_update1);



// echo "<br>================783====<br>";
      $sql="INSERT INTO `invoice_transactions`( `acNum`, `transactionNum`, `invoiceNum`, `invoiceId`, `bank_id`, `date`, `type`, `amount`, `reff`, `date_created`, `date_updated`) VALUES ('$accNum','$transactionNum','$invoiceNum','$invoice_id','0','$created_at','$payment_type','$pay_amount','0','$created_at','$created_at')";

      $res = mysqli_query($con,$sql);
      
      return $res;

    }

    function confirmitems($accNum,$POST)
    {
      global $con;
      //print_r($POST);
      $invoice_id=$POST['invoice_id'];
      $sql="SELECT max(CAST(jobNumber as UNSIGNED)) as jobNumber FROM `invoice_items` ";
      $res = mysqli_query($con,$sql);
      $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
      $jobNumber=$row['jobNumber'];
      $newjob=$jobNumber+1;

       $sql_update="UPDATE invoice_items set jobNumber=$newjob,status=2 where invoiceId = $invoice_id and jobNumber=0"; 

      $res = mysqli_query($con,$sql_update);
      return $res;
       }
    function CreateNewTable($accNum,$POST){
      global $con;
     
      $table = $POST['table'];
      $pax = $POST['pax'];
      $department_id = $POST['department_id'];

      $created_at = date("Y-m-d H:i:s");
      $quoteNumber = 0;

      // $sql_quoteNum = mysqli_query($con,"SELECT max(quoteNum) as max_quoteNum FROM invoices where acNum = '$accNum'");

         $sql_quoteNum = mysqli_query($con,"SELECT max(quoteNum) as max_quoteNum FROM invoices where acNum = '$accNum'");

      if($row_quoteNum = mysqli_fetch_array($sql_quoteNum,MYSQLI_ASSOC)){
        $quoteNumber = $row_quoteNum['max_quoteNum'];
      }
      $quoteNumber = $quoteNumber+1;

       $sql = "INSERT INTO `invoices`(`acNum`, `invoiceNum`, `jobNumber`, `quoteNum`, `rcNum`, `info1`, `bookNum`, `comNum`, `invoiceSch`, `from_date`, `to_date`, `dueIn`, `clientNum`, `invType`, `bookingId`, `date_created`, `date_updated`, `status`,`info2`) VALUES ('$accNum','0','0','$quoteNumber','$department_id','$table','1','1','0','$created_at','$created_at','0','0','1','0','$created_at','$created_at','1','$pax')"; 

        // $sql = "INSERT INTO `invoices`(`acNum`, `invoiceNum`, `jobNumber`, `quoteNum`, `rcNum`, `info1`, `bookNum`, `comNum`, `invoiceSch`, `from_date`, `to_date`, `dueIn`, `clientNum`, `invType`, `bookingId`, `date_created`, `date_updated`, `status`) VALUES ('$accNum','0','0','$quoteNumber','$department_id','$table','1','1','0','$created_at','$created_at','0','1','1','1','$created_at','$created_at','1')";

      
      $res = mysqli_query($con,$sql);

      $invoice_id = mysqli_insert_id($con);

      $arr= array(
        'table'=>$table,
        'invoice_id'=> $invoice_id
      );

       $result_data= $arr;
       return $result_data;
    }


  function AddIvoiceItems($accNum,$POST){
  global $con;
 
  $itemCode = $POST['itemCode'];
  $invoiceId = $POST['invoiceId'];
  $item_quantity = $POST['item_quantity'];
  $itemId = $POST['itemId'];
  $search_member = $POST['search_member'];
  $created_at = date("Y-m-d H:i:s");
  $temp_cart_id = rand(99999999, 999999999);

  $sql =  "SELECT * FROM `ecom_varieties` where info1=$itemCode";

  $result=mysqli_query($con,$sql);
  $row_data=mysqli_fetch_array($result,MYSQLI_ASSOC);
  $itemNum = $row_data['itemNum'];
  $price = $row_data['price'];
  $gst = 10;//$row_data['info2'];
  $percentage = $row_data['info2'];
  $stock_id = $row_data['varietyNum'];
  $subtotal = $price*$item_quantity;
  $staffNum = $search_member;

  $menu_name_sql = mysqli_query($con,"SELECT info1 FROM `ecom_item` where itemNum =".$itemNum);

  $menu_result=mysqli_fetch_array($menu_name_sql,MYSQLI_ASSOC);
  $menu_name = $menu_result['info1'];


  if($itemId == 0){
    $sql = "INSERT INTO `invoice_items`(`acNum`, `invoiceId`, `product`, `item_id`, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `staffNum`, `status`, `createdAt`, `updated_at`, `jobNumber`) VALUES ('$accNum','$invoiceId','$menu_name','$itemNum','$item_quantity','$price','$gst','$percentage','$subtotal','$stock_id','$staffNum',1,'$created_at','$created_at','0')";
  }else{
    $sql = "UPDATE `invoice_items` SET `acNum`='$accNum',`invoiceId`='$invoiceId',`product`='$menu_name',`item_id`='$itemNum',`qty`='$item_quantity',`unit_price`='$price',`unit_gst`='$gst',`percentage`='$percentage',`subtotal`='$subtotal',`stock_id`='$stock_id',`updated_at`='$created_at' WHERE id=$itemId";
  }
  // echo $sql;
  
  echo $res = mysqli_query($con,$sql);
   
}

function update_paxNumber($accNum,$POST)
{
  global $con;
  $pax_number=$POST['paxNumber'];
  $invoice_id=$POST['invoice_id'];
  // print_r($POST);die;
   $sql="UPDATE `invoices` SET `info2`='$pax_number' where id='$invoice_id'";

  echo $res = mysqli_query($con,$sql);
}

function deleteItemInvoice($id){
  global $con;
  $sql = "DELETE FROM `invoice_items` WHERE id = '$id'";
  mysqli_query($con,$sql);
}

function getContactDetails($accNum){
  global $con;
  $sql = "SELECT * FROM `profile` WHERE accNum = $accNum";
  $result=mysqli_query($con,$sql);
  $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
  return $row;
}
function getTopCategories($accNum)
{
  global $con;
  // images.type 4 = Category thumb 
    $sql = "SELECT categories.*,concat('".SITE_URL."assets/images/".$accNum."/',images.imageName) as image FROM `categories` LEFT JOIN images  ON categories.categoryNum = images.Num WHERE categories.accNum = $accNum and images.type=3";
    $where .= " AND parent = 0"; //[top]
    if($where!='')
    {
      $sql .= $where;
    }
    $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getToptwoCategories($accNum)
{ 
  global $con;
   $sql = "SELECT * FROM `categories` WHERE `accNum` = $accNum ";
    $where .= " AND parent = 0 LIMIT 2"; //[top]
    if($where!='')
    {
      $sql .= $where;
    }
    $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getAllMenuIdAccount ($accNum,$cat_id)
{
    global $con;
    if($cat_id > 0)
    {
      $sql ="SELECT distinct(menuNum) FROM menu_categary WHERE accNum = $accNum and categoryNum = $cat_id";
    }else{
      $sql ="SELECT distinct(menuNum) FROM menu_categary WHERE accNum = $accNum and categoryNum in (SELECT categoryNum FROM `categories` where type=2)";
    }
    //echo $sql;
     $result=mysqli_query($con,$sql);
     $menuArray = array();
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $menuArray[] = $row['menuNum'];
    } 
     return $menuArray;
}
function getCategoryTree($accNum,$parent_id = 0, $sub_mark = '')
{
  global $con;
    $sql ="SELECT * FROM categories WHERE parent = $parent_id  AND accNum = $accNum ";
     $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray =  ''.$sub_mark.$row['categoryName'].'<br>';
      $this->getCategoryTree( $accNum ,$row['categoryNum'], $sub_mark.'---');
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getCategoryTreeView($accNum,$parent_id = 0, $i = 0,$categoryArray = array())
{
  global $con;
    $sql ="SELECT * FROM categories WHERE parent = $parent_id  AND accNum = $accNum and status not in(7,9,0) and type = 1";
     $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
        $categoryArray[$i]['main'] =  $row;
        $categoryNum =  $row['categoryNum'];
      if($categoryNum != 0){
        $sql2 ="SELECT * FROM categories WHERE parent = $categoryNum  AND accNum = $accNum and status not in(7,9,0) and type = 1";
        $result2=mysqli_query($con,$sql2);
        $j = 0;
        while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
        {
            $categoryArray[$i]['lavel1'][$j] = $row2;
            $categoryNum2 =  $row2['categoryNum'];
            $sql3 ="SELECT * FROM categories WHERE parent = $categoryNum2  AND accNum = $accNum and status not in(7,9,0) and type = 1";
            $result3=mysqli_query($con,$sql3);
            $k = 0;
            while ($row3=mysqli_fetch_array($result3,MYSQLI_ASSOC)) 
            {
                $categoryArray[$i]['lavel1'][$j]["lavel2"][$k] = $row3;
                $categoryNum3 =  $row3['categoryNum'];
                $sql4 ="SELECT * FROM categories WHERE parent = $categoryNum3  AND accNum = $accNum and status not in(7,9,0) and type = 1";
                $result4=mysqli_query($con,$sql4);
                while ($row4=mysqli_fetch_array($result4,MYSQLI_ASSOC)) 
                {
                    $categoryArray[$i]['lavel1'][$j]["lavel2"][$k]['lavel3'][] = $row4;
                }
                $k++;
            }
            $j++;
        }
      }
      $i++;
    $this->getCategoryTreeView( $accNum ,$row['categoryNum'],$i,$categoryArray);
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getMainCategories($accNum,$parent_id){
    global $con;
    $sql = "SELECT DISTINCT (categories.categoryNum), categories.*,concat('https://testing.staffstarr.com/its-admin/assets/images/".$accNum."/',images.imageName) as image,(SELECT categoryName from categories where categoryNum = '".$parent_id."') as parent_cat_name FROM categories LEFT JOIN images  ON categories.categoryNum = images.Num WHERE categories.accNum = '".$accNum."' and categories.parent = '".$parent_id."' and images.type=3 ";
    $result=mysqli_query($con,$sql);
    // Associative array
    $cat_images = array('1.jpg','2.jpg','3.jpg','4.jpg','5.jpg','6.jpg');
    $k = 0;
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[$k] = $row;
      //$categoryArray[$k]['image'] = SITE_URL."assets/images/".$accNum."/7_fixed/".$cat_images[$k];
      $k++;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getMenuItems($accNum,$menu_ids){
    global $con;
    $sql = "SELECT menu.*,categories.*,(SELECT concat('https://testing.staffstarr.com/its-admin/assets/images/".$accNum."/',images.imageName) as image from images where images.Num = menu.menuNum and images.type= 1 and images.accNum=".$accNum." limit 1) as image,(SELECT concat('https://testing.staffstarr.com/its-admin/assets/images/".$accNum."/',images.imageName) as image from images where images.Num = menu.menuNum and images.type= 2 and images.accNum=".$accNum." limit 1) as image_thumb ,(select concat('https://testing.staffstarr.com/its-admin/assets/images/".$accNum."/',images.imageName) from images where images.Num = categories.categoryNum AND images.type =1) as category_image ,(SELECT discountType from varieties where varieties.menuNum = menu.menuNum and discountType > 0 limit 1) as discountType,(SELECT min(price) from varieties where varieties.menuNum = menu.menuNum limit 1) as min_price FROM menu left join categories on categories.categoryNum = menu.categoryNum WHERE categories.accNum = '".$accNum."' and menu.status not in(7,9,0) AND menu.menuNum in(".$menu_ids.")";
    $result=mysqli_query($con,$sql);
    // Associative array
    //$categoryArray[0]["sql"] = $sql;
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getAllItems($accNum){
    global $con;
    //   $sql = "SELECT items.*,var.price,var.varietyNum,var.info1 as itemCode,var.info2 as gst,v.itemName FROM `ecom_item` as items left join ecom_varieties as var on var.itemNum = items.itemNum left join ecom_variety as v on v.varietyNum = var.variety where items.accNum=$accNum";
    // $result=mysqli_query($con,$sql);

      $sql = "SELECT items.*,var.price,var.varietyNum,var.info1 as itemCode,var.info2 as gst,v.itemName FROM `ecom_item` as items left join ecom_varieties as var on var.itemNum = items.itemNum left join ecom_variety as v on v.varietyNum = var.variety INNER JOIN ecom_menu_categary as mc ON mc.itemNum= items.itemNum where items.accNum=$accNum ";
      $result=mysqli_query($con,$sql);


    // Associative array
    //$categoryArray[0]["sql"] = $sql;
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    // mysqli_free_result($result);
    return $categoryArray;
}
function getAllMembers($accNum){
    global $con;
    
    $sql="SELECT  id,staffNum,`name`, `mobile`, `email`, `jobType`, `jobTitle`, `JobStatus` FROM `Staff` WHERE accNum=$accNum and type=4 order by id desc ";
    $result=mysqli_query($con,$sql);
    $total_record = mysqli_num_rows($result);
    $p = 0;
    $data_arr = array();
     
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $data_arr[$p] = $row;
      $type = $row['jobType'];
      //Gold=1,silver=2,Bronze=3

      if($type == 1){
        $type = "Gold";
      }

      else if($type == 2){
        $type = "Silver";
      }

      if($type == 3){
        $type = "Bronze";
      }

      $data_arr[$p]['jobType'] = $type;

      $p++;
    }
    // mysqli_free_result($result);
    return $data_arr;
}
function getCategoriesTree($accNum)
{
  global $con;
  $sql = "SELECT t1.categoryName AS level_1,t1.categoryNum AS level_1_id, t2.categoryName as level_2,t2.categoryNum as level_2_id, t3.categoryName as level_3,t3.categoryNum as level_3_id, t4.categoryName as level_4, t4.categoryNum as level_4_id ,t1.status as level1_status,t2.status as level2_status,t3.status as level3_status,t4.status as level4_status FROM categories AS t1  LEFT JOIN categories AS t2 ON t2.parent = t1.categoryNum LEFT JOIN categories AS t3 ON t3.parent = t2.categoryNum LEFT JOIN categories AS t4 ON t4.parent = t3.categoryNum WHERE t1.accNum = '".$accNum."' AND  t1.parent =0";
  $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      if($row['level1_status'] != 7)
      {
        
        if($row['level2_status'] != 7)
        {
          
          if($row['level3_status'] != 7)
          {
           
            if($row['level4_status'] != 7)
            {
              
            }else{
                $row['level_4'] = "";
                $row['level_4_id'] = "";
              }
          }else{
            $row['level_3'] = "";
            $row['level_3_id'] = "";
          }
        }else{
          $row['level_2'] = "";
          $row['level_2_id'] = "";
        }
          $categoryArray[] = $row;
      }
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getCategoryData($accNum,$categoryNum)
{
  global $con;
    $sql = "SELECT categories.*,concat('".SITE_URL."assets/images/".$accNum."/',images.imageName) as image  FROM categories LEFT JOIN images  ON categories.parent = images.Num WHERE categories.accNum = '".$accNum."' AND categories.categoryNum = '".$categoryNum."' AND images.type =3 ";
    $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getItemData($accNum,$menuID)
{
  global $con;
    $sql = "SELECT menu.*,categories.*,category.child,category.type,category.cat_img,category.lft,category.rgt,category.status,category.created_at,category.updated_at  FROM menu LEFT JOIN categories ON menu.categoryNum = categories.categoryNum LEFT JOIN category  ON categories.parent = category.categoryNum   WHERE menu.status not in(7,9,0) and categories.accNum = '".$accNum."'";
    $result=mysqli_query($con,$sql);
    // Associative array
    while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $categoryArray[] = $row;
    }
    mysqli_free_result($result);
    return $categoryArray;
}
function getVarietiesdata($varietyNum){
    global $con;
    $sql_varieties = "SELECT price FROM varieties where varietyNum = $varietyNum";
    $result2=mysqli_query($con,$sql_varieties);
    if ($row_varieties=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
    {
      $price = $row_varieties['price'];
    }
    return $price;
}

function getInvoiceDetails($accNum,$invoiceId,$where=""){  
  global $con;
  //$sql_order = "SELECT orders.*,user_address.address,user_address.address1,user_address.city,user_address.state,user_address.zip,user_address.country,users.username,users.email FROM orders left join user_address on user_address.id=orders.delivery inner join users on users.id=orders.user_id where order_id = '$order_id' and orders.accNum = $accNum";
  $sql_order = "SELECT invoices.*, Staff.jobType  FROM invoices left join  Staff on invoices.clientNum=Staff.staffNum  where invoices.id = '$invoiceId' and invoices.acNum = $accNum";
  $result_order=mysqli_query($con,$sql_order);
  //echo mysqli_num_rows($result_users);
  $order_details = array();
  if($row_order = mysqli_fetch_array($result_order,MYSQLI_ASSOC)){
      $order_details['order_details'] = $row_order;
      $order_details['order_details']['order_id'] = $row_order['invoiceNum'];
      $order_details['order_details']['created_at'] = $row_order['date_created'];
      $order_details['order_details']['address'] = '';
      $order_details['order_details']['address1'] = '';
      $order_details['order_details']['city'] = '';
      $order_details['order_details']['state'] = '';
      $order_details['order_details']['zip'] = '';
      $order_details['order_details']['country'] = '';
      $order_details['order_details']['payment_type'] = 'COD';

      $order_details['order_details']['items_now'] = array();
      $order_details['order_details']['items_full'] = array();


      $sql_order2 = "SELECT invoice_items.*,menu.info1,menu.info5 as gst,menu.info3,variety.itemName,varieties.price as perItemPrice,varieties.info1 as itemCode,varieties.discountType FROM `invoice_items` left join ecom_varieties as varieties on varieties.varietyNum = invoice_items.stock_id left join ecom_variety as variety on variety.varietyNum = varieties.variety left join ecom_item as menu on menu.itemNum = varieties.itemNum where invoiceId = $invoiceId and jobNumber=0";
      $result_order2=mysqli_query($con,$sql_order2);
      $p=0;
      while($row_order2 = mysqli_fetch_array($result_order2,MYSQLI_ASSOC)){
        $order_details['order_details']['items_now'][$p] = $row_order2;
        $order_details['order_details']['items_now'][$p]['price'] = $row_order2['subtotal'];
        $order_details['order_details']['items_now'][$p]['quantity'] = $row_order2['qty'];
        $order_details['order_details']['discountType'] = $row_order2['discountType'];

        $gst=$row_order2['gst'];

        $gst_arr=explode(":",$gst);

        $subtotal=$row_order2['subtotal'];

        $sgst=0;
        $cgst=0;
        if($subtotal>0 && $gst_arr[0]>0)
        {
           $sgst=$subtotal*$gst_arr[0]/100;
        }
         if($subtotal>0 && $gst_arr[1]>0)
         {
           $cgst=$subtotal*$gst_arr[1]/100;
         }

        $order_details['order_details']['items_now'][$p]['sgst'] = $sgst;
        $order_details['order_details']['items_now'][$p]['cgst'] = $cgst;
        $p++;
      }

      $where_condition = "";

      if($where!="")
      {
        $where_condition.=" and ".$where;
      }


     $sql_order2 = "SELECT invoice_items.*,menu.info1,menu.info5 as gst,menu.info3,variety.itemName,varieties.price as perItemPrice,varieties.info1 as itemCode,varieties.discountType FROM `invoice_items` left join ecom_varieties as varieties on varieties.varietyNum = invoice_items.stock_id left join ecom_variety as variety on variety.varietyNum = varieties.variety left join ecom_item as menu on menu.itemNum = varieties.itemNum where invoiceId = $invoiceId and jobNumber!=0".$where_condition;
      $result_order2=mysqli_query($con,$sql_order2);
      $p=0;
      while($row_order2 = mysqli_fetch_array($result_order2,MYSQLI_ASSOC)){
        $order_details['order_details']['items_full'][$p] = $row_order2;
        $order_details['order_details']['items_full'][$p]['price'] = $row_order2['subtotal'];
        $order_details['order_details']['items_full'][$p]['quantity'] = $row_order2['qty'];
        $order_details['order_details']['discountType'] = $row_order2['discountType'];
        
         $gst=$row_order2['gst'];

        $gst_arr=explode(":",$gst);

        $subtotal=$row_order2['subtotal'];

        $sgst=0;
        $cgst=0;
        if($subtotal>0 && $gst_arr[0]>0)
        {
           $sgst=$subtotal*$gst_arr[0]/100;
        }
         if($subtotal>0 && $gst_arr[1]>0)
         {
           $cgst=$subtotal*$gst_arr[1]/100;
         }

        $order_details['order_details']['items_full'][$p]['sgst'] = $sgst;
        $order_details['order_details']['items_full'][$p]['cgst'] = $cgst;
        $p++;
      }
  }
  return $order_details;
}

function GetReports($accNum,$post){  
  global $con;

  $date_from = date("Y-m-d H:i:s",strtotime($post['date_from']));
  $date_to = date("Y-m-d H:i:s",strtotime($post['date_to']));
  $department_id = $post['department_select'];
  $payment_type = $post['payment_type'];
  $where= "";
    if($department_id!="")
    {
      $where.=" and rcNum='$department_id' ";
    }
    if($payment_type!="")
    {
      $where.=" and  trxn.type = '$payment_type' ";
    }

 /* $sql_order = "SELECT invoices.*,trxn.amount as total_amount,Staff.name,Staff.jobType FROM `invoices` inner join Staff on Staff.staffNum = invoices.clientNum and Staff.accNum='$accNum' inner join invoice_transactions as trxn on trxn.invoiceId = invoices.id  where invoices.date_created < '$date_to' and invoices.date_created > '$date_from' and rcNum ='$department_id' and invoices.invoiceNum>0 and trxn.type = '$payment_type' and invoices.acNum = $accNum";*/

   $sql_order = "SELECT DISTINCT(invoices.id),invoices.*,trxn.amount as total_amount,Staff.name,Staff.jobType FROM `invoices` inner join Staff on Staff.staffNum = invoices.clientNum and Staff.accNum='$accNum' inner join invoice_transactions as trxn on trxn.invoiceId = invoices.id  where invoices.date_created < '$date_to' and invoices.date_created > '$date_from' and  invoices.invoiceNum>0  and invoices.acNum = $accNum".$where; 


  $result_order=mysqli_query($con,$sql_order);
  //echo mysqli_num_rows($result_users);
  $order_details = array();
  $p = 0;
  while($row_order = mysqli_fetch_array($result_order,MYSQLI_ASSOC)){
      $order_details[$p] = $row_order;

      $invoiceId = $row_order['id'];

      $sql_order2 = "SELECT subtotal FROM `invoice_items`  where invoiceId = $invoiceId and acNum = $accNum";
      $result_order2=mysqli_query($con,$sql_order2);
      $p=0;
      $invoice_total = 0;
      while($row_order2 = mysqli_fetch_array($result_order2,MYSQLI_ASSOC)){
        $amount = $row_order2['subtotal'];
        $invoice_total = $invoice_total+$amount;
      }

      $order_details[$p]['invoice_total'] = $invoice_total;
      $p++;

  }
  return $order_details;
}

function Register_history($accNum,$userNum)
{
  global $con;
   $sql="SELECT `started_at`, `closed_at`, `opening_balance`, `closing_balance`, `regNo` FROM `sale_register` WHERE status in (2,1) and accNum=$accNum and userNum=$userNum order by regNo desc";
  $result=mysqli_query($con,$sql);

  while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      //print_r($row_menu);
      $RegArray[] = $row;
    }
    return $RegArray;
}
function GetRegister_Download_XLSX($accNum,$userNum,$regNo)
{
  global $con;
  //  $sql="SELECT  `started_at`, `closed_at`, `opening_balance`, `closing_balance` FROM `sale_register` WHERE status=2 and accNum=$accNum and userNum=$userNum and regNo=$regNo";
  // $result=mysqli_query($con,$sql);

  // while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
  //   {
  //     //print_r($row_menu);
  //     $RegArray[] = $row;
  //   }
  //   return $RegArray;



    $sql_order = "SELECT DISTINCT(invoices.id), invoices.*,trxn.type,trxn.amount  as total_amount, Staff.name,Staff.jobType,(SELECT sum(subtotal)  FROM `invoice_items`  where invoiceId = invoices.id and acNum = $accNum) as invoice_total FROM `invoices` inner join Staff on Staff.staffNum = invoices.clientNum and Staff.accNum='$accNum' inner join invoice_transactions as trxn on trxn.invoiceId = invoices.id  where invoices.invoiceNum>0  and invoices.acNum = $accNum and invoices.bookingId = $regNo ";


  $result_order=mysqli_query($con,$sql_order);
  //echo mysqli_num_rows($result_users);
  $order_details = array();
  $p = 0;
  $total_sale_amount = 0;
  $total_bank_amount = 0;
  $total_cc_amount = 0;
  $total_account_amount = 0;
  $total_cash_amount = 0;

  while($row_order = mysqli_fetch_array($result_order,MYSQLI_ASSOC)){
      $order_details[$p] = $row_order;

      $total_sale_amount = $total_sale_amount+$row_order['total_amount'];

      $txn_type = $row_order['type'];


      if($txn_type == 1)
      {
        // cash
        $total_cash_amount = $total_cash_amount+$row_order['total_amount'];

      }elseif($txn_type == 2)
      {
        // cc
        $total_cc_amount = $total_cc_amount+$row_order['total_amount'];
      }elseif($txn_type == 3)
      {
        // bank
        $total_bank_amount = $total_bank_amount+$row_order['total_amount'];
      }elseif($txn_type == 4)
      {
        // account
        $total_account_amount = $total_account_amount+$row_order['total_amount'];
      }
      
      $p++;

  }


    $order_details[0]['total_cash_amount'] = $total_cash_amount; 
    $order_details[0]['total_cc_amount'] = $total_cc_amount; 
    $order_details[0]['total_bank_amount'] = $total_bank_amount; 
    $order_details[0]['total_account_amount'] = $total_account_amount; 
    $order_details[0]['total_sale_amount'] = $total_sale_amount; 

  return $order_details;

}

function getOrderDetails($accNum,$order_id){  
  global $con;
  //$sql_order = "SELECT orders.*,user_address.address,user_address.address1,user_address.city,user_address.state,user_address.zip,user_address.country,users.username,users.email FROM orders left join user_address on user_address.id=orders.delivery inner join users on users.id=orders.user_id where order_id = '$order_id' and orders.accNum = $accNum";
  $sql_order = "SELECT invoices.*,users.username,users.email  FROM invoices inner join users on users.id=invoices.clientNum where invoiceNum = '$order_id' and invoices.acNum = $accNum";
  $result_order=mysqli_query($con,$sql_order);
  //echo mysqli_num_rows($result_users);
  $order_details = array();
  if($row_order = mysqli_fetch_array($result_order,MYSQLI_ASSOC)){
      $order_details['order_details'] = $row_order;
      $order_details['order_details']['order_id'] = $row_order['invoiceNum'];
      $order_details['order_details']['created_at'] = $row_order['date_created'];
      $order_details['order_details']['address'] = '';
      $order_details['order_details']['address1'] = '';
      $order_details['order_details']['city'] = '';
      $order_details['order_details']['state'] = '';
      $order_details['order_details']['zip'] = '';
      $order_details['order_details']['country'] = '';
      $order_details['order_details']['payment_type'] = 'COD';
      $sql_order2 = "SELECT invoice_items.*,menu.menuName,menu.description,variety.itemName,varieties.Calories,varieties.price as perItemPrice FROM `invoice_items` left join varieties on varieties.varietyNum = invoice_items.stock_id  left join variety on variety.varietyNum = varieties.variety left join menu on menu.menuNum = varieties.menuNum where invoiceNum = $order_id";
      $result_order2=mysqli_query($con,$sql_order2);
      $p=0;
      while($row_order2 = mysqli_fetch_array($result_order2,MYSQLI_ASSOC)){
        $order_details['order_details']['items'][$p] = $row_order2;
        $order_details['order_details']['items'][$p]['price'] = $row_order2['subtotal'];
        $order_details['order_details']['items'][$p]['quantity'] = $row_order2['qty'];
        $p++;
      }
  }
  // return ($order_details);
  return json_encode($order_details);
}
function getOrders($accNum){
    global $con;
    $user_id = $_SESSION['user_id'];
    $draw = 1;//intval($this->input->get("draw"));
    // $start = intval($this->input->get("start"));
    // $length = intval($this->input->get("length"));
    //echo 1;die;
    //$sql_query = "SELECT orders.*,(SELECT status from order_status where order_status.order_id = orders.order_id order by id desc limit 1) as order_status FROM `orders`  where user_id = $user_id and accNum = '$accNum' order by order_id desc";
    $sql_query = "SELECT invoices.*,(SELECT status from order_status where order_status.order_id = invoices.invoiceNum order by id desc limit 1) as order_status FROM `invoices`  where clientNum = $user_id and acNum = '$accNum' order by invoiceNum desc";
    $result=mysqli_query($con,$sql_query);
    $orders_data = array();
    $p = 0;
    $total_record = mysqli_num_rows($result);
    $data_arr = array();
    while ($row_query=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    {
      $orders_data[$p]['order'] = $row_query;
      $order_id = $row_query['invoiceNum'];
      $sql_query2 = "SELECT * FROM `invoice_items`  where invoiceNum = $order_id and acNum = '$accNum'";
      $result2=mysqli_query($con,$sql_query2);
      $order_price = 0;
      while ($row_query2=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
      {
        $orders_data[$p]['orders_items'][] = $row_query2;
        $order_price+=$row_query2['price'];
      }
      $p++;
      $view_link = "<a href='javascript:void(0)' class='btn btn-primary'java onclick='view_order_details(".$order_id.")'><span class='description'>View </span></a> <a class='btn btn-primary' href='ajax.php?action=download_invoice&order_id=".$order_id."'><span class='description'>Download Invoice </span></a> ";
      // if($row_query['payment_type']=='POLI'){
      //   $payment_type = "POLI";
      // }else{
      //   $payment_type = ($row_query['payment_type']=='COD' ? 'Cash on delivery' : 'Card Payment');
      // }
      $payment_type = "COD";

      $order_status = "Pending";
      if($row_query['order_status'] == 1)
      {
        $order_status = "Paid";
      }elseif($row_query['order_status'] == 2)
      {
        $order_status = "Order Plcaed";
      }elseif($row_query['order_status'] == 3)
      {
        $order_status = "Order Accepted";
      }elseif($row_query['order_status'] == 4)
      {
        $order_status = "Order Prepared";
      }elseif($row_query['order_status'] == 5)
      {
        $order_status = "Order ready For Delivery";
      }elseif($row_query['order_status'] == 6)
      {
        $order_status = "Order on The Way";
      }elseif($row_query['order_status'] == 7)
      {
        $order_status = "Order Cancelled";
      }elseif($row_query['order_status'] == 8)
      {
        $order_status = "Order Delivered";
      }elseif($row_query['order_status'] == 9)
      {
        $order_status = "Order Closed";
      }
      //  0=checkout, 1=payment, 2=orderPlcaed, 3=accepted, 4=prepared, 5=readyForDelivery, 6=onTheWay, 7=cancelled, 8=delivered, 9=closed
      $data_arr[]= array($p,$order_id,$payment_type,$order_status,date("d M Y h:i A",strtotime($row_query['date_created'])),$view_link);
    }
    // $data_arr;
    $data = array("draw"=>$draw , "recordsTotal" => $total_record, "recordsFiltered" => $total_record, "data" => $data_arr);
    return $data;
}
function confirmCart($accNum,$guest_id,$POST){
  global $con;
  $mobile = $POST['mobile'];
  $email = $POST['email'];
  $clientName = $POST['clientName'];
  $address = $POST['address'];
  
  $select_address = $POST['select_address'];
  $country = $POST['country'];
  $city = $POST['city'];
  $state = $POST['state'];
  $zip = $POST['zip'];
  $lat = $POST['lat'];
  $long = $POST['long'];
  $street_number = $POST['street_number'];
  $route = $POST['route'];
  $address1 = $street_number.' '.$route;
  $recent_delivery_address = $POST['recent_delivery_address'];
  $order_total_price = $POST['order_total_price'];
  $extraPerItemPrice = $POST['extraPerItemPrice'];  //array
  $perItemPrice = $POST['perItemPrice'];  //array
  $qty = $POST['qty'];  //array
  $cart_id_arr = $POST['cart_id'];  //array
  
  $payment_type = $POST['payment_type'];  //array
  $created_at = date("Y-m-d H:i:s");
  if(!isset($_SESSION['user_id']) ||  $_SESSION['user_id'] == 0)
  {
    $sql_user_check = "SELECT id,username FROM users where email = '$email' and accNum = '$accNum'";
    $result2=mysqli_query($con,$sql_user_check);
    $is_guest = 1;
    if($row_user=mysqli_fetch_array($result2,MYSQLI_ASSOC)){
      $is_guest = 0;
      $guest_id = 0;
      $user_id = $row_user['id'];
      $clientName = $row_user['username'];
    }else{
        $user_sql = "INSERT INTO `users`(`accNum`, `username`, `type`, `mobile`, `email`, `password`, `profileImg`, `otp`, `otp_verify`, `created_at`, `updated_at`,guest_id, `status`) VALUES ('$accNum','$clientName','2','$mobile','$email','','','0',0,'$created_at','$created_at','$guest_id','1')";
        $result_user=mysqli_query($con,$user_sql);
        $user_id = mysqli_insert_id($con);
        $is_guest = 0;
        $guest_id = 0;
        $user_add_sql = "INSERT INTO `user_address`( `accNum`, `user_id`, `address`, `address1`, `city`, `state`, `zip`, `country`, `latitude`, `longitude`, `status`, `recent_delivery_address`, `created_at`, `updated_at`) VALUES ('$accNum','$user_id','$address','$address1','$city','$state','$zip','$country','$lat','$long','1','$recent_delivery_address','$created_at','$created_at')";
        $user_address = mysqli_query($con,$user_add_sql);
        $user_address_id = mysqli_insert_id($con);
    }
  }else{
    $user_id = $_SESSION['user_id'];
  }
    if($select_address == ""){
      $sql_check11 = mysqli_query($con,"SELECT address,id FROM user_address WHERE user_id = '$user_id' and address = '$address' and accNum = '$accNum'");
      if($row_check11 = mysqli_fetch_array($sql_check11,MYSQLI_ASSOC)){
        $user_address_id = $row_check11['id'];
      }else{
        $user_add_sql = "INSERT INTO `user_address`( `accNum`, `user_id`, `address`, `address1`, `city`, `state`, `zip`, `country`, `latitude`, `longitude`, `status`, `recent_delivery_address`, `created_at`, `updated_at`) VALUES ('$accNum','$user_id','$address','$address1','$city','$state','$zip','$country','$lat','$long','1','$recent_delivery_address','$created_at','$created_at')";
          $user_address = mysqli_query($con,$user_add_sql);
          $user_address_id = mysqli_insert_id($con);
      }
    }else{
      $user_address_id = $select_address;
    }
  
  $_SESSION = array('is_guest' => $is_guest,'guest_id' => $guest_id, 'user_id' => $user_id, 'username' => $clientName, 'is_logged_in' => 1);
  $max_order_id = 0;

  $sql_order_id = mysqli_query($con,"SELECT max(invoiceNum) as max_order_id FROM invoices where acNum = '$accNum'");
  if($row_order_id = mysqli_fetch_array($sql_order_id,MYSQLI_ASSOC)){
    $max_order_id = $row_order_id['max_order_id'];
  }
  $invoiceNum = $order_id = $max_order_id+1;
  //echo "INSERT INTO `orders`(`accNum`, `tableNum`, `department`, `order_id`, `user_id`,`type`, `delivery`,payment_type, `created_at`, `status`) VALUES ('$accNum','0','0','$order_id','$user_id','w','$user_address_id','$payment_type','$created_at',0)";
  //mysqli_query($con,"INSERT INTO `orders`(`accNum`, `tableNum`, `department`, `order_id`, `user_id`,`type`, `delivery`,payment_type, `created_at`, `status`) VALUES ('$accNum','0','0','$order_id','$user_id','w','$user_address_id','$payment_type','$created_at',0)");
  
  //echo "INSERT INTO `invoices`(`acNum`, `invoiceNum`, `clientNum`, `invType`, `date_created`, `date_updated`, `status`) VALUES ('$accNum','$invoiceNum','$user_id','1','$created_at','$created_at',0)";

  mysqli_query($con,"INSERT INTO `invoices`(`acNum`, `invoiceNum`, `clientNum`, `invType`, `date_created`, `date_updated`, `status`) VALUES ('$accNum','$invoiceNum','$user_id','1','$created_at','$created_at',0)");

  $invoice_id = mysqli_insert_id($con);


  mysqli_query($con,"INSERT INTO `order_status`(`accNum`, `order_id`, `status`, `created_at`, `updated_at`) VALUES ('$accNum','$order_id',0,'$created_at','$created_at')");
  foreach ($cart_id_arr as $cart_id) {
    //echo "SELECT * FROM fr_temp_cart where id = '$cart_id'";die;
    $temp_cart_items = mysqli_query($con,"SELECT * FROM fr_temp_cart where id = '$cart_id'");
    while($temp_cart_row = mysqli_fetch_array($temp_cart_items,MYSQLI_ASSOC))
    {
      $temp_order_id = $temp_cart_id = $temp_cart_row['temp_cart_id'];
      
      $menuNum = $temp_cart_row['menuNum'];
      $varietyId = $temp_cart_row['variety'];
      $quantity = $temp_cart_row['quantity'];
      $chef_note = $temp_cart_row['chef_note'];
      $price = $temp_cart_row['price'];
      $status = 1;
      //echo "INSERT INTO `orders_cart`(`accNum`, `temp_order_id`, `order_id`, `menuNum`, `varietyId`, `quantity`, `chef_note`, `price`, `status`, `created_at`, `updated_at`) VALUES ('$accNum','$temp_order_id','$order_id','$menuNum','$varietyId','$quantity','$chef_note','$price','$status','$created_at','$created_at')"; 
      //mysqli_query($con,"INSERT INTO `orders_cart`(`accNum`, `temp_order_id`, `order_id`, `menuNum`, `varietyId`, `quantity`, `chef_note`, `price`, `status`, `created_at`, `updated_at`) VALUES ('$accNum','$temp_order_id','$order_id','$menuNum','$varietyId','$quantity','$chef_note','$price','$status','$created_at','$created_at')");

      // echo "INSERT INTO `invoice_items`( `acNum`, `invoiceNum`, `invoiceId`, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `status`, `createdAt`, `updated_at`) VALUES ('$accNum','$invoiceNum','$invoice_id','$quantity','$price','0','0','$price','$varietyId','$status','$created_at','$created_at')";
     
      mysqli_query($con,"INSERT INTO `invoice_items`( `acNum`, `invoiceNum`, `invoiceId`, `qty`, `unit_price`, `unit_gst`, `percentage`, `subtotal`, `stock_id`, `status`, `createdAt`, `updated_at`,product) VALUES ('$accNum','$invoiceNum','$invoice_id','$quantity','$price','0','0','$price','$varietyId','$status','$created_at','$created_at','')");

     
      $extra_carts_sql  = mysqli_query($con,"SELECT * FROM fr_temp_extra where temp_cart_id = '$temp_cart_id'");
      while($temp_extra_row = mysqli_fetch_array($extra_carts_sql,MYSQLI_ASSOC))
      {
        $ingredientNum = $temp_extra_row['ingredientNum'];
        $optionNum = $temp_extra_row['optionNum'];
        $price_extr = $temp_extra_row['price'];
        
        mysqli_query($con,"INSERT INTO `order_extra`(`accNum`, `temp_order_id`, `ingredientNum`, `optionNum`, `price`, `created_at`, `updated_at`) VALUES ('$accNum','$temp_order_id','$ingredientNum','$optionNum','$price_extr','$created_at','$created_at')");
      }
      mysqli_query($con,"DELETE FROM fr_temp_cart where id = '$cart_id'");
      mysqli_query($con,"DELETE FROM fr_temp_extra where temp_cart_id = '$temp_cart_id'");
    }
  }
  setcookie("cart_items", "", time() - 3600);
  return json_encode(array("order_id" => $order_id, "total_price" => $order_total_price, "email" => $email, "name" => $clientName, "address" => $address));
}
function addToCart($accNum,$guest_id,$POST){
  global $con;
  $is_guest = $_SESSION['is_guest'];
  $variety = $POST['variety'];
  $qty = $POST['qty'];
  $addextra = $POST['addextra'];
  $note = mysqli_real_escape_string($POST['note']);
  $activeTable = $POST['activeTable'];
  $activeDepartment = $POST['activeDepartment'];
  $menuNum = $POST['menuNum'];
  $totalPrice = $POST['totalPrice'];
  $created_at = date("Y-m-d H:i:s");
  $temp_cart_id = rand(99999999, 999999999);
  if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
  {
    $is_guest = 1;
    $user_id = $guest_id;
  }
  else
  {
    $is_guest = 0;
    $user_id = $_SESSION['user_id'];
  }
   $sql = "INSERT INTO `fr_temp_cart`(`accNum`, `temp_cart_id`, `user_id`, `menuNum`, `variety`, `quantity`, `chef_note`, `price`, `status`, `created_at`, `updated_at`,`tableNum`, `department`,is_guest) VALUES ('$accNum','$temp_cart_id','$user_id','$menuNum','$variety','$qty','$note','$totalPrice',2,'$created_at','$created_at','$activeTable','$activeDepartment','$is_guest')";
    $res = mysqli_query($con,$sql);
    $sql2 = '';
    $arr_keys = array_keys($addextra);
    foreach($arr_keys as $arr_key)
    {
      $ingredientNum = $arr_key;
      $optionNum = $addextra[$arr_key];
      if($optionNum != 0)
      {
        $sql_varieties = "SELECT option_price FROM ingredient_options where id = $optionNum";
        $result2=mysqli_query($con,$sql_varieties);
        $row_varieties=mysqli_fetch_array($result2,MYSQLI_ASSOC);
        $price = $row_varieties['option_price'];
        $sql2=  "INSERT INTO `fr_temp_extra`( `accNum`, `temp_cart_id`, `ingredientNum`, `optionNum`, `price`, `created_at`, `updated_at`, `status`) VALUES ('$accNum','$temp_cart_id','$ingredientNum','$optionNum','$price','$created_at','$created_at',2)";
        $res = mysqli_query($con,$sql2);
      }
    }
    $POST['accNum'] = $accNum;
    $POST['guest_id'] = $guest_id;
    $POST['guest_ip'] = $_SESSION["guest_ip"];
    $cookie_data = array();
    $cookie_data[] = $POST;
    if(isset($_COOKIE['cart_items'])){
      $cookie_items = json_decode($_COOKIE['cart_items'], true);
      foreach ($cookie_items as $singleItem) {
        $cookie_data[] = $singleItem;
      }
    }
    setcookie('cart_items', json_encode($cookie_data), time() + (86400 * 30));
    return $sql.'  '.$sql2;
}
function updateCart($accNum,$guest_id,$POST){
  global $con;
  $is_guest = $_SESSION['is_guest'];
  $qty = $POST['qty'];
  $cart_id = $POST['cart_id'];
  $totalPrice = $POST['total_price'];
  $created_at = date("Y-m-d H:i:s");
  $sql = "UPDATE `fr_temp_cart` SET `quantity`='$qty',`price`='$totalPrice',`updated_at`='$created_at' WHERE id = '$cart_id' ";
  $res = mysqli_query($con,$sql);
  $sql_cart = "SELECT menuNum FROM fr_temp_cart where id = $cart_id";
  $result3 = mysqli_query($con,$sql_cart);
  $row_cart = mysqli_fetch_array($result3);
  $menuNum = $row_cart['menuNum'];
  
    if(isset($_COOKIE['cart_items'])){
      $cookie_items = json_decode($_COOKIE['cart_items'], true);
      foreach ($cookie_items as $singleItem) {
        if($singleItem['menuNum'] == $menuNum)
        {
          $singleItem['qty']  = $qty;
          $singleItem['totalPrice']  = $totalPrice;
        }
        $cookie_data[] = $singleItem;
      }
    }
    setcookie("cart_items", "", time() - 3600);
    setcookie('cart_items', json_encode($cookie_data), time() + (86400 * 30));
    return $sql.'  '.$sql2;
}

function getUserLogin($accNum,$post){
    global $con;
    // print_r($con);die;
    $user_email = $post['email'];
    $password = md5($post['password']);
    // $sql = "SELECT * FROM users where email = '$user_email' and password = '$password'";
    $sql = "SELECT * from Manager where email= '$user_email'";
    $created_on = date("Y-m-d H:i:s");
    $result2=mysqli_query($con,$sql);

    // print_r($result2);

    // print_r(mysqli_error($con));die;

    if ($row=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
    {
      $user_id = $row['id'];
      $is_guest = 0;
      $user_data = array('user_id' => $user_id, 'userNum' => $row['userNum'], 'is_logged_in' => 1,'accNum'=>$accNum);
      $result = $user_data;
    }else{
      $result = array();
    }
    
    return $result;
}

function getauthoritiesDetails($accNum,$user_id)
{
  global $con;
     $sql_authorities="SELECT SET1 FROM `authorities` WHERE accNum= $accNum and userID=$user_id";
      $result=mysqli_query($con,$sql_authorities);
      while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
       {
        $auth_result=$row;
       }
       return $auth_result;
}

function activeTables($accNum){
  global $con;
  // $sql_varieties = "SELECT * FROM `ecom_department` where accNum = $accNum";

     $sql_varieties = "SELECT * FROM `ecom_department` where accNum = $accNum"; 

    $result1=mysqli_query($con,$sql_varieties);

    $result_data = array();
    $i=0;


    // print_r($result1);

    while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
      

      $result_data[$i]['department'] = $row;

      $depart_id = $row['id'];
      $sql2 = "SELECT * FROM `invoices` where acNum = $accNum and rcNum = $depart_id and invoiceNum=0"; 
      $result2=mysqli_query($con,$sql2);
      while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
      {
        $result_data[$i]['department']['active_tables'][] = $row2;
      }
      $i++;

    }
    return $result_data;
}
function Department_tables($accNum)
{
  global $con;

     $sql_varieties = "SELECT * FROM `ecom_department` where accNum = $accNum"; 

    $result1=mysqli_query($con,$sql_varieties);

    $result_data = array();
    $i=0;
    while ($row=mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
      

      $result_data[$i]['department'] = $row;

      $depart_id = $row['id'];
      $sql2 = "SELECT * FROM `invoices` where acNum = $accNum and rcNum =$depart_id  and invoiceNum=0 and id in(SELECT invoiceId FROM invoice_items where status in(2,3))"; 
      $result2=mysqli_query($con,$sql2);
      while ($row2=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
      {
        $result_data[$i]['department']['active_tables'][] = $row2;
      }
      $i++;

    }
    return $result_data;




}

function getMenuIngredientOptionPrice($iot_id){
  global $con;
  $sql_varieties = "SELECT option_price FROM ingredient_options where id = $iot_id";
    $result2=mysqli_query($con,$sql_varieties);
    if ($row_varieties=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
    {
      $price = $row_varieties['option_price'];
    }
    return $price;
}
function getItemDetails($accNum,$menuNum){
   global $con;
    $sql_menu = "SELECT menu.*,concat('https://testing.staffstarr.com/its-admin/assets/images/".$accNum."/',images.imageName) as image,(SELECT Calories from varieties where varieties.menuNum = $menuNum and Calories != '' limit 1) as Calories FROM menu LEFT JOIN images  ON menu.menuNum = images.Num where menu.menuNum = $menuNum AND images.type =1 and menu.status not in(7,9,0) ";
    $result1=mysqli_query($con,$sql_menu);
    //$row_menu=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    $categoryArray =array();
    $categoryArray['menu'] = array();
    $categoryArray['varieties'] = array();
    $categoryArray['ingredients'] = array();
   // $categoryArray['ingredient_options'] = array();
    while ($row_menu=mysqli_fetch_array($result1,MYSQLI_ASSOC)) 
    {
      //print_r($row_menu);
      $categoryArray['menu'][] = $row_menu;
    }
    $sql_varieties = "SELECT varieties.*,variety.itemName FROM varieties left join variety on variety.varietyNum = varieties.variety where varieties.menuNum = $menuNum";
    $result2=mysqli_query($con,$sql_varieties);
    while ($row_varieties=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
    {
      $categoryArray['varieties'][] = $row_varieties;
    }
    $sql_ingredients = "SELECT ingredients.*,(SELECT itemName from ingredients_types where ingredients_types.ingredientNum = ingredients.ingredientNum) as itemName FROM ingredients where menuNum = $menuNum";
    $result3=mysqli_query($con,$sql_ingredients);
    $k = 0;
    while ($row_ingredients=mysqli_fetch_array($result3,MYSQLI_ASSOC)) 
    {
      $categoryArray['ingredients'][$k]['ingredients'] = $row_ingredients;
      $ingredientNum = $row_ingredients['ingredientNum'];
      $sql_ingredient_options ="SELECT ingredient_options.*,(SELECT plusName FROM `ingredient_options_types` where ingredient_options_types.plusNum = ingredient_options.plusTypeNum) as plus_name FROM `ingredient_options` where menuNum = $menuNum AND ingredientTypeNum = $ingredientNum";
      $result4=mysqli_query($con,$sql_ingredient_options);
      $ingredient_options = array();
      while ($row_ingredient_options=mysqli_fetch_array($result4,MYSQLI_ASSOC)) 
      {
        $ingredient_options[] = $row_ingredient_options;
      }
      $categoryArray['ingredients'][$k]['ingredient_options'] = $ingredient_options;
      $k++;
    }
    // SELECT * FROM `menu` WHERE menuNum = 43
    // SELECT * FROM `varieties` where menuNum = 43 
    // SELECT * FROM `variety` where varietyNum in (23,24,25)        
    // SELECT * FROM `ingredients` where `menuNum` = 43 
    // SELECT * FROM `ingredients_types` WHERE ingredientNum in (4, 8)
    // SELECT * FROM `ingredient_options` where menuNum = 43 AND ingredientTypeNum IN (4,8)    
    // SELECT * FROM `ingredient_options_types` WHERE plusNum IN (13, 14, 15, 16)     
    // $result=mysqli_query($con,$sql);
    // // Associative array
    // while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC)) 
    // {
    //   $categoryArray[] = $row;
    // }
    mysqli_free_result($result);
    return $categoryArray;
}
function getCartItems($accNum,$guest_id){
  global $con;
  $is_guest = $_SESSION['is_guest'];
  $user_id = $guest_id;
  if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == 0)
    {
      $is_guest = 1;
    }
  else
    {
      $is_guest = 0;
      $user_id = $_SESSION['user_id'];
    }
    $_SESSION['is_guest'] = $is_guest;
  $sql_carts = "SELECT fr_temp_cart.*,menu.menuName,varieties.price as perItemPrice,varieties.stock,(SELECT itemName from variety where variety.varietyNum = varieties.variety) as itemName FROM fr_temp_cart inner join menu on menu.menuNum = fr_temp_cart.menuNum left join varieties on varieties.varietyNum =fr_temp_cart.variety  where fr_temp_cart.user_id = $user_id and fr_temp_cart.is_guest = '$is_guest' and fr_temp_cart.accNum = '$accNum'";
  $result2=mysqli_query($con,$sql_carts);
  $cart_data = array();
  $p = 0;
  while ($row_carts=mysqli_fetch_array($result2,MYSQLI_ASSOC)) 
  {
    $cart_data[$p]['cart'] = $row_carts;
    $id = $row_carts['id'];
    $temp_cart_id = $row_carts['temp_cart_id'];
    $sql_extra = "SELECT * FROM fr_temp_extra where temp_cart_id = $temp_cart_id";
    $result3 = mysqli_query($con,$sql_extra);
    while($row_extra = mysqli_fetch_array($result3)){
        $cart_data[$p]['extra'][] = $row_extra;
    }
    $p++;
  }
  return $cart_data;
}

function removeCartItems($cartId)
{
  global $con;
    $sql_cart = "SELECT * FROM fr_temp_cart where id = $cartId";
    $result3 = mysqli_query($con,$sql_cart);
    if($row_cart = mysqli_fetch_array($result3)){
        $temp_cart_id = $row_cart['temp_cart_id'];
        $menuNum = $row_cart['menuNum'];
        $sql_extra = "DELETE FROM `fr_temp_extra` WHERE temp_cart_id = '$temp_cart_id'";
        mysqli_query($con,$sql_extra);
        $sql_cart2 = "DELETE FROM `fr_temp_cart` WHERE temp_cart_id = '$temp_cart_id'";
        mysqli_query($con,$sql_cart2);
        $cookie_data = array();
  
        if(isset($_COOKIE['cart_items'])){
          $cookie_items = json_decode($_COOKIE['cart_items'], true);
          $i = 0;
          foreach ($cookie_items as $singleItem) {
              if($singleItem['menuNum'] == $menuNum)
              {
                  unset($cookie_items[$i]);
                  $cookie_items = array_values($cookie_items);
              }
              $i++;
          }
        }
        //print_r($cookie_items);
        setcookie("cart_items", "", time() - 3600);
        setcookie('cart_items', json_encode($cookie_items), time() + (86400 * 30));
    }
    return 1;
}


}
?>