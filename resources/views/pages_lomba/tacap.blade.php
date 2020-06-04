@section('transaction', 'Upload Karya')
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
                                            @if(!empty($data_user->branch) && !empty($data_user->university))
                                            <i class="fa fa-2x fa-check-circle"></i>
                                            @else
                                            <img src="assets/images/number1.png" class="mx-auto" style="width:60px;height:60px;">
                                            @endif
                                        </span>
                                    <h3>Kategori Lomba dan Kelengkapan Data</h3>
                                    <p>Silakan pilih kategori lomba TAC AP yang akan kamu ikuti kemudian lengkapi data kamu untuk melanjutkan proses pendaftaran</p>
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
                                    <p>Upload karya terbaik yang telah kamu ciptakan</p>
                                </div>
                            </div>
                            </a>
                            <a href="#slide04">
                            <div class="item animate" data-animate="fadeInUp">
                                <div class="service-box">
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

    @if(Auth::user()->status == 0)
    <div class="section animated-row" data-section="slide02">
        <div class="section-inner">
            <div class="row justify-content-center">
                <div class="col-md-7 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp">
                    </div>
                    <div class="contact-section">
                        <div class="row">
                            <div class="col-md-6 mx-auto animate" data-animate="fadeInUp" style="text-align: left">
                                <form method="post" action="{{ route('save_data_tacap') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-field">
                                        <label for="branch" class="form-label" >Kategori Lomba TAC AP</label>
                                        @if(!empty($data_user->branch))
                                            <select id="branch" name="branch" class="form-control @error('branch') is-invalid @enderror" required autocomplete="branch" {!! (!empty($data_user->branch)) ? "disabled style='background: rgba(250,250,250,0.05)!important;'" : ""!!}>
                                                <option selected disabled>{{ 'Tax '.ucwords($data_user->branch)  }}</option>
                                            </select>
                                        @else
                                            <select id="branch" name="branch" class="form-control @error('branch') is-invalid @enderror" required autocomplete="branch">
                                                <option selected disabled>Pilih Kategori Lomba</option>
                                                <option value="article">Tax Article </option>
                                                <option value="comic">Tax Comic</option>
                                                <option value="advertisement">Tax Advertisement</option>
                                                <option value="photography">Tax Photography</option>
                                            </select>
                                        @endif
                                    </div>
                                    <div class="input-field">
                                        <label for="university" class="form-label" >Institusi Asal</label>
                                        <input type="text" class="my-0 form-control @error('university') is-invalid @enderror" name="university" value="{{ (old('university'))? old('university') : (!empty($data_user->university))? $data_user->university :''}}" required autocomplete="university" placeholder="Institusi Asal">

                                        @error('university')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    @if(!empty($data_user->branch) && !empty($data_user->university))
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
                            <div class="col-md-6 mx-auto animate" data-animate="fadeInUp" style="text-align: left">
                                <form action="{{ route('save_creation_tacap') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                            @if(!empty($data_user->branch))
                                @if($data_user->branch == "advertisement" || $data_user->branch == "comic" || $data_user->branch == "photography")
                                    <div class="input-field">
                                        <label for="creation" class="form-label" >Link Karya (Google Drive)</label>
                                        <input type="text" class="my-0 form-control @error('creation') is-invalid @enderror" name="creation" value="{{ (old('creation'))? old('creation') : (!empty($data_user->creation))? $data_user->creation :''}}" name="creation" id="creation" required autocomplete="creation"  placeholder="http://">

                                        @error('creation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    @if(!empty($data_user->creation))
                                    <button class="btn mx-auto" type="submit">Ubah Link</button>
                                    @else
                                    <button class="btn mx-auto" type="submit">Unggah Link</button>
                                    @endif
                                @else
                                    <div class="input-field" style="text-align:left">
                                            <label for="creation" class="form-label" >{{ __('Unggah Berkas Karya') }}</label>
                                            <input type="file" class="form-control mb-3 @error('creation') is-invalid @enderror" name="creation" id="creation" required style="padding:11px 0 0 11px;">
                                            {!! (!empty($data_user->creation)) ? 'Karya kamu telah tersimpan! <br><i><i class="fa fa-check-circle"></i>  '. $data_user->creation.'</i>' :'' !!}

                                            @error('creation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    @if(!empty($data_user->creation))
                                    <button class="btn mx-auto" type="submit">Ubah Berkas</button>
                                    @else
                                    <button class="btn mx-auto" type="submit">Unggah Berkas</button>
                                    @endif
                                @endif
                            @else
                              Selesaikan dulu step pertama
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
                            @if(!empty($data_user->branch) && !empty($data_user->university) && !empty($data_user->creation))
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
                                    <label class="text-warning">Data Peserta dan Karya belum dilengkapi.</label>
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

        {{-- DAFTAR TAC AP
        <form action="">
            <label for="">Nama Peserta</label><br>
            <input type="text" name="nama" id="" placeholder="Nama"><br>
            <label for="">email</label><br>
            <input type="email" placeholder="email"><br>
            <label for="">Password</label><br>
            <input type="password" name="password" id="" placeholder="password"><br>
            <label for="">Ulangi Password</label><br>
            <input type="password" name="u_password" id=""><br>
            <label for="">Kategori Lomba</label><br>
            <input type="text" name="ket_tim" id=""><br>
            <label for="">Institusi Asal</label><br>
            <input type="text" name="asal" id="" placeholder="asal universitas / PT"><br>
            <label for="">No. Whatsapp </label><br>
            <input type="text" name="" id=""><br>
            <label for="">ID Line </label><br>
            <input type="text" name="" id=""><br>
            <label for="">Asal Kota</label><br>
            <input type="file" name="" id=""><br>
            <label for="">link Karya</label><br>
            <input type="file" src="" alt=""><br>
        </form> --}}
