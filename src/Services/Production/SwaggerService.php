<?php
namespace Enda\YamlSwaggerLaravel\Services\Production;

use Enda\YamlSwaggerLaravel\Services\SwaggerServiceInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class SwaggerService implements SwaggerServiceInterface
{
    public function readYamlToArray($path)
    {
        $yaml                                        = new Yaml();
        $finder                                      = new Finder();
        $tmpFiles                                    = $finder->files()->in($path);
        $swaggerArray                                = [];
        $swaggerArray['externalDocs']['description'] = '';
        foreach ($tmpFiles as $file) {
            try {
                $yamlParse    = $yaml->parseFile($file);
                $swaggerArray = array_merge_recursive($swaggerArray, $yamlParse);
            } catch (ParseException $e) {
                $swaggerArray['externalDocs']['description'] = $swaggerArray['externalDocs']['description'].' '.$e->getMessage().' At file : '.$file;
                $swaggerArray['externalDocs']['url']         = '#';
            } catch (\Exception $e) {
            }
        }

        return $swaggerArray;
    }
}
