<?php

session_start();

//Check if user is logged in
if(!isset($_SESSION['company_id']))
{
    header('location: ../login.php');
    $_SESSION['must_login'] = "";
    exit();
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | My-Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" 
    integrity="sha512-mQ93GR66o7D/EVEqUp0BqL45PQa24a6LZQ2Hb4cZ2z0x0vfFSzBvKv0ATs2DSh9efIt2uc5bBO1RoQ1HhehD5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@700&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  </head>
  <style>
    .navbar-nav .nav-link
    {
        color: white !important;
    }
    .navbar-brand
    {
        font-size: 29px;
        font-family: 'caveat', sans-serif;
        color: white !important;

    }
  </style>
  <!-----Navbar starts here----->
  <nav class="navbar navbar-expand-lg  bg-warning">
        <div class="container">
            <a class="navbar-brand fw-bold" href="../index.php">Skill-Bridge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav my-3 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link" href="jobs.php">Jobs</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-----Navbar ends here----->
    <body>
    <!----Main body content-----> 
    <div class="container my-3">
        <div class="row">
            <div class="col-12 col-lg-3 mb-3">
            <?php
                    if(isset($_SESSION['message_send']))
                    { 
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Hello !</strong> Message has been sent Successfully !
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                            unset($_SESSION['message_send']);
                    }
                ?>
                <?php
                if(isset($_SESSION['failed_reply']))
                { 
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops !</strong> Failed to send Reply !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['failed_reply']);
                }
            ?>
            <?php
                if(isset($_SESSION['empty_reply']))
                { 
                    ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Oops !</strong> Cannot send Empty reply !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['empty_reply']);
                }
            ?>
            <?php
                if(isset($_SESSION['reply_sent']))
                { 
                    ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Hello !</strong> Your reply has been sent !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php 
                        unset($_SESSION['reply_sent']);
                }
            ?>
                <div class="card">
                    <div class="card-header">
                    <?php
                        //Getting the current hour
                            $currentHour = date('G');
                        //Greeting based on time of the day.
                        if($currentHour >= 5 && $currentHour < 12)
                        {
                            $greeting = "Good Morning";
                        }
                        else if($currentHour >=12 && $currentHour < 17)
                        {
                            $greeting = "Good Afternoon";
                        }
                        else 
                        {
                            $greeting = "Good Evening";
                        }
                        ?>
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['company_name'] . '</i>'; ?></h5>
                    </div>
                    <?php include 'side-bar.html'; ?> 
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-md-6">MailBox</div>
                            <div class="col-md-6 text-end">
                                <a href="create-mail.php" class="btn btn-warning text-light"><i class="fa-solid fa-message fa-lg me-2"></i>Create </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Search Messages . . .">
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php
                                    require_once '../config/config.php';
                                    // Assuming you have a database connection established

                                    // Select firstname and lastname from the users table
                                    $sql = "SELECT users.firstname, users.lastname, 
                                    messages.message_id, messages.message_subject, messages.created_at 
                                    FROM users
                                    INNER JOIN messages ON users.user_id = messages.user_id
                                    INNER JOIN employers ON employers.company_id = messages.company_id
                                    WHERE employers.company_id = ?
                                    ORDER BY messages.created_at DESC";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param('i', $_SESSION['company_id']);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    if ($result->num_rows > 0) 
                                    {
                                        // Fetch the result as an associative array
                                        while ($row = $result->fetch_assoc()) 
                                        { ?>
                                            <tr>
                                                <th scope="row">
                                                    <i class="fa-solid fa-chevron-right"></i>
                                                </th>
                                                <td>
                                                    <?php echo $row['firstname'];?>  <?php echo $row['lastname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['message_subject']; ?>
                                                    <form action="read-message.php" method="POST" class="ms-3">
                                                        <input type="hidden" name="message_id" value="<?php echo $row['message_id']; ?>">
                                                        <input type="submit" name="open_message" value="Open" class="btn btn-outline-primary">
                                                    </form>
                                                </td>
                                                <td>
                                                    <?php echo date('Y-m-d h:i a', strtotime($row['created_at'])); ?>
                                                </td>
                                            </tr>
                                       <?php }

                                        // Free the result set
                                        $result->free_result();
                                    } 
                                    else 
                                    {
                                        $_SESSION['no_message'] = "No messages to display yet, send a message to an applicant first!";
                                    }

                                    // Close the database connection
                                    $connection->close();
                                ?>
                            </tbody>
                        </table>
                         <!-- Info message for no results -->
                            <div id="noResults" class="alert alert-info" role="alert" style="display: none;">
                                No results found.
                            </div>
                            <!-- Add the JavaScript code here -->
                            <script>
                                $(document).ready(function(){
                                    $("#tableSearch").on("keyup", function() {
                                        var value = $(this).val().toLowerCase();
                                        var found = false;

                                        $("#myTable tr").filter(function() {
                                            var rowText = $(this).text().toLowerCase();
                                            var isRowVisible = rowText.indexOf(value) > -1;
                                            $(this).toggle(isRowVisible);

                                            if (isRowVisible) {
                                                found = true;
                                            }
                                        });

                                        // Display or hide the info message based on search results
                                        $("#noResults").toggle(!found);
                                    });
                                });
                            </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
 <!----- Footer Section starts here----->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    </body>
</html>