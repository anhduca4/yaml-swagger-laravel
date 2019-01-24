<?php
namespace Enda\YamlSwaggerLaravel\Http\Controllers;

use Enda\YamlSwaggerLaravel\Services\SwaggerServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

    /**
     * Login for swagger.
     *
     * @param Request $request
     *
     * @return \Response
     */
    public function showLoginForm()
    {
        return view('yaml-swagger-laravel::login', compact('urlApiDoc', 'title'));
    }

    /**
     * Handle login.
     *
     * @param Request $request
     *
     * @return \Response
     */
    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|max:255',
            'password' => 'required',
        ]);
        $users = collect(config('swagger.auth'));
        $user  = $users->where('username', $request->username)->first();
        if (empty($user) || !Hash::check($request->password, $user['password'] ?? '')) {
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }
        session(['swagger_auth' => true]);

        return redirect(route('swagger.index'));
    }

    /**
     * Handle logout.
     *
     * @return \Response
     */
    public function logout()
    {
        session(['swagger_auth' => false]);

        return redirect(route('swagger.index'));
    }
}
