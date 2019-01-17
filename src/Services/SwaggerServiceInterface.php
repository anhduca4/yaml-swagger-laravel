<?php
namespace Enda\YamlSwaggerLaravel\Services;

interface SwaggerServiceInterface
{
    /**
     * Read file yaml to array from folder documents.
     *
     * @return array
     */
    public function readYamlToArray($path);
}
