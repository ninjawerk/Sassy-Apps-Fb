<?php
namespace App\Http\ViewComposers;
use App\FbApp;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AppsComposer
{
    public $applist = [];

    public function __construct()
    {
        $this->applist = DB::table('fb_apps')->latest()->take(4)->get();
    }

    public function compose(View $view)
    {
        $view->with('latestApps', $this->applist );
    }
}