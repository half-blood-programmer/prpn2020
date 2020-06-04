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

class KdpnController extends Controller
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

    public function savedatakdpn(Request $request)
    {

        request()->validate([
            'team_name' => ['required', 'string', 'min:3', 'max:32'],
            'captain' => ['required', 'string', 'max:32', 'min:3'],
            'university' => ['required', 'string', 'min:3', 'max:32'],
            'registration_form' => ['required', 'mimes:doc,docx,pdf', 'max:2048']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/kdpn';
        $formatfile = 'FormRegistrasi';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_kdpn = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $data_kdpn = new Data;

        ## mulai prosedur editing data
        $registform = $request->file('registration_form');
        if ($registform) {
            # penamaan file baru
            $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $registform->getClientOriginalExtension();
            # file lama dihapus
            if (!empty($exist_kdpn->registration_form)) {
                if (public_path($destinationPath . '/' . $exist_kdpn->registration_form)) {
                    unlink(public_path($destinationPath . '/' . $exist_kdpn->registration_form));
                }
            }
            # penggantian file lama dengan yang baru
            $registform->move(public_path($destinationPath), $profilefile);
            $data_kdpn->registration_form = "$profilefile";
        }

        ## periksa apakah ada data di database
        if (!empty($exist_kdpn)) {
            // if($exist_kdpn) {
            if ($exist_kdpn->team_name != $request->team_name) {
                $datae_kdpn['team_name'] = $request->team_name;
            }
            if ($exist_kdpn->captain != $request->captain) {
                $datae_kdpn['captain'] = $request->captain;
            }
            if ($exist_kdpn->university != $request->university) {
                $datae_kdpn['university'] = $request->university;
            }
            $datae_kdpn['registration_form'] = $data_kdpn->registration_form;

            // $data_kdpn->where('id_user', $user_id);
            // $data_kdpn->where('id_competition', $competition_id);
            Data::whereId_user($user_id)->update($datae_kdpn);

            return back()->with(['success' => 'Data dan berkas berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {
            $data_kdpn->id_user = $user_id;
            $data_kdpn->id_competition = $competition_id;
            $data_kdpn->team_name = $request->team_name;
            $data_kdpn->captain = $request->captain;
            $data_kdpn->university = $request->university;
            $data_kdpn->save();

            return back()->with(['success' => 'Data dan berkas berhasil ditambah.']);
        }
        // return Redirect::to(route('home'))->withSuccess('Data berhasil disimpan.');
    }

    public function savetranskdpn(Request $request)
    {

        request()->validate([
            'transaction' => ['required', 'mimes:png,jpg,jpeg,pdf', 'max:2048']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/kdpn';
        $formatfile = 'BuktiPembayaran';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_kdpn = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $trans_kdpn = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_kdpn)) {
            ## mulai prosedur editing data
            $transaction = $request->file('transaction');
            if ($transaction) {
                # penamaan file baru
                $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $transaction->getClientOriginalExtension();
                # file lama dihapus
                if (!empty($exist_kdpn->transaction)) {
                    if (public_path($destinationPath . '/' . $exist_kdpn->transaction)) {
                        unlink(public_path($destinationPath . '/' . $exist_kdpn->transaction));
                    }
                }
                # penggantian file lama dengan yang baru
                $transaction->move(public_path($destinationPath), $profilefile);
                $trans_kdpn->transaction = "$profilefile";
            }
            ## response
            $datae_kdpn['transaction'] = $trans_kdpn->transaction;
            Data::whereId_user($user_id)->update($datae_kdpn);
            return back()->with(['success' => 'Bukti Pembayaran berhasil diunggah.']);
        }
        ## jika tidak ada data di database
        else {
            return back()->with(['error' => 'Mohon untuk melengkapi Data di step pertama terlebih dulu.']);
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
