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
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home');
    }

    public function trialUrl(Request $request){
        $request->validate([
            'url' => 'required|url',
        ]);
        $code = $this->ShortUrl();
        try{
            DB::beginTransaction();
            $result = ShortUrl::create([
                'origin_url' => $request->url,
                'code' => $code,
                'expired_at' => Carbon::now()->addHours(12),
                'created_at' => Carbon::now(),
            ]);
            DB::commit();
            return redirect()->back()->with('success', request()->root() . '/' . $code);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['msg' => Carbon::now() . ' Something went wrong!']);
        }
    }

    public function redirect($code){
        $url = ShortUrl::where('code', $code)->first();
        if($url && $url->expired_at != null){
            $expiredUrls = $url->where('expired_at', '<=', Carbon::now())->first();
            if($expiredUrls){
                $url->status = false;
                $url->save();
                return view('frontend.errors.error' ,['message' => Str::upper('This url is expired or not found')]);
            }
        }
        if($url && $url->status == true){
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
            return view('frontend.errors.error' ,['message' => Str::upper('This url is expired or not found')]);
        }
    }

    public function ShortUrl(){
        $result = base_convert(rand(1000,99999), 10, 36);
        $check = ShortUrl::where('code', $result)->first();

        if($check != null){
            $this->ShortUrl();
        }

        return $result;
    }
}
