<?php
$title = 'Home';
$posts = dbQuery("select * from posts order by date_posted desc limit 36");
