@extends('layouts.master')
@section('title', 'Daftar Peserta')
@section('content')

<div id="fullpage" class="fullpage-default">
    <div class="section animated-row">
        <div class="section-inner">
            <div class="row justify-content-center">
               <div class="col-md-7 wide-col-laptop">
                    <div class="title-block animate" data-animate="fadeInUp">
                        <h2>Daftar Peserta</h2>
                    </div>
                    <img class="img img-responsive img-fluid" src="assets/images/alur_registrasi-02.png" style="width:320px;height:320px">
                    <img class="img img-responsive img-fluid" src="assets/images/alur_registrasi-03.png" style="width:320px;height:320px">
                    <img class="img img-responsive img-fluid" src="assets/images/alur_registrasi-04.png" style="width:320px;height:320px">
                    <div class="col-md-6 mx-auto">
                        <div class="row">
                            <div  data-animate="fadeInUp">
                                <form method="post" action="{{ route('register') }}">
                                    @csrf
                                    <div class="input-field" style="text-align:left;">
                                        <label for="name" class="form-label" >{{ __('Nama Lengkap') }}</label>
                                        <input id="name" type="text" class="my-0 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="input-field" style="text-align:left;">
                                        <label for="name" class="form-label">{{ __('Alamat e-mail') }}</label>
                                        <input id="email" type="email" class="my-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="input-field" style="text-align:left;">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="my-0 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="input-field" style="text-align:left;">
                                    <label for="password-confirm" class="form-label">{{ __('Konfirmasi Password') }}</label>
                                        <input id="password-confirm" type="password" class="my-0 form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>


                                    <div class="input-field" style="text-align:left;">
                                        <label for="city" class="form-label">{{ __('Asal Kota') }}</label>
                                        <input id="city" type="text" class="my-0 form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city">

                                        @error('city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-field" style="text-align:left;">
                                    <label for="competition" class="form-label">{{ __('Mata Lomba') }}</label>
                                        <select id="competition" name="competition" class="form-control @error('competition') is-invalid @enderror" required autocomplete="competition">
                                            <option disabled selected>Pilih Mata Lomba</option>
                                           
                                            @foreach (App\Competition::get() as $competition)
                                                <option value="{{ $competition->id }}" {{ (old("competition") == "1" ? "selected":"") }}>{{ $competition->title }}</option>
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="input-field" style="text-align:left;">
                                    <label for="whatsapp" class="form-label">{{ __('No. WhatsApp') }}</label>
                                        <input id="whatsapp" type="text" class="my-0 form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('whatsapp') }}" required autocomplete="whatsapp">


                                        @error('whatsapp')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="input-field" style="text-align:left;">
                                    <label for="line" class="form-label">{{ __('ID Line') }}</label>
                                            <input id="line" type="text" class="my-0 form-control @error('line') is-invalid @enderror" name="line" value="{{ old('line') }}" required autocomplete="line">

                                        @error('line')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>

                                    <div class="input-field">
                                        <div class="form-check text-left ml-3">
                                                    <input class="form-check-input" type="checkbox" name="agreement" id="agreement" {{ old('agreement') ? 'checked' : '' }}>

                                                    <label class="form-check-label" for="agreement">Dengan klik tombol Daftar, saya menyetujui ketentuan yang telah ditetapkan oleh panitia {{ config('app.name') }}
                                                    </label>

                                        @error('agreement')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                        </div>
                                    </div>


                                <button class="btn col-md-12" type="submit">DAFTAR</button>
                                </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-5" >
                </div>
            </div>
        </div>
    </div>
    </div>

    @stop


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Registrasi Akun') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Alamat Email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="university" class="col-md-4 col-form-label text-md-right">{{ __('Nama Universitas') }}</label>

                            <div class="col-md-6">
                                <input id="university" type="text" class="form-control @error('university') is-invalid @enderror" name="university" value="{{ old('university') }}" required autocomplete="university">
                            </div>

                             @error('university')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="form-group row">
                            <label for="whatsapp" class="col-md-4 col-form-label text-md-right">{{ __('No. WhatsApp') }}</label>

                            <div class="col-md-6">
                                <input id="whatsapp" type="text" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ old('whatsapp') }}" required autocomplete="whatsapp">
                            </div>

                             @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="form-group row">
                            <label for="line" class="col-md-4 col-form-label text-md-right">{{ __('ID Line') }}</label>

                            <div class="col-md-6">
                                <input id="line" type="text" class="form-control @error('line') is-invalid @enderror" name="line" value="{{ old('line') }}" required autocomplete="line">
                            </div>

                             @error('line')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Daftar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
