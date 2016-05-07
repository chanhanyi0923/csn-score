<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $MSG_TITLE[$PAGE_NAME] ?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <p></p>
    <div class = "container">
    <div class = "row">
        <?php if(isset($err_info)): ?>
        <div class = "alert alert-danger">
        <?= $MSG_ERR_INFO[$err_info] ?>
        </div>
        <?php endif; ?>
    <div class = "col-md-12">
        <div class = "page-header">
            <h2><?= $MSG_WEB_NAME ?></h2>
        </div>
    </div>
    <div class = "col-md-6 col-md-offset-3">
        <form class="form-horizontal" action = "login.php" method = "post">
            <div class="form-group">
                <label class="col-sm-4 control-label"><?= $MSG_USERID ?></label>
                <div class="col-sm-8">
                    <input type = "text" class = "form-control" name = "userid">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?= $MSG_PASSWD ?></label>
                <div class="col-sm-8">
                    <input type = "password" class = "form-control" name = "passwd">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-4">
                    <button name="submit" type="submit" class="btn btn-default btn-block">
                        <?= $MSG_LOGIN ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class = "col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <?= $MSG_INSTRUCTION ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php require_once("footer.php"); ?>
</body>
</html>