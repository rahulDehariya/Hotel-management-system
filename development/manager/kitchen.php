<?php
require_once "data.php";
$myCategory = new Category();

if(!isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] != 1)
{
    header("location:index.php");
}


$kitchn_order=$myCategory->GetActiveJobs($accNum);
//print_r($kitchn_order);
$invoicesId = $myCategory->getinvoices_id($accNum);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    KITCHEN
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--    Bootstrap     -->
 <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
   <script src="assets/js/core/jquery.min.js"></script>
   <script src="assets/js/core/bootstrap.min.js"></script>

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.css?v=2.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>
<style type="text/css">
  .demo-icons ul li {
    width: auto;
    background: #ddd;
    padding: 5px 0;
    margin:0 5px;
  }
  .demo-icons .nc-icon {
    font-size: 30px;
}
.demo-icons section h2 {
    bJob-bottom: 1px solid #e2e2e2;
    padding: 0 0 0.3em .2em;
    margin-bottom: 1em;
}
.demo-icons ul p {
    color: black;
    }

.demo-icons ul p {
    padding: 10px 0 0;
}
</style>

<body>
       
          <div class="col-md-12">
            <div class="card demo-icons">
                <section style="    border: 1px solid #ddd;background-color: #cab7b7;">
                    <h2 style="    border: none;    margin: 0;">K-1</h2>
                    <ul>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #64b164;">
                        <i class="nc-icon nc-alert-circle-i"></i>
                        <?php
                          foreach($kitchn_order as $jobNum)
                          {

                        ?>
                        <p onclick="getjobItems(<?php echo $jobNum['jobNumber'];?>)">Job-<?php echo $jobNum['jobNumber'];  ?></p>
                        <?php  
                          }
                        ?>
                      </li>
                      <li style="    background: #fdcad3;">
                        <i class="nc-icon nc-align-center"></i>
                        <p>Job-4</p>
                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #c35656;">
               
                         <i class="nc-icon nc-cart-simple"></i>
                         <p>Job-1</p>

                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background:  #794c4c;">
                        <i class="nc-icon nc-align-left-2"></i>
                        <p>Job-5</p>
                      </li>
                      
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #5959bb;">
                        <i class="nc-icon nc-album-2"></i>
                        <p>Job-2</p>
                      </li>
                   </ul>
            </section>
                <section style=" border: 1px solid #ddd;background-color: #bf8484;">
                    <h2 style=" border: none;    margin: 0;">K-2</h2>
                    <ul>
                      <li data-toggle="modal" data-target="#myModal" style="background: #c35656;">
                         <i class="nc-icon nc-cart-simple"></i>
                         <p>Job-1</p>
                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #64b164;">
                        <i class="nc-icon nc-alert-circle-i"></i>
                        <p>Job-3</p>
                      </li>
                      <li style="    background: #fdcad3;">
                        <i class="nc-icon nc-align-center"></i>
                        <p>Job-4</p>
                      </li>
                      <li>
                        <i class="nc-icon nc-app"></i>
                        <p>Job-7</p>
                      </li>
                      <li style="    background: #5e5e6b;">
                        <i class="nc-icon nc-atom"></i>
                        <p>Job-8</p>
                      </li>
                    </ul>
                </section>
                <section style="    border: 1px solid #ddd;background-color: #7588b9;">
                    <h2 style="    border: none;    margin: 0;">K-3</h2>
                    <ul>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #64b164;">
                        <i class="nc-icon nc-alert-circle-i"></i>
                        <p>Job-3</p>
                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="background: #c35656;">
                         <i class="nc-icon nc-cart-simple"></i>
                         <p>Job-1</p>
                      </li>
                      <li style="    background: #fdcad3;">
                        <i class="nc-icon nc-align-center"></i>
                        <p>Job-4</p>
                      </li>
                      <li style="    background: #5e5e6b;">
                        <i class="nc-icon nc-atom"></i>
                        <p>Job-8</p>
                      </li>
                    </ul>
                </section>
                <section style="    border: 1px solid #ddd;background-color: #d65876;">
                    <h2 style="    border: none;    margin: 0;">K-4</h2>
                    <ul> 
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #5959bb;">
                        <i class="nc-icon nc-album-2"></i>
                        <p>Job-2</p>
                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background: #64b164;">
                        <i class="nc-icon nc-alert-circle-i"></i>
                        <p>Job-3</p>
                      </li>
                      <li style="    background: #fdcad3;">
                        <i class="nc-icon nc-align-center"></i>
                        <p>Job-4</p>
                      </li>
                      <li data-toggle="modal" data-target="#myModal" style="cursor:pointer;background:  #794c4c;">
                        <i class="nc-icon nc-align-left-2"></i>
                        <p>Job-5</p>
                      </li>
                      <li style="    background: #5e5e6b;">
                        <i class="nc-icon nc-atom"></i>
                        <p>Job-8</p>
                      </li>
                    </ul>
                </section>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
       <div class="modal fade" id="myModal" role="dialog">
                          <div class="modal-dialog">
                         <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" style="width: 100%;">Item List</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                               <div class="modal-body">
                                  <table style="border:1px black; width:100%;" id="kitchen_list_items" class="form-group">
                                      <thead class="cart__row cart__header">
                                        <tr>        
                                          <th class="cart_items">SNo</th>
                                          <th class="cart_items">Item</th>
                                           <th class="cart_items">Action</th>
                                        </tr>
                                       </thead>
                                       <tbody id="job_items_list">
                                       <tr>
                                         <td></td>
                                       </tr>
                                       <!-- <tr>
                                         <td class="cart_items">2</td>
                                         <td class="cart_items">Tawa paratha</td>
                                         <td><a href="#" class="btn btn-primary  btn-round">Prepared</a> | <a href="" class="btn btn-primary  btn-round">Pickedup</a></td>
                                      </tr>
                                        <tr>
                                         <td class="cart_items">2</td>
                                         <td class="cart_items">Tawa Paneer</td>
                                         <td><a href="#" class="btn btn-primary  btn-round">Prepared</a> | <a href="" class="btn btn-primary  btn-round">Pickedup</a></td>
                                       </tr> -->
                                  </tbody>
                                 
                                </table>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                      
                        </div>
                    </div>
     
</body>

</html>
<script>
  function getjobItems(jobId)
  {
    //alert(jobId);
    $.ajax({
            type: 'POST',
            url: 'ajax.php?action=getjobItems&Id='+jobId,
            data: {},
            success: function (response)
            {
              // alert(response);
              //console.log("sdfsdf"+response);
               var obj = JSON.parse(response);

              $("#job_items_list").html("");

              var job_items="";

              for(var p=0;p<obj.length;p++)
              {
                K=p+1;
                job_items +='<tr><td>'+K+'</td><td>'+obj[p]['id']+'</td><td><a href="#" class="btn btn-primary btn-round">Prepared</a>|<a href="" class="btn btn-primary btn-round ">PickedUp</a></td></tr>';
              }
               $("#job_items_list").html(job_items);


            }
        })


  }
</script>
