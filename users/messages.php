    <!-----Navbar starts here----->
    <?php include 'header.php'; ?>
    <!-----Navbar ends here----->
    
    <body>
    <!----Main body content-----> 
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-3 mb-4">
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
                <div class="card">
                    <div class="card-header text-center">
                        <?php
                        date_default_timezone_set('Africa/Nairobi');
                        //Getting the current hour
                            $currentHour = date('G');
                        //Greeting based on time of the day.
                        if($currentHour >= 3 && $currentHour < 12)
                        {
                            $greeting = "Good Morning";
                        }
                        else if($currentHour >=12 && $currentHour < 18)
                        {
                            $greeting = "Good Afternoon";
                        }
                        else 
                        {
                            $greeting = "Good Evening";
                        }
                        ?>    
                        <h5><?php echo $greeting . ', <i>' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '</i>'; ?></h5>
                    </div>
                    <?php include 'side-bar.html'; ?>
                </div>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Your Messages</h5>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control mb-4" id="tableSearch" type="text" placeholder="Search Messages by Company /Subject /Date . . .">
                            </div>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                                <?php
                                    require_once '../config/config.php';
                                    $user_id = $_SESSION['user_id'];
                                    $sql = "SELECT employers.company_name, messages.message_id, messages.message_subject, messages.created_at
                                    FROM employers
                                    INNER JOIN messages
                                    ON employers.company_id = messages.company_id
                                    WHERE user_id = ?
                                    ORDER BY messages.created_at DESC   ";
                                    $stmt = $connection->prepare($sql);
                                    $stmt->bind_param("i", $user_id);
                                    if($stmt->execute())
                                    {
                                        if($result = $stmt->get_result())
                                        {
                                            while ($row = $result->fetch_assoc())
                                            { ?>
                                                <tr>
                                                    <th scope="row">
                                                        <i class="fas fa-chevron-right"></i>
                                                    </th>
                                                    <td>
                                                        <span class="text-primary fw-bold"><?php echo $row['company_name']; ?></span>
                                                    </td>
                                                    <td>
                                                        <span class="text-primary fw-bold"><?php echo $row['message_subject']; ?></span>
                                                        <form action="read-message.php" method="POST">
                                                            <input type="hidden" name="message_id" value="<?php echo $row['message_id']; ?>">
                                                            <input type="submit" value="Open" name="open_message" class="btn btn-warning ms-3">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <?php echo date('Y-m-d h:i a', strtotime($row['created_at'])); ?>
                                                    </td>
                                                </tr>
                                           <?php }
                                        }
                                        else
                                        {
                                            //No message
                                            $_SESSION['no_message'] = "";

                                        }
                                        
                                    }
                                    else
                                    {
                                        //Error while retrieving
                                    }
                                    
                                ?>
                            </tbody>
                        </table>
                        <!-- Info message for no results -->
                        <div id="noResults" class="alert alert-info" role="alert" style="display: none;">
                                No results found.
                            </div>
                            <?php
                                if(isset($_SESSION['no_message']))
                                { ?>
                                    <div class="alert alert-info" role="alert">
                                        No messages to display yet, send a message to an applicant first !
                                    </div>
                               <?php }
                            ?>
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
