<?php

/**
 * Get the base path
 *
 * @param string $path
 * @return string
 */
function basePath($path = '') 
{
    return __DIR__ . '/' . $path;
}

function loadView($view)
{
    $viewPath = basePath("views/{$view}.view.php");

    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        echo "View {$view} is not found!";
    }
}

/**
 * Inspect a value(s)
 *
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

