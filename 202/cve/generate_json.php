<?php

if (empty($argv[2])) {
    exit('The path is not set');
}

if (empty($argv[3])) {
    exit('Output path is not set');
}

$path = $argv[2];
$outputDir = $argv[3];

if (!is_dir($path)) {
    exit('Path is not found');
}

if (!is_dir($outputDir)) {
    exit('Output dir is not found');
}

$data = getAllJsons($path);

if (md5areDifferent($data, $outputDir . 'cve.json') == false) {
    exit('No changes in the file');
}

saveJson($data, $outputDir);

exit('New CVE json has been generated');

function md5areDifferent($data, $pathToDir)
{
    $jsonBeforeMd5 = md5_file($pathToDir);

    $jsonAfter = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $jsonAfterMd5 = md5($jsonAfter);

    return $jsonBeforeMd5 != $jsonAfterMd5;
}

function getAllJsons($path)
{
    $data = [];

    $it = new RecursiveDirectoryIterator($path);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (is_dir($file) || basename($file) == 'cve.json') {
            continue;
        }
        $content = json_decode(file_get_contents($file), true);
        if (!empty($content)) {
            $data[] = $content;
        }
    }

    return $data;
}

function saveJson($data, $outputDir)
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
    return file_put_contents($outputDir . 'cve.json', $json);
}
