<?php  {
       $name     = $_POST['name'];
       $email     = $_POST['email'];
       $c_name     = $_POST['c_name'];
       $city     = $_POST['city'];
       $mob     = $_POST['mob'];
       $message     = $_POST['message'];
       
        
        $subject = "'$name' Sent Quick inquiry"; // This is your subject
        
         
        // HTML Message Starts here
        $message ="
        <html>
            <body>
                <table style='width:600px;'>
                    <tbody>
                        <tr>
                            <td style='width:150px'><strong> Name: </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong> Email: </strong></td>
                            <td style='width:400px'>$email</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong> Company Name: </strong></td>
                            <td style='width:400px'>$c_name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>City: </strong></td>
                            <td style='width:400px'>$city</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Website : </strong></td>
                            <td style='width:400px'>$name</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Mobile : </strong></td>
                            <td style='width:400px'>$mob</td>
                        </tr>
                        <tr>
                            <td style='width:150px'><strong>Message : </strong></td>
                            <td style='width:400px'>$message</td>
                        </tr>
                      
                       
                        
                        
                    </tbody>
                </table>
            </body>
        </html>
        ";
        // HTML Message Ends here
         
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
       
        // More headers
        $headers .= 'From: contact@nexdee.com' . "\r\n"; // Give an email id on which you want get a reply. User will get a mail from this email id
        $headers .= 'Cc:contact@nexdee.com ' . "\r\n"; // If you want add cc
        $headers .= 'Bcc:contact@nexdee.com ' . "\r\n"; // If you want add Bcc
        $to = 'contact@nexdee.com';
        if(mail($to,$subject,$message,$headers)){
            // Message if mail has been sent
            echo "<script>window.location.href='index.php'</script>";
        }
        
        else{
            // Message if mail has been not sent
          echo "<script>window.location.href='index.php'</script>";
                
             
        }
}
        ?>