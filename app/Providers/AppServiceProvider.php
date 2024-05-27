<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use App\Helpers\QuoteStage;
use App\Helpers\Helper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

        // setting();

        view()->composer('layouts.admin.partials.scripts', function ($view) {
            $view->with([
                'permissions' => auth()->check() ? auth()->user()->role?->permissions : []
            ]);
        });

        view()->composer('layouts.admin.partials.sidebar', function ($view) {
            $view->with([
                'unseenQuotes' => DB::table('quotes')->where('seen', false)->where('stage', QuoteStage::ORDER)->count()
            ]);
        });

        view()->composer('layouts.frontend.partials.right-bar', function ($view) {
            $view->with([
                'placed'    => DB::table('quotes')->where('user_id', auth()->id())->whereNot('stage', QuoteStage::QUOTE)->count(),
                'requested' => DB::table('quotes')->where('user_id', auth()->id())->where('stage', QuoteStage::QUOTE)->count(),
            ]);
        });

        // smtpConfig();
    }
}
