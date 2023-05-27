<?php
include 'partials/constants.php';
?>

    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/foundation.css"/>
        <script src="js/vendor/modernizr.js"></script>
        <link href="css/style.css" rel="stylesheet"/>
        <style>
            html, body {
                height: 100%;
                background: #262c31;
            }

            .main {
                height: 100%;
                width: 100%;
                display: table;
            }

            .wrapper {
                display: table-cell;
                height: 100%;
                vertical-align: middle;
            }

            #login {
                width: 30%;
            }

            @media all and (max-width: 800px) {
                #login {
                    width: 90%;
                }
            }
        </style>
    </head>

    <body>
    <div class="main">
        <div class="wrapper">
            <div id="login" class="row" style="margin: auto">
                <div class="large-12 columns text-center">

                    <form method="post" action="">

                        <input type="text" placeholder="Name" class="border-radius-top" name="name"/>
                        <input type="email" placeholder="Email" class="border-radius-top" name="email"/>
                        <input type="password" placeholder="Password" class="no-radius" name="password"/>

                            <input type="submit" name="Login" value="Sign up"
                                   class="button small border-radius-bottom coral-bg" style="width: 50%">
                            <button class="button small border-radius-bottom coral-bg" onclick="window.open('login_admin.php')">Log
                                    in</button>


                    </form>
                </div>
            </div>

        </div>
    </div>
    </body>

<?php

if (isset($_POST['Login'])) {
    if ($_POST['name'] != "" || $_POST['email'] != "" || $_POST['password'] != "") {
        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $role = 2;
        $created = date("y-m-d");
        $sql = "INSERT INTO users (name, email, password, role, created) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $password, $role, $created);

        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            echo "Insertion successful";
        } else {
            echo "Insertion failed";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);


        header("location:login_admin.php");
    }
}


?>
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>

    </html>


<?php
