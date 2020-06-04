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

class TacapController extends Controller
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

    public function savedatatacap(Request $request)
    {

        ## mendapatkan id_user dan id_competition
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_tacap = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        ## instansiasi model Data
        $data_tacap = new Data;

        ## periksa apakah ada data di database
        if (!empty($exist_tacap)) {
            // if($exist_kdpn) {
            request()->validate([
                'university' => ['required', 'string', 'max:64', 'min:3']
            ]);

            if ($exist_tacap->university != $request->university) {
                $datae_tacap['university'] = $request->university;
            }

            Data::whereId_user($user_id)->update($datae_tacap);
            return back()->with(['success' => 'Data Peserta berhasil diubah.']);
        }
        ## jika tidak ada data di database
        else {
            request()->validate([
                'branch' => ['required', 'string', 'min:3', 'max:32'],
                'university' => ['required', 'string', 'max:64', 'min:3']
            ]);

            $data_tacap->id_user = $user_id;
            $data_tacap->id_competition = $competition_id;
            $data_tacap->branch = $request->branch;
            $data_tacap->university = $request->university;
            $data_tacap->save();

            return back()->with(['success' => 'Kategori Lomba dan Data Peserta berhasil disimpan.']);
        }
    }

    public function savecreationtacap(Request $request)
    {
        $user_id = Auth::user()->id;
        $competition_id = Competition::whereId(Auth::user()->id_competition)->first()->id;
        $exist_tacap = Data::whereId_user($user_id)
            ->whereId_competition($competition_id)
            ->first();

        if (!empty($exist_tacap->branch)){
            if ($exist_tacap->branch == 'advertisement' || $exist_tacap->branch == 'comic' || $exist_tacap->branch == 'photography') {
                $request->validate([
                'creation' => ['required', 'string', 'min:5']
                ]);

                $datae_tacap['creation'] = $request->creation;
                Data::whereId_user($user_id)->update($datae_tacap);
                return back()->with(['success' => 'Link Google Drive karya telah berhasil disimpan.']);
            } else {
                // if ($exist_tacap->branch == 'comic') {
                //     $request->validate([
                //     'creation' => ['required',  'mimes:png,jpg,jpeg,pdf', 'max:5120']
                //     ]);

                //     ## preset awal
                //     $destinationPath = 'userdocs2020/tacap/comic';
                //     $formatfile = 'TaxComic';

                    // elseif()
                } if ($exist_tacap->branch == 'article') {
                    $request->validate([
                    'creation' => ['required',  'mimes:pdf,doc,docx', 'max:2048']
                    ]);

                    ## preset awal
                    $destinationPath = 'userdocs2020/tacap/article';
                    $formatfile = 'TaxArticle';

                } 
                // elseif ($exist_tacap->branch == 'photography') {
                //     $request->validate([
                //     'creation' => ['required',  'mimes:png,jpg,jpeg,pdf', 'max:5120']
                //     ]);

                //     ## preset awal
                //     $destinationPath = 'userdocs2020/tacap/photography';
                //     $formatfile = 'TaxPhotography';

                // } 

                ## mulai prosedur editing data
                $creation = $request->file('creation');
                if ($creation) {
                    # penamaan file baru
                    $profilefile = Auth::user()->email . '_' . $formatfile . '_' . date('Ymd_his') . '.' . $creation->getClientOriginalExtension();
                    # file lama dihapus
                    if (!empty($exist_tacap->creation)) {
                        if (public_path($destinationPath . '/' . $exist_tacap->creation)) {
                            unlink(public_path($destinationPath . '/' . $exist_tacap->creation));
                        }
                    }
                    # penggantian file lama dengan yang baru
                    $creation->move(public_path($destinationPath), $profilefile);
                }

                ## response
                $datae_tacap['creation'] = "$profilefile";
                Data::whereId_user($user_id)->update($datae_tacap);
                return back()->with(['success' => 'Berkas karya berhasil diunggah.']);
                }
        } else {
            return back()->with(['error' => 'Selesaikan dulu tahap pertama.']);
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
