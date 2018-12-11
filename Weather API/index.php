<?php

$weather = "";

$error = "";
    
    if (array_key_exists('city', $_GET)) {
                
        $city = urlencode($_GET['city']);
        
        $file_headers = @get_headers("https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=[myAppId]");
        
        if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            
            $error = "This city can not be found!";
            
        } else {
            
             $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=[myAppId]");

            $weatherArray = json_decode($urlContents, true);

            $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

            $tempInC = $weatherArray['main']['temp'] - 273;

            $weather .= "The temperature is ".intval($tempInC)."&deg;C ";

            $wind = $weatherArray['wind']['speed'];

            $weather .= "and the wind speed is ".$wind." m/sec.";
        };
        
    };

?>

<html lang="en">
    
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Weather Scrapper</title>
      
      <style type="text/css">
          
          html { 
              
              background: url(pic.jpg) no-repeat center center fixed; 
              -webkit-background-size: cover;
              -moz-background-size: cover;
              -o-background-size: cover;
              background-size: cover;
          }
          
          body {
              
              text-align: center;
              background: none;
            
          }
          
          .container {
              
              width: 500px;
              
          }
          
          #header {
              
              margin-top: 100px;
              
          }
          
          #city {
              
              margin-top: 25px;
              
          }
          
          
      </style>
      
      
  </head>

  <body>
      
      <div class="container">
          
        <div id="header"><h1 class="display-5">What's the weather?</h1></div>
        
          
        <form>
            
            <div class="form-group">
                <label for="city"><p>Enter the name of a city</p></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="eg: New York" value="<?php   if(array_key_exists('city', $_GET)){
        
                    echo $_GET['city'];
                    
                }; ?>">
            </div>
            
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            
        </form>
          
        <div  id="weather" class="alert alert-success"><?php echo $weather; ?></div>
          
        <div id="error"><?php if($error){ echo '<div class="alert alert-danger" role="alert">'.$error.'</div>'; } ?></div>
          
      </div>
    
    
      
      
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      
    <script type="text/javascript">
        
        if ($('#weather').html() == '') {
            
            $('#weather').hide();
            
        } else {
            
            $('#weather').show();
            
        };
          
    
    </script>
      
  </body>
</html>