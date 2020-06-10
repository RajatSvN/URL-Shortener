<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>URL Shortener</title>
    <style>
        #wrapper{
            display: flex;
  justify-content: center;
  align-items: center;
  height:500px;
        }
    </style>
  </head>
  <body>
    <div class="container-fluid" id="wrapper">
    <div class="container"  style="width:80%;">
    <div class="text-center"><h3><b>URL Shortener</b></h3></div>

    <form>

    
    <div class="form-group" style="width:70%;margin:auto;">
    <input type="text" class="form-control" name="url" id="url" placeholder="Enter url to be shortened" />
    </div>

    <br>


    <div class="text-center">
    <input type="submit" class="btn btn-success" id="submit" />
    </div>

    <br>

    <div class="text-center">
    <div class="error"></div>
    </div>


    </form>

    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>

        $("#submit").click(function(e){
            e.preventDefault();
            var url = $("#url").val();
            
            if(url.length==0){

                $(".error").html("<p class='text-muted' style='color:red !important;'>The URL field should not be empty!</p>");

            }else{

                $.ajax({

                    method:"POST",
                    url:"urlshort.php",
                    data:{
                        url:url
                    }

                }).done(function(response){

                    response = JSON.parse(response);

                    if(response.hasOwnProperty('success')){

                        $(".error").html("<p class='text-muted' style='color:green !important;'>"+response['success']+"</p>"+"<p class='text-muted' style='color:green !important;'>The shortened url is : <a href='http://"+response['short_url']+"'>"+response['short_url']+"</a></p>");

                    }else{
                        $(".error").html("<p class='text-muted' style='color:red !important;'>"+response['error']+"</p>");
                        
                        if(response.hasOwnProperty('short_url')){
                            
                            // this error is that shortened url already exsist
                            
                            $(".error").append("<p class='text-muted' style='color:green !important;'>The shortened url is : <a href='http://"+response['short_url']+"'>"
                            +response['short_url']+"</a></p>");
                        }
                        
                    }

                });

            }

        })


    </script>
  </body>
</html>