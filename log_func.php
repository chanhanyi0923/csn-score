<?php
function unset_cookie ($_key) {
    if (isset($_COOKIE[$_key])) {
        unset($_COOKIE[$_key]);
        setcookie($_key, "", time() - 36000);
    }
}
function clean_session () {
    session_unset();
    session_destroy();
}
?>