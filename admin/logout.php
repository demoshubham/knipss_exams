<?php
session_cache_limiter('nocache');
session_start();
include ("settings.php");
page_header();
logout();
page_footer();
?>