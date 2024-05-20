<?php
   $Username = $_POST['Username'];
   $Email = $_POST['Email'];
   $PhoneNumber = $_POST['PhoneNumber'];
   $DateAndTime = $_POST['DateAndTime'];
   $service = $_POST['service'];
   $bloodtype = $_POST['bloodtype'];
    if(!empty($Username)|| !empty($Email)|| !empty($PhoneNumber) || !empty($DateAndTime)|| !empty($service)|| !empty($bloodtype))
    {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbname = "nodejs";

        $conn = new mysqli($host ,$dbUsername,$dbPassword,$dbname);
        if(mysqli_connect_error())
        {
            die('connect error('.mysqli_connect_error().')'.
            mysqli_connect_error());
        }
            else
            {
                $Select = "SELECT Email FROM bloodbank WHERE Email =? LIMIT 1";
                $insert = "insert into bloodbank values(?,?,?,?,?,?)";

                $stmt = $conn->prepare($Select);
                $stmt->bind_param("s",$Email);
                $stmt -> execute();
                $stmt -> bind_result($Email);
                $rnum = $stmt->num_rows();

                if($rnum==0)
                {
                    $stmt->close();
                    $stmt=$conn->prepare($insert);
                    $stmt->bind_param("ssiiss",$Username,$Email,$PhoneNumber,$DateAndTime,$service,$bloodtype);
                    $stmt->execute();
                    header("Location: BookingConfirmation.html");

                }
                else
                {
                    echo"Someone already submitted form using this email";
                }
                $stmt->close();
                $conn->close();


            }     
    }
    else{
        echo "All fields are required";
        die();
    }

?>