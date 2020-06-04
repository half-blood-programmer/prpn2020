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

class HstcController extends Controller
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

    public function savedatahstc(Request $request)
    {

        request()->validate([
            'team_name' => ['required', 'string', 'min:3', 'max:32'],
            'captain' => ['required', 'string', 'max:32', 'min:3'],
            'teacher' => ['required', 'string', 'max:32', 'min:9'],
            'teacher_contact' => ['required', 'string', 'max:15', 'min:9'],
            'university' => ['required', 'string', 'min:3', 'max:32'],
            'registration_form' => ['required', 'mimes:doc,docx,pdf', 'max:2048']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/hstc';
        $formatfile = 'FormRegistrasi';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_hstc = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $data_hstc = new Data;

        ## mulai prosedur editing data
        $registform = $request->file('registration_form');
        if ($registform) {
            # penamaan file baru
            $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $registform->getClientOriginalExtension();
            # file lama dihapus
            if (!empty($exist_hstc->registration_form)) {
                if (public_path($destinationPath . '/' . $exist_hstc->registration_form)) {
                    unlink(public_path($destinationPath . '/' . $exist_hstc->registration_form));
                }
            }
            # penggantian file lama dengan yang baru
            $registform->move(public_path($destinationPath), $profilefile);
            $data_hstc->registration_form = "$profilefile";
        }

        ## periksa apakah ada data di database
        if (!empty($exist_hstc)) {
            // if($exist_hstc) {
            if ($exist_hstc->team_name != $request->team_name) {
                $datae_hstc['team_name'] = $request->team_name;
            }
            if ($exist_hstc->captain != $request->captain) {
                $datae_hstc['captain'] = $request->captain;
            }
            if ($exist_hstc->teacher != $request->teacher) {
                $datae_hstc['teacher'] = $request->teacher;
            }
            if ($exist_hstc->teacher_contact != $request->teacher_contact) {
                $datae_hstc['teacher_contact'] = $request->teacher_contact;
            }
            if ($exist_hstc->university != $request->university) {
                $datae_hstc['university'] = $request->university;
            }
            $datae_hstc['registration_form'] = $data_hstc->registration_form;

            Data::whereId_user($user_id)->update($datae_hstc);

            return back()->with(['success' => 'Data dan berkas berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {
            $data_hstc->id_user = $user_id;
            $data_hstc->id_competition = $competition_id;
            $data_hstc->team_name = $request->team_name;
            $data_hstc->captain = $request->captain;
            $data_hstc->teacher = $request->teacher;
            $data_hstc->teacher_contact = $request->teacher_contact;
            $data_hstc->university = $request->university;
            $data_hstc->save();

            return back()->with(['success' => 'Data dan berkas berhasil disimpan.']);
        }
        // return Redirect::to(route('home'))->withSuccess('Data berhasil disimpan.');
    }

    public function savetranshstc(Request $request)
    {

        request()->validate([
            'transaction' => ['required', 'mimes:png,jpg,jpeg,pdf', 'max:2048']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/hstc';
        $formatfile = 'BuktiPembayaran';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_hstc = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $trans_hstc = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_hstc)) {
            ## mulai prosedur editing data
            $transaction = $request->file('transaction');
            if ($transaction) {
                # penamaan file baru
                $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $transaction->getClientOriginalExtension();
                # file lama dihapus
                if (!empty($exist_hstc->transaction)) {
                    if (public_path($destinationPath . '/' . $exist_hstc->transaction)) {
                        unlink(public_path($destinationPath . '/' . $exist_hstc->transaction));
                    }
                }
                # penggantian file lama dengan yang baru
                $transaction->move(public_path($destinationPath), $profilefile);
                $trans_hstc->transaction = "$profilefile";
            }
            ## response
            $datae_hstc['transaction'] = $trans_hstc->transaction;
            Data::whereId_user($user_id)->update($datae_hstc);
            return back()->with(['success' => 'Bukti Pembayaran berhasil diunggah.']);
        }
        ## jika tidak ada data di database
        else {
            return back()->with(['error' => 'Mohon untuk melengkapi Data di step pertama terlebih dulu.']);
        }
    }
}
