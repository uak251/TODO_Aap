  <!--Building a connection with my Server -->
  <?php
  $insert = false;
  $update = false;
  $delete = false;
  $serverName = "localhost";
  $userName = "root";
  $password = "";
  $database = "notes";

  // create a connection

  $conn = mysqli_connect($serverName, $userName, $password, $database);

  //Error handling
  if (!$conn) {
    die("Sorry for failed to connect:  " . mysqli_connect_error());
  }
  if (isset($_GET['delete'])) {

    $Sr = $_GET['delete'];
    // echo $Sr;
    $sql = " DELETE FROM `notes` WHERE `notes`.`Sr` = $Sr";


    $result = mysqli_query($conn, $sql);
    $delete = true;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['SnoEdit'])) {
      // Update the record

      $Sr = $_POST["SnoEdit"];
      $tittleEdit = $_POST["TittleEdit"];
      $descriptionEdit = $_POST["DescriptionEdit"];

      $sql = "UPDATE `notes` SET `Tittle` = '$tittleEdit',`Description` = '$descriptionEdit'   WHERE `notes`.`Sr` = $Sr;
      ";

      $result = mysqli_query($conn, $sql);
      $update = true;
    } else {

      $tittle = $_POST["Tittle"];
      $description = $_POST["Description"];

      $sql = "INSERT INTO `notes` ( `Tittle`, `Description`, `Time Span`) VALUES ( '$tittle', '$description', current_timestamp());
      ";

      $result = mysqli_query($conn, $sql);


      if ($result) {

        $insert = true;
      } else {
        echo "The record not been made due to error" . mysqli_error($conn);
      }
    }
  }


  ?>





  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">

    <title>I Notes - Notes taking making easy</title>
  </head>

  <body>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    -->
    <!-- Edit Modal -->

    <!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button> -->

    <!-- ==========================================>>>>>>>>>>>>>>>>>Modal Starts -->
    <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <input type="hidden" name="SnoEdit" id="SnoEdit">
              <!-- Tittle -->
              <div class="form-group">
                <label for="TittleEdit">Note Title </label>
                <input type="Tittle" class="form-control" id="TittleEdit" aria-describedby="emailHelp" name="TittleEdit" required>

              </div>

              <!-- Description  -->
              <div class="form-group">
                <label required for="Description">Note Description</label>
                <textarea class="form-control" id="DescriptionEdit" name=" DescriptionEdit" rows="3" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
          </div>
          </form>

        </div>

      </div>
    </div>
    </div>

    <!-- ==================================================================>>>>>>>>>>>>>>>>>>>>>> Edit Modal Ends -->
    <!-- // Navbar -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-light bg-light">
      <a class="navbar-brand" href="#">I-Notes</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="#">Contact Us <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <?php
    if ($insert) {
      echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!</strong> Your entry has been submitted successfully.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>';
    }

    ?>
    <?php
    if ($update) {
      echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!</strong> Your entry has been updated successfully.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>';
    }

    ?>
    <?php
    if ($delete) {
      echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
   <strong>Success!</strong> Your entry has been deleted successfully.
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
   </div>';
    }

    ?>


    <!-- ========================> -->

    <div class="container my-3">
      <h2>Add a Note</h2>
      <form action="" method="POST">
        <!-- Tittle -->
        <div class="form-group">
          <label for="Tittle">Note Title </label>
          <input type="Tittle" class="form-control" id="Tittle" aria-describedby="emailHelp" name="Tittle" required>

        </div>

        <!-- Description  -->
        <div class="form-group">
          <label required for="Description">Note Description</label>
          <textarea class="form-control" id="Description" name=" Description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Note</button>
    </div>
    </form>

    <!-- PHP -->
    <div class="container">

      <table class="table" id="myTable">
        <thead>
          <tr>
            <th scope="col">Sr#</th>
            <th scope="col">Tittle</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>

          </tr>
        </thead>
        <tbody>
          <?php

          $sql = "SELECT * FROM `notes`";
          $result = mysqli_query($conn, $sql);

          // find the number of records returned
          $numrows = mysqli_num_rows($result);
          echo "Records found in DataBase are " . $numrows;

          // Display the rows returned by SQL query
          if ($numrows > 0) {

            $Sr = 1;

            while ($row = mysqli_fetch_assoc($result)) {
              //echo var_dump($row) . "<br>";
              //echo implode($row);
              // echo $row['Sr#']. "Hello". $row['Tittle']."Welcome to " .$row['Description'];
              echo "<tr>
    <th scope='row'>" . $Sr . "</th>
    <td>" . $row['Tittle'] . "</td>
    
    <td>" . $row['Description'] . "</td>
    <td>" . " <button class='Edit btn btn-primary' id = " . $row['Sr'] . " >Edit</button> 
      <button class='Delete btn btn-primary' id =d" . $row['Sr'] . " >Delete</button>" . "
      
      </td>
    </tr>";


              $Sr++;
            }
          }




          ?>


        </tbody>
      </table>



    </div>
    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>


    </div>
    </div>

    <script>
      // Edit
      Edits = document.getElementsByClassName('Edit');
      Array.from(Edits).forEach((element) => {
        element.addEventListener("click", (e) => {
          console.log("Edit", );
          tr = e.target.parentNode.parentNode
          Tittle = tr.getElementsByTagName("td")[0].innerText;
          Description = tr.getElementsByTagName("td")[1].innerText;
          DescriptionEdit.value = Description;
          TittleEdit.value = Tittle;
          $('#EditModal').modal('toggle')
          console.log(Tittle, Description);
          SnoEdit.value = e.target.id;
          console.log(e.target.id);
        })
      })
      // Delete
      let deletes = document.getElementsByClassName('Delete');
      Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
          let sno = e.target.id.substr(1); // Extract the serial number from the ID
          let tr = e.target.parentNode.parentNode; // Get the table row


          if (confirm("Confirm 'OK' if you want to delete record.")) {
            console.log("Yes");
            window.location = `/CRUD/index.php?delete=${sno}`;
          } else {
            console.log("No");
          }
        });
      });
    </script>
  </body>

  </html>