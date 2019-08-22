<?php

namespace App\Http\Controllers;

use App\Services\DonationService;
use App\Services\SiteService;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * @var SiteService
     */
    private $siteService;
    /**
     * @var DonationService
     */
    private $donationService;

    public function __construct(SiteService $siteService, DonationService $donationService)
    {
        $this->siteService = $siteService;
        $this->donationService = $donationService;
    }

    public function signinPage()
    {
        return view('site.signin');
    }

    public function signin(Request $request)
    {
        try {
            $cookie = $this->siteService->getSigninCookie($request);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }

        return redirect()->route('bans')->withCookie($cookie);
    }

    public function signout()
    {
        $cookie = $this->siteService->dropUserCookie();
        return redirect()->route('bans')->withCookie($cookie);
    }

    public function index()
    {
        return view('site.index');
    }

    public function donations()
    {
        $donations = $this->donationService->getList();
        return view('payment.donations', compact('donations'));
    }
}
