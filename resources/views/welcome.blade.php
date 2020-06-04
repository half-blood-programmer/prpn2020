@extends('layouts.master')
@section('content')
<div id="fullpage" class="fullpage-default">
    <div class="section animated-row" data-section="slide01">
        <div class="section-inner">
            <div class="welcome-box">
                <span class="welcome-first animate" data-animate="fadeInUp">Official Website</span>
            <h1 class="welcome-title mb-0 animate" data-animate="fadeInUp">{{ config('app.name') }}</h1>
                <p class="animate" data-animate="fadeInUp">{{ config('app.description') }}</p>
                <div class="scroll-down next-section animate data-animate=fadeInUp "><img alt=""><span>Swipe Up</span></div>
            </div>
        </div>
    </div>

    @include('layouts.part.support')
    @include('layouts.part.listLomba')
    @include('layouts.part.gallery')
</div>
@stop
