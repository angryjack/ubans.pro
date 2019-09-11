<?php

namespace App\Http\Controllers;

use App\Services\SettingsService;

class SettingsController extends Controller
{
    /**
     * @var SettingsService
     */
    private $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function index()
    {
        return view('settings.index');
    }
}
