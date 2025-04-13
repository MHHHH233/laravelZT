<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\utilisateur;

class control extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function autho(Request $r)
    // {
    //     $user = utilisateur::where('email', $r->input('mail'))
    //                       ->where('password', $r->input('pwd'))
    //                       ->first();
    //     if($user) {
    //         return redirect()->route('action.index')->with('msg', 'Connected successfully');
    //     }
    //     return redirect()->route('action.index')->with('msg', 'Invalid credentials');
    // }
    public function autho(Request $r)
    {
        // $rs = utilisateur::all();
        // $rs = utilisateur::find(3);
        // $rs = utilisateur::select("id","email","password","type")
        // ->where('id','>',2)
        // ->orwhere('email',"baz@gmail.com")
        // ->get();
        $rs = utilisateur::where('email',$r->mail)
        ->where('password',$r->pwd)
        ->get();
        if($rs->count() > 0){
            if($rs[0]->type == 'user'){
                $r->Session()->regenerate();
                Session(['l'=>$rs[0]->email,'t'=>$rs[0]->type]);
                return view('profile');
            }
            else{
                $r->Session()->regenerate();
                Session(['l'=>$rs[0]->email,'t'=>$rs[0]->type]);
                $users = utilisateur::all();
                return view('menuadmin', compact('users'));
            }
        }
        else{
            return redirect()->Back()->with('msg',"mdp ou email incorrect");
        }
        
        dd($rs);
    }
    
    public function logout()
    {
        Session()->flush();
        return redirect('action');
    }

    public function index()
    {
        if(Session('t') == 'admin') {
            $users = utilisateur::all();
            return view('menuadmin', compact('users'));
        }
        return view('login', ['message' => null]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['mail'=>['required','email:dns'],'pwd'=>['required',Password::min(8)->mixedCase()->Symbols()]]);
        $u = new utilisateur();
        $u->email = $request->input('mail');
        $u->password = $request->input('pwd');
        $u->type = $request->input('type', 'user'); // Default to 'user' if not specified
        $u->save();
        
        if(Session('t') == 'admin') {
            $users = utilisateur::all();
            return view('menuadmin', compact('users'))->with('msg', "User created successfully");
        }
        return redirect('action')->with('msg',"COMPTE CREE AVEC SUCCESS");
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
        $user = utilisateur::find($id);
        return view('edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'mail' => 'required|email:dns',
            'pwd' => ['required', Password::min(8)->mixedCase()->symbols()],
            'type' => 'required|in:user,admin'
        ]);

        $user = utilisateur::find($id);
        $user->email = $request->mail;
        $user->password = $request->pwd;
        $user->type = $request->type;
        $user->save();

        $users = utilisateur::all();
        return view('menuadmin', compact('users'))->with('msg', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = utilisateur::find($id);
        $user->delete();
        
        $users = utilisateur::all();
        return view('menuadmin', compact('users'))->with('msg', 'User deleted successfully');
    }
}
