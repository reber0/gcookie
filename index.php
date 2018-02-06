<?php
    session_start();
    ini_set('date.timezone', 'Asia/Shanghai');
    @require('mysql.class.php');
?>

<?php
    @header("Content-Type:text/html; charset=utf-8");
    
    $password = "123456";

    if (@$_POST['upass']) {
        $pwd = @$_POST['upass'];

        if ($pwd && $password === $pwd){
            $_SESSION['pass'] = $pwd;
            die("<script>location.href='show.php';</script>");
        } else {
            echo '<script>alert("password error.")</script>';
            die("<script>location.href='index.php';</script>");
        }
    } else {
        echo '
    <center>
        <h3>index</h3>
        <form method="post" acriotn="index.php">
        <table width="380" border="0" cellpadding="4">
            <tr>
                <td colspan="2" align="center">
                    Password: <input type="password" name="upass" />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="login" />
                </td>
            </tr>
        </table>
        </form>
    </center>';
    }
?>
