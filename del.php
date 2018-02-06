<?php
    session_start();
    ini_set('date.timezone', 'Asia/Shanghai');
    @require('mysql.class.php');
?>

<?php
    @header("Content-Type:text/html; charset=utf-8");

    $id = intval(@$_GET['id']);
    $token = htmlspecialchars(addslashes(@$_GET['token']));

    if (@$_SESSION['token'] === $token) {
        if (!$_SESSION['pass']) {
            echo '<script>alert("请先登录.")</script>';
            die("<script>location.href='index.php';</script>");
        } else {

            $db = new mysql();
            $num = $db->delete('cookies',"where id={$id}");
            if ($num) {
                die("<script>location.href='show.php';</script>");
            } else {
                echo '<script>alert("删除失败.")</script>';
                die("<script>location.href='show.php';</script>");
            }
        }
    } else {
        die("<script>location.href='index.php';</script>");
    }
?>