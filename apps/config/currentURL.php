<?php
function current_url()
{
    $url = $_SERVER['REQUEST_URI'];

    // Remove query parameters, if any
    $urlParts = explode('?', $url, 2);
    $url = $urlParts[0];

    // Remove leading slash and split the URL into segments
    $urlSegments = explode('/', trim($url, '/'));

    // If the URL is just the root, return an empty string
    if (empty($urlSegments)) {
        return '';
    }

    // Get the last segment of the URL (which might be the filename or a directory)
    $lastSegment = end($urlSegments);

    // If it contains a dot (.), it's likely a file with an extension
    if (strpos($lastSegment, '.') !== false) {
        return implode('/', $urlSegments);
    } else {
        // If the last segment doesn't have a dot, it's likely a directory
        return implode('/', $urlSegments) . '/';
    }
}
?>
