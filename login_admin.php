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
                    <input type="text" placeholder="Email" class="border-radius-top" name="email"/>

                    <input type="password" placeholder="Password" class="no-radius" name="password"/>


                    <input type="submit" name="Login" value="Login"
                           class="button small border-radius-bottom coral-bg" style="width: 50%">
                    <button class="button small border-radius-bottom coral-bg" onclick="window.open('signup.php')">Sign
                        up
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
</body>

<?php
if (isset($_POST['Login'])) {
    $username = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    mysqli_stmt_execute($stmt);


    $queryResult = mysqli_stmt_get_result($stmt);


    if (empty($email)) {
        $error = "Please enter your email.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    }

    if (empty($password)) {
        $error = "Please enter your password.";
    } elseif (strlen($password) < 5) {
        $error = "Your password must be at least 6 characters long.";
    }
    if (!isset($error)) {
        echo "Thank you for signing up!";
    } else {
        echo $error;
    }




    $num_row = mysqli_num_rows($queryResult);
    if ($num_row > 0) {
        $row = mysqli_fetch_assoc($queryResult);
        session_start();
        $_SESSION['admin_id'] = $row['id'];
        header("location:manage-admin.php");
    }


}
?>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>

</html>

