<?php
namespace Enda\YamlSwaggerLaravel\Http\Controllers;

use Enda\YamlSwaggerLaravel\Services\SwaggerServiceInterface;
use Illuminate\Routing\Controller as BaseController;

class SwaggerController extends BaseController
{
    /** @var \Enda\YamlSwaggerLaravel\Services\SwaggerServiceInterface $swaggerService */
    protected $swaggerService;

    public function __construct(
        SwaggerServiceInterface $swaggerService
    ) {
        $this->swaggerService   = $swaggerService;
    }

    /**
     * Index of swagger.
     *
     * @param string $version
     *
     * @return \Response
     */
    public function index($version = null)
    {
        $version       = $version ?? 'v1';
        $versions      = config('swagger.version');
        $configVersion = $versions[$version] ?? $versions['v1'];
        $urlApiDoc     = route('swagger.docs', [
            'version' => $version,
        ]);
        $title = $configVersion['name'] ?? 'Yaml swagger v1';

        return view('yaml-swagger-laravel::index', compact('urlApiDoc', 'title'));
    }

    /**
     * Dump swagger.json content endpoint.
     *
     * @param string $version
     *
     * @return \Response
     */
    public function docs($version = null)
    {
        $version       = $version ?? 'v1';
        $versions      = config('swagger.version');
        $configVersion = $versions[$version] ?? $versions['v1'];
        $path          = $configVersion['path'] ?? base_path('documents/swagger_v1');

        return $this->swaggerService->readYamlToArray($path);
    }
}
