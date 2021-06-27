<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendudukController extends Controller
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
        $data['items'] = Penduduk::orderBy('nama','asc')
            ->where('nama','like','%'.$request->search.'%')
            ->paginate(20);
        $data['items']->appends($request->only('search'));

        return view('backend.pages.penduduk',$data);
    }

    
    public function create()
    {   
        $data['form']="create";
        return view('backend.pages.penduduk-form',$data);
    }

    
    public function store(Request $request)
    {
        $this->validate($request,$this->rules());
        try{    
            User::create([
                'name' => $request['name'],
                'tanggal_lahir' => date('Y-m-d', strtotime($request['tanggal_lahir'])),
                'email' => $request['email'],
                'password' => Hash::make(date('ddmmyyyy', strtotime($request['tanggal_lahir'])))
            ]);

            return redirect()->route('penduduk.index')->withSuccess('Penduduk '.$request['name'].' telah ditambahkan');
        }catch(Exception $e) {
            return redirect()->route('penduduk.index')->withError($e);
        }
    }

    
    public function show(Penduduk $penduduk)
    {
        $data['item'] = $penduduk;
        $data['form']="show";
        return view('backend.pages.penduduk-form',$data);
    }

    
    public function edit(Penduduk $penduduk)
    {   
        $data['item'] = $penduduk;
        $data['form']="edit";
        return view('backend.pages.penduduk-form',$data);
    }

    
    public function update(Request $request, Penduduk $penduduk)
    {
        $this->validate($request,$this->rules());
        try{
            $penduduk->update([
                'name' => $request['name'],
                'tanggal_lahir' => $request['tanggal_lahir']->format("Y-m-d"),
                'email' => $request['email'],
                'password' => Hash::make(date('ddmmyyyy', strtotime($request['tanggal_lahir'])))
            ]);
            return redirect()->route('penduduk.index')->withSuccess('User terupdate');
        }catch(Exception $e) {
            return redirect()->route('penduduk.index')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }

    
    public function destroy(Penduduk $penduduk)
    {
        try{
            $penduduk->delete();
            return redirect()->back()->withSuccess('Penduduk '.$penduduk->name.' Berhasil Dihapus');
        }catch(Exception $e) {
            return redirect()->back()->withError($e);
        }
    }
}
