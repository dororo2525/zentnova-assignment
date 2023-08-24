<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class ShortUrlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result =  ShortUrl::where('user_id', Auth::user()->id)->get();
        return view('backend.manage-url.list', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.manage-url.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $currentPackage = Auth::user()->userPackage->where('status' , 'pending')->first();
        $url_count = Auth::user()->shortUrl->count();
        if($currentPackage->package->url <= $url_count){
            return redirect()->back()->withErrors(['msg' => Carbon::now() . ' You have reached your url limit! Please upgrade your package.']);
        }
        $code = $this->ShortUrl();
        try{
            DB::beginTransaction();
            $result = ShortUrl::create([
                'origin_url' => $request->url,
                'code' => $code,
                'user_id' => $request->has('user_id') ? $request->user_id : Auth::user()->id,
                'created_at' => Carbon::now(),
            ]);
            DB::commit();
            return redirect()->route('manage-url.index')->with('success', Carbon::now() . ' URL created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['msg' => Carbon::now() . ' Something went wrong!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $result = ShortUrl::where('code', $id)->first();
        return view('backend.manage-url.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'url' => 'required|url'
        ]);
        try{
            DB::beginTransaction();
            $result = ShortUrl::where('code', $id)->first();
            $result->origin_url = $request->url;
            $result->status = $request->has('status') ? 1 : 0;
            $result->save();
            DB::commit();
            return redirect()->route('manage-url.index')->with('success', Carbon::now() . ' URL updated successfully!' );
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return redirect()->back()->withErrors(['msg' => Carbon::now() . ' Something went wrong!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            DB::beginTransaction();
            $result = ShortUrl::where('code', $id)->first();
            $result->delete();
            $click = UrlClick::where('url_id', $result->id);
            $click->delete();
            DB::commit();
            return response()->json(['status' => true, 'msg' => Carbon::now() . ' URL deleted successfully!']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            return response()->json(['status' => false, 'msg' => Carbon::now() . ' Something went wrong!']);
        }
    }

    public function switchStatus(Request $request){
        $result = ShortUrl::where('code',$request->code)->first();
        if($result){
            $result->status = $request->status;
            $result->save();
            return response()->json(['status' => true, 'msg' => Carbon::now() . ' Status updated successfully!']);
        }
        return response()->json(['status' => false, 'msg' => Carbon::now() . ' Something went wrong!']);
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
