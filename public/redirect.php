<?php
/**
 *  Quick and dirty Implementation of Tracking POC, based on cached Redirects (Moved Permanently [301])
 */

    // Connect to db, we want to keep track of our visitors
    $link = mysqli_connect('localhost', 'root', 'root', 'tracking');
    if (!$link) die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());

    // Determine if our User came from cached Redirect Page (we require that in this case the query Parameter 'id' is set
    // Otherwise create new ID for User
    if(isset($_REQUEST['id'])) {
        echo "Your Tracking ID " . htmlentities($_REQUEST['id']);

        // Update Timestamp in DB
        $query = "UPDATE users SET last_seen = " . time() . " WHERE tracking_id = '" . mysqli_real_escape_string($link, $_REQUEST['id']) . "'";
        mysqli_query($link, $query);
    }
    else {
        // Create new ID, just for Demo purpose
        $id = base64_encode(mt_rand(0, 999999999999));

        echo "No Tracking ID given, create new ID: " . $id . "\n";

        // Save new Tracking ID to DB
        $query = "INSERT INTO `users` (`id`, `tracking_id`, `user_agent`, `last_seen`, `http_referer`) VALUES (NULL, '" . $id . "', '" . mysqli_real_escape_string($link, $_SERVER['HTTP_USER_AGENT']) . "', " . time() . ", '" . mysqli_real_escape_string($link, $_SERVER['HTTP_REFERER']) . "')";
        mysqli_query($link, $query);

        // Set HTTP Header
        header('Location: redirect.php?id=' . $id, TRUE, 301);
    }
    mysqli_close($link);