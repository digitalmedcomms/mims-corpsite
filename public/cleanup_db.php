<?php
define('FCPATH', __DIR__ . '/public/');
chdir(__DIR__);
$pathsConfig = 'app/Config/Paths.php';
require $pathsConfig;
$paths = new Config\Paths();
require $paths->systemDirectory . '/bootstrap.php';

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
