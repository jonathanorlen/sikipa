<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    protected function rules()
     {
         return [
             'name' => ['required', 'string'],
             'email' => ['required', 'email'],
             'tanggal_lahir' => ['required', 'date'],
         ];
     }

    public function index(Request $request)
    {   
        $data['items'] = User::orderBy('id','desc')
            ->where('name','like','%'.$request->search.'%')
            ->paginate(20);
        $data['items']->appends($request->only('search'));

        return view('backend.pages.user',$data);
    }

    
    public function create()
    {   
        $data['form']="create";
        return view('backend.pages.user-form',$data);
    }

    
    public function store(Request $request)
    {
        $this->validate($request,$this->rules());
        try{  
            User::create([
                'name' => $request['name'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'email' => $request['email'],
                'password' => Hash::make(date('dmY', strtotime($request['tanggal_lahir'])))
            ]);

            return redirect()->route('user.index')->withSuccess('User '.$request['name'].' telah ditambahkan');
        }catch(Exception $e) {
            return redirect()->route('user.index')->withError($e);
        }
    }

    
    public function show(User $user)
    {
        //
    }

    
    public function edit(User $user)
    {   
        $data['item'] = $user;
        $data['form']="edit";
        return view('backend.pages.user-form',$data);
    }

    
    public function update(Request $request, User $user)
    {
        $this->validate($request,$this->rules());
        try{
            $user->update([
                'name' => $request['name'],
                'tanggal_lahir' => $request['tanggal_lahir'],
                'email' => $request['email'],
                'password' => Hash::make(date('ddmmyyyy', strtotime($request['tanggal_lahir'])))
            ]);
            return redirect()->route('user.index')->withSuccess('User terupdate');
        }catch(Exception $e) {
            return redirect()->route('user.index')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }

    
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return redirect()->back()->withSuccess('User '.$user->name.' Berhasil Dihapus');
        }catch(Exception $e) {
            return redirect()->back()->withError($e);
        }
    }
}
