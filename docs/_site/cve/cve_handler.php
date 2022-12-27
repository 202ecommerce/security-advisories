<?php

define('TYPES', ["core", "modules"]);
define('PATH_TO_CVE_DIRECTORY', dirname(__FILE__) . "/list");
define('PATH_TO_DATA', str_replace("cve", "_data/", dirname(__FILE__)));

function build_global_cve_json()
{
    $global_cve = [];
    foreach (TYPES as $type) {
        $path_to_all_cve = PATH_TO_CVE_DIRECTORY . '/' . $type;
        $files_to_decode = scandir($path_to_all_cve);

        foreach ($files_to_decode as $file) {
            if (!str_ends_with($file, ".json")) {
                continue;
            }
            $path_to_cve = $path_to_all_cve . '/' . $file;
            $global_cve[] = get_cve($path_to_cve);
        }
    }
    global_cve_json_builder($global_cve);
}

function get_cve($path)
{
    $content = file_get_contents($path);
    $json = json_decode($content, true);

    return $json;
}

function global_cve_json_builder($global_cve)
{
    $json = json_encode($global_cve, JSON_PRETTY_PRINT);
    file_put_contents(PATH_TO_DATA . "/cve.json", $json);
}

build_global_cve_json();