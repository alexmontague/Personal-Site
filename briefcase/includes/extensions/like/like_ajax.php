<?php

include("includes/extensions/like/like.class.php");

if (isset($_POST['vote']) && isset($_POST['post']) && $_POST['post'] != "" && $_POST['vote'] != "") {
    $like = new Like();
    $like->addToFile($_POST['post'], $_POST['vote']);
    exit();
}
