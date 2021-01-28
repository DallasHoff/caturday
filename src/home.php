<?php
$title = 'Home';
$postLimit = 25;
$posts = dbQuery("select * from posts order by date_posted desc");
