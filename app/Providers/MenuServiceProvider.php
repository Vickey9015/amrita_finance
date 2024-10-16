<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
    $verticalMenuJson_Org = file_get_contents(base_path('resources/menu/verticalMenu_orgs.json'));
    // dd(session()->all());
    $verticalMenuData = json_decode($verticalMenuJson);
    $verticalMenuData_Org = json_decode($verticalMenuJson_Org);

    // Share all menuData to all the views
    \View::share('menuData_user', [$verticalMenuData]);
    \View::share('menuData_org', [$verticalMenuData_Org]);
  }
}
