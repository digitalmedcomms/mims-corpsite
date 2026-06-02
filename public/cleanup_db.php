<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
if (!defined('ENVIRONMENT')) {
    define('ENVIRONMENT', 'development');
}
chdir(__DIR__);
$pathsConfig = FCPATH . '../app/Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;
$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
require realpath($bootstrap) ?: $bootstrap;

$model = new \App\Models\PageVisitModel();
$visits = $model->findAll();
$updatedCount = 0;

foreach ($visits as $visit) {
    $cleanUrl = str_replace('/index.php/', '/', $visit['url']);
    if (str_ends_with($cleanUrl, '/index.php')) {
        $cleanUrl = substr($cleanUrl, 0, -10);
    }
    
    if ($cleanUrl !== $visit['url']) {
        $model->update($visit['id'], ['url' => $cleanUrl]);
        $updatedCount++;
    }
}

echo "Successfully updated $updatedCount page visit records!\n";
