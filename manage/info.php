<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>停車場管理系統</title>
</head>
<body>
    <?php
        $name = $_POST['Name'];
        $username = $_POST['Username'];
        $password = $_POST['Password'];
    ?>
    <form action="index.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <input type="submit" name="Submit" value="<" />
    </form>
    <h1>停車場管理系統</h1>
    <?php
        $db = new mysqli('mysql.cs.ccu.edu.tw', 'wtc105u', 'rqXexGSzNw', 'wtc105u_parking');
        $db->query("set names utf8");

        $query = "SELECT Address, Charge, Total, Remain FROM Private WHERE Name = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param('s', $name);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($address, $charge, $total, $remain);
        $stmt->fetch();

        $max = $total;
        if (!isset($charge) || $charge == "")
            $charge = "未提供資訊";
        if (!isset($total) || $total == 0) {
            $total = "未提供資訊";
            $max = 999;
        }
        echo "<p>名稱: ".$name."</p>";
        echo "<p>地址: ".$address."</p>";
        echo "<p>收費方式: ".$charge."</p>";
        echo "<p>總車位數: ".$total."</p>";
    ?>
    <form action="update.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <label for="Remain">剩餘車位: </label>
        <input type="number" name="Remain" id="Remain" min="0" max="<?=$max?>" value="<?=$remain?>" />
        <input type="hidden" name="Name" value="<?=$name?>" />
        <input type="submit" name="Update" value="Update" />
    </form>
    <form action="index.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <input type="submit" name="Submit" value="主頁" />
    </form>
    <form action="../add/index.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <input type="submit" name="Submit" value="新增" />
    </form>
    <form action="../edit/index.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <input type="submit" name="Submit" value="編輯" />
    </form>
    <form action="../delete/index.php" method="post">
        <input type="hidden" name="Username" value="<?=$username?>" />
        <input type="hidden" name="Password" value="<?=$password?>" />
        <input type="submit" name="Submit" value="刪除" />
    </form>
</body>
</html>
