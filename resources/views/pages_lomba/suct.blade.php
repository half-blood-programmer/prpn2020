@section('transaction', 'Upload Link Video')
<div id="fullpage" class="fullpage-default">
    <div class="section animated-row" data-section="slide03">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-8 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp" style="text-align:left">
                        <h5>Halo, {{ Auth::user()->name }}!</h5>
                        <a>Ikuti langkah berikut untuk mengikuti</a>
                        <h4>Stand Up Comedy Taxation</h4>
                    </div>
                    <div class="services-section">
                            @include('layouts.part.notification')
                        <div class="services-list owl-carousel">
                            <a href="#slide02">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
                                    <span class="service-icon">
                                        @if(!empty($data_user->job) && !empty($data_user->address) && !empty($data_user->age))
                                        <i class="fa fa-2x fa-check-circle"></i>
                                        @else
                                        <img src="assets/images/number1.png" class="mx-auto" style="width:60px;height:60px;">
                                        @endif
                                    </span>
                                    <h3>Kelengkapan Data</h3>
                                    <p>Lengkapi informasi pribadi anda untuk melanjutkan proses pendaftaran</p>
                                </div>
                            </div>
                            </a>
                            <a href="#slide03">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
                                    <span class="service-icon">
                                        @if(!empty($data_user->creation))
                                        <i class="fa fa-2x fa-check-circle"></i>
                                        @else
                                        <img src="assets/images/number2.png" class="mx-auto" style="width:60px;height:60px;">
                                        @endif
                                    </span>
                                    <h3>Upload Karya</h3>
                                    <p>Upload bukti pembayaran yang telah anda lakukan</p>
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
                                    <h3>Finalisasi</h3>
                                    <p>Lengkapi langkah sebelumnya dan tunggu kami memverifikasi karya anda</p>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@if( Auth::user()->status == 0)
    <div class="section animated-row" data-section="slide02">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-7 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp">
                    </div>
                    <div class="contact-section">
                        <div class="row">
                            <div class="col-md-6 mx-auto animate" data-animate="fadeInUp" style="text-align: left">
                                <form action="{{ route('save_data_suct') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-field">
                                        <label for="job" class="form-label" >{{ __('Profesi') }}</label>
                                        <input type="text" class="my-0 form-control @error('job') is-invalid @enderror" name="job" value="{{ (old('job'))? old('job') : (!empty($data_user->job))? $data_user->job :''}}" name="job" id="job" required autocomplete="job">

                                        @error('job')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="input-field">
                                        <label for="address" class="form-label" >{{ __('Alamat Lengkap') }}</label>
                                        <input type="text" class="my-0 form-control @error('address') is-invalid @enderror" name="address" value="{{ (old('address'))? old('address') : (!empty($data_user->address))? $data_user->address :''}}" name="address" id="address" required autocomplete="address">

                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="input-field">
                                        <label for="age" class="form-label" >{{ __('Umur') }}</label>
                                        <input type="text" class="my-0 form-control @error('age') is-invalid @enderror" name="age" value="{{ (old('age'))? old('age') : (!empty($data_user->age))? $data_user->age :''}}" name="age" id="age" required autocomplete="age">

                                        @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    @if(!empty($data_user->job) && !empty($data_user->address) && !empty($data_user->age))
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
                                <form action="{{ route('save_trans_suct') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                        <div class="input-field" style="text-align:left">
                                            <label for="transaction" class="form-label" >Masukkan Link Video Kamu</label>
                                            <input type="txet" class="my-0 form-control @error('creation') is-invalid @enderror" name="creation" value="{{ (old('creation'))? old('creation') : (!empty($data_user->creation))? $data_user->creation :''}}" name="creation" id="creation" required autocomplete="creation" placeholder="http://">

                                            @error('creation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                            @if(!empty($data_user->creation))
                                            <br>
                                            <button class="btn mx-auto" type="submit">Ubah Link</button>
                                            @else
                                            <br>
                                            <button class="btn mx-auto" type="submit">Unggah Link</button>
                                            @endif
                                    </form>
                                </div>
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
            <div class="row">
                  <div class="col-lg-6 col-md-5 col-12">
                      <div class="contact-image" data-aos="fade-up">
                        <figure class="about-img animate" data-animate="fadeInUp"><img src="assets/images/logo.png" style="width:400px;height:400px;margin-top:100px;" class="rounded" alt=""></figure>
                      </div>
                  </div>
                  @if(Auth::user()->status == 0)
                  <div class="col-lg-6 col-md-7 col-12">
                      <div class="input-field" style="text-align:left">
                        <label>Dengan mengklik tombol submit, kamu akan mengunci data kamu tidak bisa mengubahnya</label>
                        <br><br>
                        @if(!empty($data_user->job) && !empty($data_user->address) && !empty($data_user->age) && !empty($data_user->creation))
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
