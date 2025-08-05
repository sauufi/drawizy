<?php
// Fungsi helper global
function slugify($text)
{
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
}

function isLoggedIn()
{
    return isset($_SESSION['user']);
}
