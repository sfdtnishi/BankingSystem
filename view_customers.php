<?php
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

  <title>customers</title>
</head>

<body class="p-3 mb-2 bg-light text-dark">
  <div class="p-3 mb-2 bg-info text-white">
    <div class="view">
      <!-- table of all customers -->
      
        <table class="table" class="card text-white bg-info mb-3" style="max-width: 58rem; margin-left:40vh;">
          <h2>List of all customers</h2>
          <style>
            h2 {
              text-align: center;
              color: rgba(0, 0, 78, 4);

            }
          </style>

          <?php
          //       here, details such servername, username, password and database has been left as per the requirenment
          $servername = '';
          $username = '';
          $password = '';
          $database = '';

          $conn = mysqli_connect($servername, $username, $password, $database);

          $sql = "SELECT * FROM `customer`";
          $result = mysqli_query($conn, $sql);

          ?>

          <thead>
            <tr>
              <th scope="col">Account No.</th>
              <th scope="col">Customer Name</th>
              <th scope="col">Email Id</th>
              <th scope="col">Current Balance</th>
              <th scope="col">Send Money from</th>
            </tr>
          </thead>
          <?php
          echo "<tbody>";
          while ($row = mysqli_fetch_assoc($result)) {
            echo    '
      <tr>
        <td>' . $row['account'] . '</td>
        <td>' . $row['name'] . '</td>
        <td>' . $row['email'] . '</td>
        <td>' . $row['balance'] . '</td>
        
        <td> <a href="transfer.php?reads='.$row['account'].'"> <button type="button" class="btn btn-dark">Transfer</button> </a></td>
      </tr>';
          }

          echo "</tbody>";
          ?>

        </table>
    
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
