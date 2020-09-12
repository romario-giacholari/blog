<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use App\ViewModels\Privacy\IndexViewModel;
use App\ViewModels\Privacy\ContentViewModel;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $viewModel = new IndexViewModel;
        $viewModel->pageTitle = "Privacy policy";

        return view('privacy-policy.index', ['viewModel' => $viewModel]);
    }

    public function content()
    {
        $appName = config('app.name') ?? 'giacholari.com';
        $privacyFile = Cache::rememberForever('privacyFile', function () {
            return file_get_contents('https://assets.giacholari.com/json/privacy.json');
        });

        $viewModel = new ContentViewModel;
        $viewModel->introduction = "This privacy policy applies to the website {$appName}";
        $viewModel->content = json_decode($privacyFile, true);
        $viewModel->contactEmail = "giacholari@gmail.com";

        return view('privacy-policy.content', ['viewModel' => $viewModel]);
    }
}
