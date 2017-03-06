<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="th">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <title>Drop Zone</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" rel="stylesheet">
</head>
    <style type="text/css">
        .alert-success{
            display: none;
        }
        .dropzone .dz-preview .dz-image {
            border-radius: 4px;
        }
    </style>
    <body>
        <div class="container">
            <div class="alert alert-danger">Dropzone Disbled</div>
            <div class="alert  alert-success">Dropzone Enabled</div>

            <div class="container">
                <label>ENABLE / DISABLE</label>
                <select name="status"  id="status" class="form-control">
                    <option value="" selected="selected">Select</option>
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disble</option>
                    option
                </select>
            </div>
            <div class="dropzone">
                <div class="dz-message">
                    <h3> Drag and Drop your files here Or Click here to upload</h3>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
        <script type="text/javascript">
            Dropzone.autoDiscover = false;
            var file= new Dropzone(".dropzone",{
                url: "<?php echo base_url('dropzone/upload') ?>",
                // maxFilesize: 2,  // maximum size to uplaod
                method:"post",
                // acceptedFiles:"image/*", // allow only images
                paramName:"userfile",
                // dictInvalidFileType:"Image files only allowed", // error message for other files on image only restriction
                addRemoveLinks:true,
                autoProcessQueue: false
            });
            $('.btn-upload').change(function(){
                if($(this).val()=='Enable'){
                    $('.alert-success').show();
                    $('.alert-danger').hide();
                    file.processQueue();
                }else{
                    $('.alert-success').hide();
                    $('.alert-danger').show();
                }
            });

            file.on("sending",function(a,b,c){
                a.token=Math.random();
                c.append("token",a.token); //Random Token generated for every files
            });
            // delete on upload
            file.on("removedfile",function(a){
                var token=a.token;
                $.ajax({
                    type:"post",
                    data:{token:token},
                    url:"<?php echo base_url('upload/delete') ?>",
                    cache:false,
                    dataType: 'json',
                    success: function(res){
                        // alert('Selected file removed !');
                    }
                });
            });
        </script>
    </body>
</html>
