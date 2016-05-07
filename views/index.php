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
    <div class = "container">
    <div class = "row">
        <div class = "col-md-12">
        <div class = "page-header">
            <h2><?= $MSG_TITLE[$PAGE_NAME] ?></h2>
        </div>
        </div>
        <div class = "col-md-2">
            <ul class="list-group">
                <?php foreach($stu_info as $elem): ?>
                <li class = "list-group-item">
                    <span class = "badge"><?= $elem[1] ?></span>
                    <?= $elem[0] ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <div class = "list-group">
                <a class = "list-group-item" href = "logout.php"><?= $MSG_LOGOUT ?></a>
                <?php foreach($sidebar_info as $elem): ?>
                <a class = "list-group-item" href = "index.php?mod=<?= $elem["url"] ?>">
                    <?= $elem["label"] ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div id = "main_content" class = "col-md-10">
        <div class = "panel panel-default">
            <div class = "panel-body table-responsive">
                <?= $main_info ?>
            </div>
        </div>
        </div>
    </div> <!-- end of row -->
    </div> <!-- end of container -->
    <?php require_once("footer.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>