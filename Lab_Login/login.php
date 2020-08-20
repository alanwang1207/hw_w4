<?php
session_start();
if (isset($_GET["logout"])) {
  // session_unset($sUserName);
  session_destroy();
  header("Location: index.php");
  exit();
}

if (isset($_POST["btnHome"])) {
  header("Location: index.php");
  exit();
}

if (isset($_POST["btnOK"])) {
  $sUserName = $_POST["txtUserName"];
  $passWord = $_POST['txtPassword'];
  if (trim($sUserName) != "") {
    echo "Hi {$sUserName} :";

    require("config.php");

    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $port);
    mysqli_query($link, "set names utf-8");
    $sql = "select * from `user` WHERE `username` = '$sUserName' and `password` = '$passWord'";

    $result = mysqli_query($link, $sql);
    $row_count = mysqli_num_rows($result);
    var_dump($result);
    

    $_SESSION["userName"] = $sUserName;
    if ($row_count != 0) {
      echo "welcome!{$sUserName}";
      header("Location: index.php");
      exit();
    } else {
      echo "輸入資料有誤";
      //header("Location: index.php");
      exit();
    }
  } else {
    echo "請輸入帳號";
  }
}
?>


<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Lab - Login</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="login.php">
    <table width="300" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#F2F2F2">
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC">
          <font color="#FFFFFF">會員系統 - 登入</font>
        </td>
      </tr>
      <tr>
        <td width="80" align="center" valign="baseline">帳號</td>
        <td valign="baseline"><input type="text" name="txtUserName" id="txtUserName" /></td>
      </tr>
      <tr>
        <td width="80" align="center" valign="baseline">密碼</td>
        <td valign="baseline"><input type="password" name="txtPassword" id="txtPassword" /></td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#CCCCCC"><input type="submit" name="btnOK" id="btnOK" value="登入" />
          <input type="reset" name="btnReset" id="btnReset" value="重設" />
          <input type="submit" name="btnHome" id="btnHome" value="回首頁" />
        </td>
      </tr>
    </table>
  </form>
</body>

</html>