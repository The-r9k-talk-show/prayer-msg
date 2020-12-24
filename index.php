<?php
//index.php
$final = '';
$error = '';
$name = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 $string = str_replace(',', '', $string);
 
 
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Porfavor ponga su nombre</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Solo letras para su nombre</label></p>';
  }
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">No deje la forma en blanco</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }

 if($error == '')
 {
  $file_open = fopen("data.csv", "a");
  $no_rows = count(file("data.csv"));
  if($no_rows > 1)
  {
   $no_rows = ($no_rows - 1) + 1;
  }
  $form_data = array(
   'name'  => $name,
   'message' => $message
  );
  fputcsv($file_open, $form_data);
  $final = '<label class="text-success">Gracias, oraremos por su peticion</label>';
  $name = '';
  $message = '';
 }
}
?>

    <!DOCTYPE html>
    <html>

    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
			font-family: Arial, Helvetica, sans-serif;
				
				}
                * {box-sizing: border-box;}
                
                /* Button used to open the contact form - fixed at the bottom of the page */
                .open-button {
                  background-color:#85e085;
                  color: white;
                  padding: 16px 20px;
                  border: none;
                  cursor: pointer;
                  opacity: 0.8;
                  position: fixed;
                  bottom: 23px;
                  right: 28px;
                  width: 280px;
                }
                
                /* The popup form - hidden by default */
                .form-popup {
                  display: none;
                  position: fixed;
                  bottom: 0;
                  right: 15px;
                  border: 3px solid #f1f1f1;
                  z-index: 9;
                }
                
                /* Add styles to the form container */
                .form-container {
                  max-width: 300px;
                  padding: 10px;
                  background-color: white;
                }
                
                /* Full-width input fields */
                .form-container input[type=text], .form-container input[type=password] {
                  width: 100%;
                  padding: 15px;
                  margin: 5px 0 22px 0;
                  border: none;
                  background: #f1f1f1;
                }
                
                /* When the inputs get focus, do something */
                .form-container input[type=text]:focus, .form-container input[type=password]:focus {
                  background-color: #ddd;
                  outline: none;
                }
                
                /* Set a style for the submit/login button */
                .form-container .btn {
                  background-color: #4CAF50;
                  color: white;
                  padding: 16px 20px;
                  border: none;
                  cursor: pointer;
                  width: 100%;
                  margin-bottom:10px;
                  opacity: 0.8;
                }
                
                /* Add a red background color to the cancel button */
                .form-container .cancel {
                  background-color: red;
                }
                
                /* Add some hover effects to buttons */
                .form-container .btn:hover, .open-button:hover {
                  opacity: 1;
                }
        </style>
    </head>

    <body>

        <div class="container">
            <h2 align="center">Campaña de Oracion</h2>
            <br/>
            <div class="col-md-6" style="margin:0 auto; float:none;">
                <form method="post">
                    <h3 align="center">Llene la forma con su peticion</h3>
                    <br />
                    <?php echo $error; ?>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" placeholder="nombre" class="form-control" value="<?php echo $name; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Peticion or Gratitud</label>
                        <textarea name="message" class="form-control" placeholder="peticion"><?php echo $message; ?></textarea>
                    </div>
                    <?php echo $final;?>
                    <div class="form-group" align="center">
                        <input type="submit" name="submit" class="btn btn-info" value="Submit" />
                    </div>
                </form>
            </div>

            <button class="open-button" onclick="openForm()">Registrese para recivir peticiones</button>

            <div class="form-popup" id="myForm">
                <form action="phone.php" method="post" class="form-container">
                    <h1>Registro</h1>
                    <label for="email"><b>Telefono</b></label>
                    <input type="text" placeholder="9561234567" name="phone" required>
                    <a href="test.php">
                        <button type="submit" class="btn" name="submit">Submit</button>
                    </a>
                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                </form>
            </div>

            <script>
                function openForm() {
                      document.getElementById("myForm").style.display = "block";
                    }
                    
                    function closeForm() {
                      document.getElementById("myForm").style.display = "none";
                    }
            </script>

    </body>

    </html>