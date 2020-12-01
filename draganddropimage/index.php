<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" >
<link href="dropzone/dist/dropzone.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
<div class="col-md-6 col-md-offset-3">
      <div class="header clearfix">
        <h3 class="text-muted text-center">Drag and Drop Image Upload</h3>
      </div>
    <hr>
      <div class="jumbotron col-md-12">
    <form id="imageDropzone" action="getImage.php" enctype="multipart/form-data" class="dropzone">
        <div class="dz-message">
        <div class="icon"><span class="fa fa-cloud fa-3x"></span></div>
        <h3>Drag and Drop Images here</h3>
        </div>
    </form>
      </div>

      <footer class="footer">
        <p>&copy; Vivek Moyal.</p>
      </footer>

    </div> <!-- /container -->

<script src="dropzone/dist/dropzone.js" type="text/javascript"></script>
<script type="text/javascript">
  Dropzone.autoDiscover = false;
  var dropzone1 = new Dropzone('#imageDropzone', {
          maxFiles:5,
          forceFallbacks:true,
          autoDiscover:false,
          createImageThumbnails:false,
          init:function(){
              this.on("success",function (file,response){
                  alert(response);
              });
          }
     });
 </script>