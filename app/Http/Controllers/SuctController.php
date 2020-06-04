<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
// use Redirect, Response, File;
use App\Competition;
use App\User;
use App\Data;

class SuctController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function savedatasuct(Request $request)
    {

        request()->validate([
            'job' => ['required', 'string', 'min:3', 'max:32'],
            'address' => ['required', 'string', 'max:32', 'min:3'],
            'age' => ['required', 'integer', 'min:13', 'max:99']
        ]);

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_suct = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $data_suct = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_suct)) {
            if ($exist_suct->job != $request->job) {
                $datae_suct['job'] = $request->job;
            }
            if ($exist_suct->address != $request->address) {
                $datae_suct['address'] = $request->address;
            }
            if ($exist_suct->age != $request->age) {
                $datae_suct['age'] = $request->age;
            }

            Data::whereId_user($user_id)->update($datae_suct);
            return back()->with(['success' => 'Data dan berkas berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {
            $data_suct->id_user = $user_id;
            $data_suct->id_competition = $competition_id;
            $data_suct->university = 'Umum';
            $data_suct->job = $request->job;
            $data_suct->address = $request->address;
            $data_suct->age = $request->age;
            $data_suct->save();

            return back()->with(['success' => 'Data dan berkas berhasil ditambah.']);
        }
    }

    public function savetranssuct(Request $request)
    {

        request()->validate([
            'creation' => ['required', 'string', 'min:8']
        ]);

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_suct = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $trans_suct = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_suct)) {
            if ($exist_suct->creation != $request->creation) {
                $datae_suct['creation'] = $request->creation;
            }

            Data::whereId_user($user_id)->update($datae_suct);
            return back()->with(['success' => 'Data dan berkas berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {

            $trans_suct->id_user = $user_id;
            $trans_suct->id_competition = $competition_id;
            $trans_suct->creation = $request->creation;
            $trans_suct->save();

            return back()->with(['success' => 'Data dan berkas berhasil ditambah.']);
        }
    }

    public function submitakun(Request $request)
    {

        request()->validate([
            'agreement' => ['required']
        ]);

        $user = Auth::user();

        ## periksa apakah ada data di database
        if ($user->status == 0) {
            ## mulai prosedur editing data
            $user_update['status'] = 1;
            User::whereId($user->id)->update($user_update);
            return back()->with(['success' => 'Data akun telah berhasil disubmit, silakan menunggu pengumuman lebih lanjut.']);
        }
        ## jika tidak ada data di database
        else {
            return back()->with(['error' => 'Data akun gagal disubmit, silakan hubungi administrator.']);
        }
    }
}
