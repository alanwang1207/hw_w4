<?php
if (isset($_POST["cancelButton"])) {
  header("location: index.php");
  exit();
}
if (!isset($_GET["id"])) {
  die("id not found");
}
$id = $_GET["id"];
if (! is_numeric ( $id ))
    die ( "id not a number." );


require("config.php");
if (isset($_POST["okButton"])) {
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $cityId = $_POST["cityId"];
  $sql = <<<multi
    update employee set
       firstName = '$firstName',
       lastName='$lastName', cityId = $cityId
    where employeeId = $id
  multi;
  mysqli_query($link, $sql);
  header("location: index.php");
  exit();
}
else {
  $sql = <<<multi
    select * from employee where employeeId = $id
  multi;
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改會員資料</title>
</head>

<body>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <form>
        <div class="form-group row">
            <label for="userName" class="col-4 col-form-label">帳號</label>
            <div class="col-8">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fa fa-address-card"></i>
                        </div>
                    </div>
                    <input id="userName" name="userName" value="<?= $row["userName"] ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="passWord" class="col-4 col-form-label">密碼</label>
            <div class="col-8">
                <input id="passWord" name="passWord" value="<?= $row["passWord"] ?>" type="text" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="offset-4 col-8">
                <button name="okButton" type="submit" class="btn btn-primary">確認送出</button>
                <button name="cancelButton" value="cancel" type="submit" class="btn btn-primary">取消修改</button>
            </div>
        </div>
    </form>
</body>

</html>