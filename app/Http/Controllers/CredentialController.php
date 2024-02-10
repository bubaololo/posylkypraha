<?php

namespace App\Http\Controllers;

use App\Models\RecipientCredential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CredentialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $credentials = $user->credential()->first();
        return view('credentials-edit', compact('credentials'));
        
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['user_id' => 'nullable|exists:users,user_id|unique:credentials,user_id',
            'name' => 'bail|alpha|required|max:50|string',
            'surname' => 'alpha_dash|required|max:50|string',
            'middle_name' => 'alpha|required|max:50|string',
//            'address' => 'required',
            'tel' => 'regex:/^[\d\-\+]+$/',
            'index' => 'integer'
        ]);
        
        
        $user = Auth::user();
        $requestData = $request->all();
        
        
        $credentialsCheck = $user->credential()->first();
        if ($credentialsCheck) {
            $credentials = $credentialsCheck;
            return view('profile', compact('credentials'));
        } else {
            
            $credentials = RecipientCredential::create([
                
                'name' => $requestData['name']?? null,
                'user_id' => $user->id,
                'surname' => $requestData['surname'] ?? null,
                'middle_name' => $requestData['middle_name'] ?? null,
                'address' => $requestData['address'] ?? null,
                'apartment' => $requestData['apartment'] ?? null,
                'comment' => $requestData['comment'] ?? null,
                'tel' => $requestData['tel'] ?? null,
                'whatsapp' => $requestData['whatsapp'] ?? null,
                'telegram' => $requestData['telegram'] ?? null,
                'email' => $requestData['email'] ?? null,
                'last_ip' => $request->ip(),
            
            ]);
            $credentials = $user->credential()->first();
            return view('profile', compact('credentials'));
        }
        
        
    }
    
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $validated = $request->validate([
            'name' => 'bail|alpha|required|max:50|string',
            'surname' => 'alpha_dash|required|max:50|string',
            'middle_name' => 'alpha|required|max:50|string',
//            'address' => 'required',
            'tel' => 'regex:/^[\d\-\+]+$/',
            'index' => 'integer'
        ]);
        
        
        $user = Auth::user();
        $requestData = $request->all();
        $credentials = $user->credential()->first();
        $credentials->query()->update([
            
            'name' => $requestData['name'] ?? null,
            'surname' => $requestData['surname'] ?? null,
            'middle_name' => $requestData['middle_name'] ?? null,
            'address' => $requestData['address'] ?? null,
            'apartment' => $requestData['apartment'] ?? null,
            'comment' => $requestData['comment'] ?? null,
            'tel' => $requestData['tel'] ?? null,
            'whatsapp' => $requestData['whatsapp'] ?? null,
            'telegram' => $requestData['telegram'] ?? null,
            'index' => $requestData['index'] ?? null,
            'last_ip' => $request->ip(),
        ]);
        $credentials = $user->credential()->first();
        return view('profile', compact('credentials'));
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
