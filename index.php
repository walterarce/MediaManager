<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Media Manager</title>
    <link rel="shortcut icon" href="#" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.min.js" integrity="sha512-7oYXeK0OxTFxndh0erL8FsjGvrl2VMDor6fVqzlLGfwOQQqTbYsGPv4ZZ15QHfSk80doyaM0ZJdvkyDcVO7KFA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<?php
$url = 'http';
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$url .= "s";}
$url .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
    $url .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
} else {
    $url .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
}
?>
<div class="card">
    <div ng-app="moviesApp" class="container">
        <movies></movies>
    </div>
</div>

</body>
<link rel="stylesheet" type="text/css" href=<?php echo $url . "css/bootstrap.min_hero.css" ?> media="screen" />
<script src=<?php echo $url . "js/list.js" ?>></script>
</html>