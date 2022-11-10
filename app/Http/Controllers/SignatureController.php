<?php

namespace App\Http\Controllers;

use App\Models\Signature;
use App\Http\Requests\StoreSignatureRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SignatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $signature = Signature::where("user_id", Auth::user()->id)->first();

        if ($signature==null){
            return Inertia::render('Signature/Create');
        }else{
            return Inertia::render('Signature/Index', [
                'signature' => $signature
            ]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Signature/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSignatureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSignatureRequest $request)
    {
        $signExist = Auth::user()->signature;

        if($signExist){
             if (Request::file('sign_image')) {
                  //  Storage::delete();
                    $sign_path = Request::file('sign_image')->store('signature','public');
                    Signature::where('id', $signExist->id)
                        ->update([
                            'user_id' => Auth::user()->id,
                            'sign_image' => $sign_path
                        ]);
                    }
             else{
                    return redirect()->route('signature.index')->with('error', 'Please choose an image signature');
             }


        }else{
            $sign_path = $request->file('sign_image') ? $request->file('sign_image')->store('signature', 'public') : null;
            Signature::create([
                'sign_image' => $sign_path,
                'user_id' => (int) Auth::user()->id,
            ]);

        }



        return redirect()->route('signature.index')->with('success', 'Signature  created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function show(Signature $signature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function edit(Signature $signature)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSignatureRequest $request, Signature $signature)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Signature  $signature
     * @return \Illuminate\Http\Response
     */
    public function destroy(Signature $signature)
    {
        //
    }
}
