<div id="fullpage" class="fullpage-default">

    <div class="section animated-row" data-section="slide01">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-8 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp" style="text-align:left">
                    <h5>Halo, {{ Auth::user()->name }}!</h5>
                        <a>Ikuti langkah berikut untuk mengikuti</a>
                        <h4>{{ $competition->title }}</h4>
                    </div>
                    <div class="services-section">
                                @include('layouts.part.notification')
                        <div class="services-list owl-carousel">
                            <a href="#slide02">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
                                    <span class="service-icon">
                                        @if(!empty($data_user->team_name) && !empty($data_user->captain) && !empty($data_user->university) && !empty($data_user->registration_form))
                                        <i class="fa fa-2x fa-check-circle"></i>
                                        @else
                                        <img src="assets/images/number1.png" class="mx-auto" style="width:60px;height:60px;">
                                        @endif
                                    </span>
                                    <h3>Kelengkapan Data</h3>
                                    <p>Lengkapi informasi pribadi kamu untuk melanjutkan proses pendaftaran</p>
                                </div>
                            </div>
                            </a>
                            <a href="#slide03">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
                                    <span class="service-icon">
                                        @if(!empty($data_user->transaction))
                                        <i class="fa fa-2x fa-check-circle"></i>
                                        @else
                                        <img src="assets/images/number2.png" class="mx-auto" style="width:60px;height:60px;">
                                        @endif
                                    </span>
                                    <h3>Bukti Pembayaran</h3>
                                    <p>Upload bukti pembayaran yang telah kamu lakukan</p>
                                </div>
                            </div>
                            </a>
                            <a href="#slide04">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
                                    <span class="service-icon">
                                        @if( Auth::user()->status == 1)
                                        <i class="fa fa-2x fa-check-circle"></i>
                                        @else
                                        <img src="assets/images/number3.png" class="mx-auto" style="width:60px;height:60px;">
                                        @endif
                                    </span>
                                    <h3>Finalisasi dan Verifikasi</h3>
                                    <p>Lengkapi langkah sebelumnya dan tunggu kami memverifikasi data kamu</p>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if(Auth::user()->status == 0)
    <div class="section animated-row" data-section="slide02">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-7 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp">
                    </div>
                    <div class="contact-section">
                        <div class="row">
                            <div class="col-md-6 mx-auto animate" data-animate="fadeInUp">
                                <form action="{{ route('save_data_kdpn') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="input-field" style="text-align:left">
                                        <label for="team_name" class="form-label" >Nama Tim</label>
                                        <input id="team_name" type="text" class="my-0 form-control @error('team_name') is-invalid @enderror" name="team_name" value="{{ (old('team_name'))? old('team_name') : (!empty($data_user->team_name))? $data_user->team_name :''}}" required autocomplete="team_name">

                                        @error('team_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-field" style="text-align:left">
                                        <label for="captain" class="form-label" >Nama Ketua Tim</label>
                                        <input id="captain" type="text" class="my-0 form-control @error('captain') is-invalid @enderror" name="captain" value="{{ (old('captain'))? old('captain') : (!empty($data_user->captain))? $data_user->captain :''}}" required autocomplete="captain">

                                        @error('captain')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-field" style="text-align:left">
                                        <label for="university" class="form-label" >Asal Universitas</label>
                                        <input id="university" type="text" class="my-0 form-control @error('university') is-invalid @enderror" name="university" required autocomplete="university" value="{{ (old('university'))? old('university') : (!empty($data_user->university))? $data_user->university :''}}">

                                        @error('university')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="input-field" style="text-align:left">
                                        <label for="registration_form" class="form-label" >Unggah Form Pendaftaran <small class="text-warning">(max. 2 MB, pdf/doc/docx)</small></label>
                                        <input type="file" class="form-control mb-3 @error('registration_form') is-invalid @enderror" name="registration_form" id="registration_form" required style="padding:11px 0 0 11px;">
                                        {!! (!empty($data_user->registration_form)) ? 'Data dan File tersimpan! <br><i><a href="'.public_path('userdocs2020/kdpn/' . $data_user->registration_form).'"><i class="fa fa-check-circle"></i>  '. $data_user->registration_form.'</i></a>' :'' !!}

                                        @error('registration_form')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                        <a href="document/Form_Daftar_Loc_KDPN_prpn2020.pdf">
                                            <label class="btn" style="height:45px;background-color:wheat">Unduh Formulir dan LoC</label>
                                        </a>
                                        @if(!empty($data_user->team_name) && !empty($data_user->captain) && !empty($data_user->university) && !empty($data_user->registration_form))
                                        <button class="btn mx-auto" type="submit">Ubah Data</button>
                                        @else
                                        <button class="btn mx-auto" type="submit">Simpan Data</button>
                                        @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section animated-row" data-section="slide03">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-7 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp">
                    </div>
                    <div class="contact-section">
                        <div class="row">
                            <div class="col-md-6 mx-auto animate" data-animate="fadeInUp">
                                <form action="{{ route('save_trans_kdpn') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="input-field" style="text-align:left">
                                        <label for="transaction" class="form-label" >Unggah Bukti Pembayaran <small class="text-warning">(max. 2 MB, pdf/png/jpg/jpeg)</small></label>
                                        <input type="file" class="form-control mb-3 @error('transaction') is-invalid @enderror" name="transaction" id="transaction" required style="padding:11px 0 0 11px;">
                                        {!! (!empty($data_user->transaction)) ? 'Bukti Pembayaran telah tersimpan! <br><i><a href="'.public_path('userdocs2020/kdpn/' . $data_user->transaction).'"><i class="fa fa-check-circle"></i>  '. $data_user->transaction.'</i></a>' :'' !!}

                                        @error('transaction')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @if(!empty($data_user->transaction))
                                    <button class="btn mx-auto" type="submit">Ubah Berkas</button>
                                    @else
                                    <button class="btn mx-auto" type="submit">Unggah Berkas</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
    <div class="section animated-row" data-section="slide04">
        <div class="section-inner">
            <div div class="col-lg-6 col-md-5 col-12">
                <div class="contact-image" data-aos="fade-up">
                  <figure class="about-img animate" data-animate="fadeInUp"><img src="assets/images/logo.png" style="width:400px;height:400px;margin-top:100px;" class="rounded" alt=""></figure>
                </div>
            </div>
            @if(Auth::user()->status == 0)
                  <div class="col-lg-6 col-md-7 col-12">
                      <div class="input-field" style="text-align:left">
                        <label>Dengan mengklik tombol submit, kamu akan mengunci data kamu tidak bisa mengubahnya</label>
                        <br><br>
                        @if(!empty($data_user->team_name) && !empty($data_user->captain) && !empty($data_user->university) && !empty($data_user->registration_form) && !empty($data_user->transaction))
                                <form action="{{ route('submit_akun') }}" method="post">
                                @csrf
                                <input class="form-check-input" type="checkbox" name="agreement" id="agreement" {{ old('agreement') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="agreement">Saya telah mengisi data dengan sebenar-benarnya dan bertanggungjawab sepenuhnya jika data yang saya masukkan tidak benar.</label>
                                        @error('agreement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <br>
                                    <button class="btn mx-auto" style="border-radius:55px;font-size:14px;margin-top:8px;width:180px" type="submit">Submit</button>
                                </form>
                                @else
                                <label class="text-warning">Data Peserta dan Bukti Pembayaran belum dilengkapi.</label>
                                <br>
                                <button class="btn mx-auto" style="border-radius:55px;font-size:14px;margin-top:8px;width:180px" disabled>Belum Selesai</button>
                                @endif
                        </div>
                    </div>
                    @else
                        @include('layouts.part.congratulation')
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
