<?php

include "partials/header.php";
include "partials/menu.php";
$id = $_GET['id'];
$sql = "select * from users where id = '$id'";
$res = mysqli_query($conn, $sql);
if ($res->num_rows > 0) {
    if ($row = $res->fetch_assoc()) {
        $full_name = $row["name"];
        $email = $row["email"];

    }
} else {
    header("location:manage-admin.php");
}
?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>


<?php
include "partials/footer.php";
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);


    mysqli_stmt_bind_param($stmt, "ssi", $full_name, $email, $id);


    $edit = mysqli_stmt_execute($stmt);


    if ($edit) {
        echo "Update successful";
    } else {
        echo "Update failed";
    }


    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    if ($edit) {
        $_SESSION['users'] = "<span style='color: #2ed573'>updated success</span>";
        header("location:manage-admin.php");
    } else {
        $_SESSION['users'] = "<span style='color: #2ed573'>updated failed</span>";
        header("location:manage-admin.php");
    }
}
?>
