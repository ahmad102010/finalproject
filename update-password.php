<?php
include "partials/header.php";
include "partials/menu.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select * from users where id = '$id'";
    $res = mysqli_query($conn, $sql);
    if ($res->num_rows > 0) {
        $row = $res->fetch_assoc();
        $old_password =$row['password'];
       // echo $old_password;
    }
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br>
        <?php
        if (isset($_SESSION['admin'])) {
            echo $_SESSION['admin'];
            unset($_SESSION['admin']);
        }
        ?>

        <br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password" required>
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password" required>
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
$current_password = md5($_POST['current_password']);
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

    if ($old_password == $current_password) {
         if($new_password == $confirm_password){
             $new_password_enc=md5($new_password);

             $sql = "UPDATE users SET password = ? WHERE id = ?";
             $stmt = mysqli_prepare($conn, $sql);


             mysqli_stmt_bind_param($stmt, "si", $new_password_enc, $id);

             $res = mysqli_stmt_execute($stmt);

             if ($res) {
                 echo "Update successful";
             } else {
                 echo "Update failed";
             }

             mysqli_stmt_close($stmt);
             mysqli_close($conn);

             if ($res){
                 $_SESSION['users'] = "<span style='color: #2ed573'>Password changed</span>";
                 header("location:manage-admin.php?id=$id");
             }else{
                 $_SESSION['users'] = "<span style='color: red'>Password not changed</span>";
                 header("location:manage-admin.php?id=$id");
             }
         }else {
             $_SESSION['users'] = "<span style='color: red'>Password not matched</span>";
             header("location:manage-admin.php?id=$id");
         }
    } else {
        $_SESSION['users'] = "<span style='color:red'>Password not correct</span>";
        header("location:manage-admin.php?id=$id");
    }
}

