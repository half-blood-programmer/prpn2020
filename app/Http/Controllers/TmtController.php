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

class TmtController extends Controller
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

    public function savedatatmt(Request $request)
    {

        request()->validate([
            'grade' => ['required', 'string', 'min:2', 'max:4'],
            'university' => ['required', 'string', 'min:3', 'max:32'],
            'registration_form' => ['required', 'mimes:doc,docx,pdf', 'max:2048']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/tmt';
        $formatfile = 'FormRegistrasi';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_tmt = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $data_tmt = new Data;

        ## mulai prosedur editing data
        $registform = $request->file('registration_form');
        if ($registform) {
            # penamaan file baru
            $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $registform->getClientOriginalExtension();
            # file lama dihapus
            if (!empty($exist_tmt->registration_form)) {
                if (public_path($destinationPath . '/' . $exist_tmt->registration_form)) {
                    unlink(public_path($destinationPath . '/' . $exist_tmt->registration_form));
                }
            }
            # penggantian file lama dengan yang baru
            $registform->move(public_path($destinationPath), $profilefile);
            $data_tmt->registration_form = "$profilefile";
        }

        ## periksa apakah ada data di database
        if (!empty($exist_tmt)) {
            if ($exist_tmt->grade != $request->grade) {
                $datae_tmt['grade'] = $request->grade;
            }
            if ($exist_tmt->university != $request->university) {
                $datae_tmt['university'] = $request->university;
            }
            $datae_tmt['registration_form'] = $data_tmt->registration_form;
            Data::whereId_user($user_id)->update($datae_tmt);

            return back()->with(['success' => 'Data dan berkas berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {
            $data_tmt->id_user = $user_id;
            $data_tmt->id_competition = $competition_id;
            $data_tmt->grade = $request->grade;
            $data_tmt->university = $request->university;
            $data_tmt->save();

            return back()->with(['success' => 'Data dan berkas berhasil diunggah.']);
        }
    }

    public function savecreationtmt(Request $request)
    {

        request()->validate([
            'creation' => ['required', 'mimes:pdf,doc,docx', 'max:3072']
        ]);

        ## preset awal
        $destinationPath = 'userdocs2020/tmt';
        $formatfile = 'ThreeMinThesis';

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_tmt = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $creation_tmt = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_tmt)) {
            ## mulai prosedur editing data
            $creation = $request->file('creation');
            if ($creation) {
                # penamaan file baru
                $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $creation->getClientOriginalExtension();
                # file lama dihapus
                if (!empty($exist_tmt->creation)) {
                    if (public_path($destinationPath . '/' . $exist_tmt->creation)) {
                        unlink(public_path($destinationPath . '/' . $exist_tmt->creation));
                    }
                }
                # penggantian file lama dengan yang baru
                $creation->move(public_path($destinationPath), $profilefile);
                $creation_tmt->creation = "$profilefile";
            }
            ## response
            $datae_tmt['creation'] = $creation_tmt->creation;
            Data::whereId_user($user_id)->update($datae_tmt);
            return back()->with(['success' => 'Karya Thesis berhasil diunggah.']);
        }
        ## jika tidak ada data di database
        else {
            return back()->with(['error' => 'Mohon untuk melengkapi seluruh Data di step pertama terlebih dulu.']);
        }
    }
}
