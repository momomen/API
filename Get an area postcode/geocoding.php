<?php

/*echo file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=1600+Amphitheatre+Parkway,+Mountain+View,+CA&key=myKey");
*/

?>

<!DOCTYPE html>

<html>
    <head>
        <title>Geocoding an Address</title>
        <meta name="viewport" content="initial-scale=1.0">
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <style type="text/css">
            
            html,body {
                
                font-family: 'Lato',sans-serif;
                background-color: #A9BCF5;
                margin: 0;
                
            }
            
            #img {
              /* Set rules to fill background */
                display: inline-block;

                /* Set up proportionate scaling */
                width: 33%;
                height: 100%;
                
                /* Set up positioning 
                position: fixed;
                top: 0;
                left: 0;
                position: relative;
                top: -30px;*/
                
                
            }
            
            h1 {
                background-color: beige;
                margin: 0 auto;
                padding-top: 20px;
                padding-left: 30px;
            }
            
            #error {
                
                font-size: 18px;
                color: red;
                font-style: bold;
            }
            
            form {
                display: inline-block;
                width: 66%;
                margin-top: 200px;
                text-align: center;
                vertical-align: top;
            }
            
            label {
                margin-right: 20px;
                font-size: 20px;
            }
            
            input {
                width: 300px;
                height: 30px;
                vertical-align: top;
                border-radius: 4px;
                border: none;
                font-size: 17px;
                padding-left: 5px;
            }
            
            button {
                font-family: 'Noto Sans TC' !important;
                padding: 7px 22px;
                font-size: 15px;
                background-color: #1D38E1;
                color: white;
                border: none;
                border-radius: 4px;
            }
            
            button:hover {
                background-color: #334DF4;
                
            }
        
        </style>
    </head>
    
    <body>
        
        <main>
            <h1>Get a Postcode</h1>
        </main>
        
        <img id="img" src="pic2.jpg" alt="picture of clean stairs">
            
        <form>
        
            <label for="address">Enter address here :</label>
            <input id="address" class="" name="address" type="text" placeholder="12 Main Street">
            <br><br>
            <label for="country">Enter country here :</label>
            <input id="country" class="" name="country" type="text" placeholder="GB">
            <br><br>
            <button type="button" name="submit" id="submitButton" value="Go!">Submit</button>
            
            <div id="error"></div>
            
        </form>
    
    </body>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script type="text/javascript">
        
        $('#submitButton').click(function(e) {
            
            e.preventDefault();
            
            $('#error').html("");
            
            var $error = "";
        
            $.ajax({
            
                url: "https://maps.googleapis.com/maps/api/geocode/json?address=" + encodeURIComponent($('#address').val()) +"&components=country:" + encodeURIComponent($('#country').val()) +"&key=myKey",
                type: "GET",
                success: function(data) {
                    
                    if (data['results'] != "OK") {
                
                        $error = "<p>This address is invalid or there is no corrospending postal code for it!</p>";

                        $('#error').html($error);
                        
                    } else {
                        
                        $.each(data['results'][0]['address_components'], function(key, value) {

                            if (value["types"][0] == "postal_code") {

                                $error = "<p>The post code for this address is: "+ value['long_name'] +"</p>";

                                $('#error').html($error);

                            } else {

                                $error = "<p>This address is invalid or there is no corrospending postal code for it!</p>";

                                $('#error').html($error);
                            };

                        });
            
                    }
                   
                }
            
            })
        
        })
    
    </script>
    
</html>
