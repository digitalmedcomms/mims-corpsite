<?php 

// Don't allow to run this on a browser or any, just in CLI only.
if (PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) {
    // For security we use a tricky message, don't give any information that this is a special route.
    exit('Sorry, can\'t process your request please try again.'); 
}

/**
 * Assets Compiler Script.
 * 
 * Transfer minified version of css and js file in a particular location.
 * Helps to improve page speed insights scores by manuall embedding some critical assets in PHP.
 * 
 * To use this script simply run the command in the project root directory:
 *  php assets_compiler.php
 * 
 * @author GMA New Media Inc.<joshua.reyes@gmanmi.com>
 */
echo "\n[[ ASSETS COMPILER ]]\n";

set_time_limit(900); // 15mins
ini_set('memory_limit', '16M'); // 16MB

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR . '..');
define('RESOURCES_DIST_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'dist' . DIRECTORY_SEPARATOR);
define('COMPILED_ASSETS_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . '__compiled_assets__' . DIRECTORY_SEPARATOR);

if (!is_dir(RESOURCES_DIST_DIR)) {
    exit('The resources dist directory is not available.');
}

if (!is_dir(COMPILED_ASSETS_DIR)) {
    mkdir(COMPILED_ASSETS_DIR, 0775);
}

// Prepare all files in array format.
$cssPages = glob(RESOURCES_DIST_DIR . 'css' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . '*.*');
$cssComponents = glob(RESOURCES_DIST_DIR . 'css' . DIRECTORY_SEPARATOR .'components' . DIRECTORY_SEPARATOR . '*.*');

/**
 * Trasnfer Content Function.
 * 
 * @param array  $files  All the files need to compile.
 * @param string $type   The type of files.
 * 
 * @return void
 */
function transferContent($files, $type = 'styles') 
{
    foreach ($files as $file) {

        $expectedDirectory = COMPILED_ASSETS_DIR . getFileDirectory($file) . DIRECTORY_SEPARATOR;

        // Create sub-directory if not available
        // in the main compiled assets directory.
        if (!is_dir($expectedDirectory)) {
            mkdir($expectedDirectory, 0775, true);
        }

        $compiledPath = '';
        $content = '';

        switch ($type) {
            case 'styles':
                $compiledPath = $expectedDirectory . getFileName($file, '.min.css') . '.php';
                $content = '<style>' . getFileContent($file) . '</style>'; 
                break;
            case 'scripts':
                $compiledPath = $expectedDirectory . getFileName($file, '.min.js') . '.php';
                $content = '<script>' . getFileContent($file) . '</script>';
                break;
        }

        addCompiledAsset($compiledPath, $content);
    }
}

/**
 * Get File Directory Function.
 * 
 * @param string $filePath  The full file path and will use get the file directory.
 * 
 * @return string
 */
function getFileDirectory($filePath) 
{
    $filePath = str_replace(RESOURCES_DIST_DIR, '', $filePath);
    $explodedPath = explode(DIRECTORY_SEPARATOR, $filePath);
    
    unset($explodedPath[count($explodedPath) - 1]);

    return implode(DIRECTORY_SEPARATOR, $explodedPath);
}

/**
 * Get File Name Function.
 * 
 * @param string $filePath   The full file path and will use get the file name.
 * @param string $extension  The extension need to remove for the file name.
 * 
 * @return string
 */
function getFileName($filePath, $extension) 
{
    $explodedPath = explode(DIRECTORY_SEPARATOR, $filePath);
    $fileName = $explodedPath[count($explodedPath) - 1];

    return str_replace($extension, '', $fileName);
}

/**
 * Get File Content Function.
 * 
 * @param string $path  The full path to get the content.
 *
 * @return string
 */
function getFileContent($path)
{
    if(filesize($path) > 0){
        $f = fopen($path, 'r') or die('Cannot open file:' . $path);
        $data = trim(fread($f, filesize($path)));
        fclose($f);
        
        return $data;
    }
}

/**
 * Add Compiled Assets Function.
 * 
 * @param string $path  The full path to place the content.
 * @param string $data  The actual content for the selected path.
 *
 * @return string
 */
function addCompiledAsset($path, $data)
{
    // This will create the file if not exist and 
    // replace the entire content if already exist.
    file_put_contents($path, $data);
}

echo "\n> Compiling all css pages.\n";
transferContent($cssPages, 'styles');

echo "\n> Compiling all css components.\n";
transferContent($cssComponents, 'styles');

echo "\n> Finished.\n\n";
