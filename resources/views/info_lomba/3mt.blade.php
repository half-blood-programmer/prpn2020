@extends('layouts.master')
@section('title', 'Tentang 3 MT')

@section('content')
<div id="fullpage" class="fullpage-default">
<div class="section animated-row" data-section="slide01">
    <div class="section-inner">
        <div class="about-section">
            <div class="row justify-content-center">
                <div class="col-lg-8 wide-col-laptop">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="about-contentbox">
                                <div class="animate" data-animate="fadeInUp">
                                    <h2>Three Minute Thesis</h2>
                                    <p>Three Minute Thesis (3MT) Contest merupakan kompetisi perayaan penelitian menarik yang dilakukan mahasiswa di bidang perpajakan mulai dari karya tulis tugas akhir, skripsi, tesis, desertasi ataupun bentuk penelitian lainnya.</p>
                                </div>

                                <a href="{{ url('document/booklet_3mt_prpn2020.pdf') }}">
                                    <button class="btn col-md-6 animate" data-animate="fadeInUp" style="border-radius:50px;background-color:ffffffe0" type="submit">Unduh Booklet</button><br>
                                </a><br>
                                <a href="{{ url('document/Form_Daftar_3MT_prpn2020.pdf') }}">
                                    <button class="btn col-md-6 animate" data-animate="fadeInUp" style="border-radius:50px;background-color:ffffffe0;padding:5px;" type="submit">Unduh Formulir</button><br>
                                </a>
                                @auth
                                    @else
                                        @if (Route::has('register'))
                                        <a href="{{ route('register') }}">
                                        <button class="btn col-md-6 animate" data-animate="fadeInUp"  style="border-radius:50px;background-color:ffffffe0;margin-top:8px" type="submit">Daftar</button>
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                        <div class="col-md-6">
                            <figure class="about-img animate" data-animate="fadeInUp"><img src="assets/images/POSTER LOMBA-03.png" style="width:355px;height:525px;margin-top:50px;" class="rounded" alt=""></figure>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@stop
