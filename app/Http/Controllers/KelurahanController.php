<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelurahan;
use App\Models\RW;
use App\Models\RT;
use DB;

class KelurahanController extends Controller
{
    protected function rules()
    {
        return [
            'kelurahan' => ['required', 'string'],
            'kode_pos' => ['required', 'integer'],
        ];
    }

    public function index(Request $request)
    {
        $data['items'] = Kelurahan::orderBy('kelurahan', 'asc')
            ->where('kelurahan', 'like', '%' . $request->search . '%')
            ->paginate(20);
        $data['rt'] = DB::table('rt')->selectRaw('count(*)');
        $data['rw'] = DB::table('rw')->selectRaw('count(*)');
        $data['items']->appends($request->only('search'));

        return view('backend.pages.kelurahan', $data);
    }


    public function create()
    {
        $data['form'] = "create";
        return view('backend.pages.kelurahan-form', $data);
    }


    public function store(Request $request)
    {
        $this->validate($request, $this->rules());
        try {
            Kelurahan::create([
                'kelurahan' => $request['kelurahan'],
                'kode_pos' => $request['kode_pos'],
            ]);

            return redirect()->route('admin.kelurahan.index')->withSuccess('Kelurahan ' . $request['name'] . ' telah ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('admin.kelurahan.index')->withError($e);
        }
    }


    public function show(Kelurahan $kelurahan)
    {
        $data['item'] = $kelurahan;
        $data['form'] = "show";
        return view('backend.pages.kelurahan-form', $data);
    }


    public function edit(Kelurahan $kelurahan)
    {
        $data['item'] = $kelurahan;
        $data['form'] = "edit";
        return view('backend.pages.kelurahan-form', $data);
    }


    public function update(Request $request, Kelurahan $kelurahan)
    {
        $this->validate($request, $this->rules());
        try {
            $kelurahan->update([
                'kelurahan' => $request['kelurahan'],
                'kode_pos' => $request['kode_pos'],
            ]);
            return redirect()->route('admin.kelurahan.index')->withSuccess('Kelurahan terupdate');
        } catch (Exception $e) {
            return redirect()->route('admin.kelurahan.index')->withError($e);
            // return Redirect::to('sharks/create')
            //     ->withErrors($validator)
            //     ->withInput(Input::except('password'))
        }
    }


    public function destroy(Kelurahan $kelurahan)
    {
        try {
            $kelurahan->delete();
            return redirect()->back()->withSuccess('Kelurahan ' . $kelurahan->kelurahan . ' Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }

    public function rw(Request $req)
    {
        $rw = RW::where('kelurahan_id', $req->id)->get();
        return $rw;
    }

    public function rw_index(Request $request)
    {
        $kelurahan = Kelurahan::where('kelurahan', ucwords($request->kelurahan))->first();
        $data['items'] = RW::where('kelurahan_id', $kelurahan->id)
            ->orderBy('nomor_rw', 'asc')->get();
        $data['kelurahan'] = $kelurahan;

        return view('backend.pages.rw', $data);
    }

    public function rw_store(Request $request)
    {
        $this->validate($request, [
            'nomor_rw' => 'required'
        ]);

        try {
            RW::create([
                'kelurahan_id' => $request['kelurahan_id'],
                'nomor_rw' => $request['nomor_rw'],
            ]);

            return redirect()->route('admin.rw', strtolower($request['kelurahan']))->withSuccess('RW ' . $request['nomor_rw'] . ' telah ditambahkan');
        } catch (Exception $e) {
            return redirect()->route('admin.rw', strtolower($request['kelurahan']))->withError($e);
        }
    }

    public function rw_destory(RW $rw)
    {
        try {
            $rw->delete();
            return redirect()->back()->withSuccess('RW ' . $rw->nomor_rw . ' Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }

    public function rt(Request $req)
    {
        $rw = RT::where('rw_id', $req->id)->get();
        return $rw;
    }

    public function rt_index($kelurahan, $rw)
    {
        $data['kelurahan'] = $kelurahan;
        $kelurahan = Kelurahan::where('kelurahan', $kelurahan)->first();
        $data['rw'] = RW::where('nomor_rw', $rw)->where('kelurahan_id', $kelurahan->id)->first();
        $data['items'] = rt::where('rw_id', $data['rw']->id)
            ->orderBy('nomor_rt', 'asc')
            ->get();

        return view('backend.pages.rt', $data);
    }

    public function rt_store(Request $request)
    {
        $this->validate($request, [
            'nomor_rt' => 'required'
        ]);

        try {
            rt::create([
                'rw_id' => $request['rw_id'],
                'nomor_rt' => $request['nomor_rt'],
            ]);

            return redirect()->back()->withSuccess('RT ' . $request['nomor_rt'] . ' telah ditambahkan');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }

    public function rt_destory(RT $rt)
    {
        try {
            $rt->delete();
            return redirect()->back()->withSuccess('RT ' . $rt->nomor_rt . ' Berhasil Dihapus');
        } catch (Exception $e) {
            return redirect()->back()->withError($e);
        }
    }
}
