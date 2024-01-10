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
        <script src="https://cdn.tiny.cloud/1/oyox4lvrma6uzyriloy2t3ljls4asn3ce7fg90wdu2uups41/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="messages.php" class="btn btn-outline-primary mb-3">Back</a>
                        <?php
                            require_once '../config/config.php';
                            $message_id = $_POST['message_id'];
                            $sql = "SELECT employers.company_name, employers.company_id, messages.* 
                                    FROM messages
                                    INNER JOIN employers ON employers.company_id = messages.company_id
                                    LEFT JOIN users ON users.user_id = messages.user_id
                                    WHERE messages.message_id = ? AND messages.company_id = ?";

                            $stmt = $connection->prepare($sql);
                            $stmt->bind_param("ii", $message_id, $_SESSION['company_id']);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                            ?>
                                    <div class="card">
                                        <div class="card-body border-bottom">
                                            <h5>
                                                <?php echo $row['message_subject']; ?>
                                            </h5>
                                            <div class="row border-bottom">
                                                <div class="col-md-6">
                                                    <p>
                                                        From : <?php echo $row['company_name']; ?>
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="text-end">
                                                        <?php echo date('Y-m-d h:i A', strtotime($row['created_at'])); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <p class="mt-2">
                                                <?php echo $row['message_content']; ?>
                                            </p>
                                            <!-------------The replies messages------------->
                                            <h5 class="mb-3">
                                                Reply Message
                                            </h5>
                                            <?php
                                            require_once '../config/config.php';

                                            $message_id = $_POST['message_id'];

                                            $sql_reply = "SELECT 
                                                            reply_messages.reply_messages_id,
                                                            reply_messages.message_id,
                                                            reply_messages.user_id,
                                                            reply_messages.company_id,
                                                            reply_messages.sender,
                                                            reply_messages.reply_message_content,
                                                            reply_messages.created_at,
                                                            users.lastname,
                                                            employers.company_name
                                                        FROM 
                                                            reply_messages
                                                        INNER JOIN 
                                                            users ON reply_messages.user_id = users.user_id
                                                        LEFT JOIN
                                                            employers ON reply_messages.sender = 'company' AND reply_messages.user_id = employers.company_id
                                                        WHERE 
                                                            reply_messages.message_id = ? AND reply_messages.company_id = ?";

                                            $stmt_reply = $connection->prepare($sql_reply);
                                            $stmt_reply->bind_param("ii", $message_id, $_SESSION['company_id']);

                                            if ($stmt_reply->execute()) {
                                                $result_reply = $stmt_reply->get_result();

                                                if ($result_reply->num_rows > 0) {
                                                    while ($row_reply = $result_reply->fetch_assoc()) {
                                            ?>
                                                        <div class="border-top">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <p class=" mt-3">
                                                                    <?php
                                                                    if ($row_reply['sender'] == 'company') { ?>
                                                                        <p class="text-primary fw-bold">Company Message<i class="fa-solid fa-circle-info fa-lg ms-2"></i></p>
                                                                    <?php } elseif ($row_reply['sender'] == 'user') { ?>
                                                                        <p class="text-warning fw-bold">Applicant Message<i class="fa-solid fa-lightbulb fa-lg ms-2"></i></p>
                                                                    <?php }
                                                                    ?>
                                                                </p>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <p class="text-end mt-3 text-info">
                                                                        <i class="fa-regular fa-calendar-days fa-lg me-2"></i><?php echo date('Y-m-d h:i A', strtotime($row_reply['created_at'])); ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <p>
                                                                <?php echo $row_reply['reply_message_content']; ?>
                                                            </p>
                                                        </div>
                                            <?php
                                                    }
                                                } else { ?>
                                                    <div class="alert alert-primary" role="alert">
                                                        No Reply Messages Yet
                                                    </div>
                                                <?php }
                                            } else {
                                                echo "Error executing the query: " . $stmt_reply->error;
                                            }

                                            $stmt_reply->close();
                                            ?>
                                            <!-------------The replies messages end Here------------->
                                        </div>

                                        <div class="card-body">
                                            <h5>
                                                Send Reply
                                            </h5>
                                            <form action="../process/reply-message.php" method="POST">
                                                <input type="hidden" name="message_id" value="<?php echo $row['message_id']; ?>">
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                <div class="form-floating mb-3">
                                                    <textarea class="form-control" name="reply_message_content" placeholder="Type Message Content Here . . ." id="floatingTextarea"></textarea>
                                                </div>
                                                <script>
                                                    tinymce.init({
                                                        selector: 'textarea',
                                                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                                        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |  align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                                    });
                                                </script>
                                                <input type="submit" name="reply_message" class="btn btn-outline-primary" value="Reply">
                                            </form>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                // Handle the case where no messages are found
                            }
                            ?>

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