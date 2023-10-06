
<?php
include('config/config.php');

$sql = "SELECT * FROM candidates";
$result = mysqli_query($connection, $sql);

if(!$result)
{
    die("Connection Failed : " . mysqli_error());
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users | Skill-Bridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>

  <div class="container-fluid my-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
        <a href="home.php" class="btn  btn-outline-info mb-2 ">Go Back</a>
            <div class="card shadow">
                <div class="card-header">
                    <h3 class="text-center">
                        All Candidates
                    </h3>
                </div>
                <div class="card-body">
                <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#id</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone-Number</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                            
                                <?php while($row = mysqli_fetch_assoc($result)){
                                    ?>
                            <tr>
                                    <th scope="row"><?php echo $row['id']; ?></th>
                                    <td><?php echo $row['user_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <a href=""><td><button class="btn btn-outline-primary">Edit</button></td></a>
                                    <a href=""><td><button class="btn btn-outline-danger">Delete</button></td></a>
                               <?php } ?>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>