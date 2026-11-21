<?php

echo "BEFORE LARAVEL";

try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<pre>";
    echo get_class($e) . "\n";
    echo $e->getMessage() . "\n";
    echo $e->getFile() . ":" . $e->getLine();
    echo "</pre>";
}
