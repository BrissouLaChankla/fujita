@extends('layouts.app')

@section('content')

<div class="my-3 text-uppercase text-center">
    <div class="mb-3">

        <video autoplay loop muted>
            <source src="{{asset("video/highlight_fujita.mp4")}}" type="video/mp4" />
        </video>
    </div>
    <h1 class="text-success">Esports and streaming</h1>
    <h2 class="text-white">Fujita</h2>
</div>
<div class="d-flex justify-content-center">
        <div class="d-flex align-items-center mx-5">
            <a href="https://twitter.com/EsportUraken" class="text-decoration-none text-white d-flex">
                <i class="text-success med-icon fab fa-twitter"></i>
                <div class="ml-2 text-uppercase d-flex flex-column">
                    <h6 class="m-0">Twitter</h6>
                    <h4 class="m-0 font-weight-bold">@EsportUraken</h4>
                </div>
            </a>
        </div>
    <div class="d-flex align-items-center mx-5">
        <a href="https://discord.gg/FUrYPqCnY6" class="text-decoration-none text-white d-flex">
            <i class="text-success med-icon fab fa-discord"></i>
            <div class="ml-2 text-uppercase d-flex flex-column">
                <h6 class="m-0">Discord</h6>
                <h4 class="m-0 font-weight-bold">Uraken</h4>
            </div>
        </a>
    </div>
    <div class="d-flex align-items-center mx-5">
        <a href="https://www.twitch.tv/urakenesport" class="text-decoration-none text-white d-flex">
            <i class="text-success med-icon fab fa-twitch"></i>
            <div class="ml-2 text-uppercase d-flex flex-column">
                <h6 class="m-0">Twitch</h6>
                <h4 class="m-0 font-weight-bold">Uraken</h4>
            </div>
        </a>
    </div>
</div>

@endsection