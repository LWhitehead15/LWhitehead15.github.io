<?php
  
if($_POST) {
    $first_name = "";
    $last_name = "";
    $email_addr = "";
    $message = "";
    $phone_input = "";
    $recipient = "liam.p.whitehead@gmail.com";
    $email_body = "<div>";
      
    if(isset($_POST['first_name'])) {
        $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
        $first_name .= "<div>
                           <label><b>First Name:</b></label>&nbsp;<span>".$first_name."</span>
                        </div>";
    }

    if(isset($_POST['last_name'])) {
      $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
      $last_name.= "<div>
                         <label><b>Last Name:</b></label>&nbsp;<span>".$last_name."</span>
                      </div>";
  }
 
    if(isset($_POST['email_addr'])) {
        $email_addr = str_replace(array("\r", "\n", "%0a", "%0d"), '', $_POST['email_addr']);
        $email_addr = filter_var($email_addr, FILTER_VALIDATE_EMAIL);
        $email_addr .= "<div>
                           <label><b>Email:</b></label>&nbsp;<span>".$email_addr."</span>
                        </div>";
    }
      
    if(isset($_POST['phone_input'])) {
        $phone_input = filter_var($_POST['phone_input'], FILTER_SANITIZE_STRING);
        $phone_input .= "<div>
                           <label><b>Phone number:</b></label>&nbsp;<span>".$phone_input."</span>
                        </div>";
    }
      
    if(isset($_POST['message'])) {
        $message = htmlspecialchars($_POST['message']);
        $email_body .= "<div>
                           <label><b>Message:</b></label>
                           <div>".$message."</div>
                        </div>";
    }
      
    $email_body .= "</div>";
 
    $headers  = 'MIME-Version: 1.0' . "\r\n"
    .'Content-type: text/html; charset=utf-8' . "\r\n"
    .'From: ' . $email_addr . "\r\n";
      
    if(mail($recipient, $email_body, $headers)) {
        echo "<p>Thank you for contacting us, $first_name. You will get a reply within 24 hours.</p>";
    } else {
        echo '<p>We are sorry but the email did not go through.</p>';
    }
      
} else {
    echo '<p>Something went wrong</p>';
}
?>