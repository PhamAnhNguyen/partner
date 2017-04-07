<?php

namespace Foostart\Partner;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;

use URL, Route;
use Illuminate\Http\Request;


class PartnerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Request $request) {
        /**
         * Publish
         */
         $this->publishes([
            __DIR__.'/config/partner_admin.php' => config_path('partner_admin.php'),
        ],'config');
         
         $this->publishes([
        __DIR__.'/public' => public_path('foostart'),
    ], 'public');

        $this->loadViewsFrom(__DIR__ . '/views', 'partner');


        /**
         * Translations
         */
         $this->loadTranslationsFrom(__DIR__.'/lang', 'partner');


        /**
         * Load view composer
         */
        $this->partnerViewComposer($request);

         $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations')
            ], 'migrations');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        include __DIR__ . '/routes.php';

        /**
         * Load controllers
         */
        $this->app->make('Foostart\Partner\Controllers\Admin\PartnerAdminController');
        $this->app->make('Foostart\Partner\Controllers\Front\PartnerFrontController');

         /**
         * Load Views
         */
        $this->loadViewsFrom(__DIR__ . '/views', 'partner');
    }

    /**
     *
     */
    public function partnerViewComposer(Request $request) {

        view()->composer('partner::partner*', function ($view) {
            global $request;
            $partner_id = $request->get('id');
            $is_action = empty($partner_id)?'page_add':'page_edit';

            $view->with('sidebar_items', [

                /**
                 * Partners
                 */
                //list
                trans('partner::partner_admin.page_list') => [
                    'url' => URL::route('admin_partner'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],
                //add
                trans('partner::partner_admin.'.$is_action) => [
                    'url' => URL::route('admin_partner.edit'),
                    "icon" => '<i class="fa fa-users"></i>'
                ],

                /**
                 * Categories
                 */
                //list
               
            ]);
            //
        });
    }

}
