<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use App\Models\UrlClick;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home');
    }

    public function redirect($code){
        $url = ShortUrl::where('code', $code)->first();
        if($url){
            $url->clicks = $url->clicks + 1;
            $url->save();
            $agent = new Agent();
            $browser = $agent->browser();
            $platform = $agent->platform();
            $device = $agent->device();
            $ip = request()->ip();
            $click = UrlClick::create([
                'url_id' => $url->id,
                'ip' => $ip,
                'browser' => $browser,
                'platform' => $platform,
                'device' => $device,
                'created_at' => Carbon::now(),
            ]);
            return redirect($url->origin_url);
        }else{
            abort(404);
        }
    }
}
