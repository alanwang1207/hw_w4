<!-- <?php
      function start_session($expire = 0)
      {
        if ($expire == 0) {
          $expire = ini_get('session.gc_maxlifetime');
        } else {
          ini_set('session.gc_maxlifetime', $expire);
        }

        if (empty($_COOKIE['PHPSESSID'])) {
          session_set_cookie_params($expire);
          session_start();
        } else {
          session_start();
          setcookie('PHPSESSID', session_id(), time() + $expire);
        }
      }
      ?> -->

<?php

if (isset($_GET["logout"])) {
  if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
  }
  $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
  header("Location: index.php");
  exit();
}

if (isset($_POST["btnHome"])) {
  header("Location: index.php");
  exit();
}

if (isset($_POST["btnOK"])) {
  $sUserName = $_POST["txtUserName"];
  if (trim($sUserName) != "") {
    //echo $userName;
    $_SESSION["userName"] = $userName;
    if (isset($_SESSION["lastPage"]))
      header(sprintf("Location: %s", $_SESSION["lastPage"]));
    else
      header("Location: index.php");
    exit();
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