<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Brand;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     $brands = Brand::take(4)->get();
        //     $categories = Category::All();
        //     $view->with('brands', $brands)->with('categories', $categories);
        // });
    }

    public function register()
    {
        //
    }
}
