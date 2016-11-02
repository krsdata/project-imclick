<?php 

    namespace App\Providers;
    use Illuminate\Routing\Router;
    use Illuminate\Http\Request;

   use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

    class ConfigServiceProviders extends ServiceProvider {

        protected $namespace = 'App\Http\Controllers';

        public function register()
        {
            config([
                'laravellocalization.supportedLocales' => [
                   
                    'EN'  => ['name' => 'English','script' => 'Latn', 'native' => 'English', 'regional' => 'en_GB'],
                    'FR'  => ['name' => 'French', 'script' => 'Latn', 'native' => 'français', 'regional' => 'fr_FR']
                ],

                'laravellocalization.useAcceptLanguageHeader' => true,

                'laravellocalization.hideDefaultLocaleInURL' => true
            ]);
        }
        public function map( Router $router ) {

            $router->group( ['namespace' => $this->namespace ] , function($router) {
                require app_path( 'Http/routes.php' );
            } );
        }

    }
 




