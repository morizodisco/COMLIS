<?php
function d($var) {
    $args = func_get_args();
    echo '<pre>';
    var_dump(...$args);
    echo '</pre>';
}

function hd($var) {
    $args = func_get_args();
    echo '<!-- <pre>';
    var_dump(...$args);
    echo '</pre> -->';
}

function h($var) {
    return htmlspecialchars($var, ENT_QUOTES, 'UTF-8', false);
}
