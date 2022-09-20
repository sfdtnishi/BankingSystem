<?php

use function PHPSTORM_META\type;

include('nav.html');
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>transfer money</title>
</head>
<style>
  
        #button {
  margin: 20px;
  position: absolute;
  
  left: 48%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);

    }
</style>
<body class="p-3 mb-2 bg-light text-dark">

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sender = $_POST['sender'];
        $receiver = $_POST['receiver'];
        $amount = $_POST['amount'];

//       here, details such servername, username, password and database has been left as per the requirenment
        $servername = '';
        $username = '';
        $password = '';
        $database = '';
        $conn = mysqli_connect($servername, $username, $password, $database);
        
       
        $sql = "SELECT `balance` FROM `customer` WHERE `account`='$sender'";
        $result = mysqli_query($conn, $sql);
        $sender_curr_bal = mysqli_fetch_assoc($result)['balance'];
        

        $sql = "SELECT `balance` FROM `customer` WHERE `account`='$receiver'";
        $result = mysqli_query($conn, $sql);
        $receiver_curr_bal = mysqli_fetch_assoc($result)['balance'];
        
        

        if($sender_curr_bal>$amount){
            $amount_updated_sender = $sender_curr_bal - $amount;
          
            $amount_updated_receiver = $receiver_curr_bal + $amount;
         
            

            $sql1 = "UPDATE `customer` SET `balance`='$amount_updated_sender' WHERE `account`= '$sender'";
            $sql2 = "UPDATE `customer` SET `balance`='$amount_updated_receiver' WHERE `account`='$receiver'"; 
            $result1=mysqli_query($conn,$sql1);
            $result2=mysqli_query($conn,$sql2);
            
        
        if($result1 && $result2){
            	
           $date=date("Y-m-d H:i", time());
        
            echo '<div class="alert alert-success" role="alert">
            Amount Trasferred <a href="#" class="alert-link">Successfully</a>. Thank you for using Sparks Bank System. </div>';

            $sql2 = "INSERT INTO `transfers` (`sender`, `receiver`, `amount`, `date`, `Status`) VALUES ('$sender', '$receiver', '$amount', '$date', 'succeed');";
            $result2 = mysqli_query($conn, $sql2);
            

        }else{          
            
            $sql2 = "INSERT INTO `transfers` (`sender`, `receiver`, `amount`, `date`, `Status`) VALUES ('$sender', '$receiver', '$amount', '$date','failed'";
            $result2 = mysqli_query($conn, $sql2);

            echo '<div class="alert alert-danger" role="alert">
            Something went wrong!<a href="#" class="alert-link">Failed</a>.</div>';
            
        }
    }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Insufficient balance!<a href="#" class="alert-link">Failed</a>.</div>';
        }
    }
          
    

    ?>

    <div class="card text-white bg-info mb-3" style="max-width: 100vh; margin-left:55vh; margin-top:5%">
        <h3 style="text-align:center; margin-top:20px">Enter transaction detials</h3>
        <form action="/banksystem/transfer.php" method="POST" style="padding: 25px; margin:25px">
            <div class="form-group">
                <label for="sender"><strong>From</strong></label>
                <input type="text" class="form-control" id="sender" name="sender" placeholder="Sender's account number" required value="<?php if(isset($_GET['reads'])){echo $_GET['reads'];} ?>">

            </div>
            <div class="form-group">
                <label for="receiver"><strong>To</strong></label>
                <input type="text" class="form-control" id="receiver" name="receiver" placeholder="receiver's account number" required>

            </div>
            <div class="form-group">
                <label for="amount"><strong>Amount</strong></label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="amount to be paid" required>

            </div>
            <button  id="button" type="submit" class="btn btn-primary" style="background-color:rgba(0, 0, 78, 4); " >Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
