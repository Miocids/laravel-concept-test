@extends('layouts.main-layout')

@section('content')
    @include('layouts.navbars.guest.navbar')
    <main class="main-content  mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
            style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/signup-cover.jpg'); background-position: top;">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Bienvenido!</h1>
                        {{--<p class="text-lead text-white">Use these awesome forms to login or create new account in your
                            project for free.</p>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Registrarse</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register.perform') }}">
                                @csrf
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="username" class="form-control" placeholder="Ingrese un nombre de usuario" aria-label="username" value="{{ old('username') }}" >
                                    @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico" aria-label="email" value="{{ old('email') }}" >
                                    @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Ingrese su contraseña" aria-label="password">
                                    @error('password') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="first_name" class="form-control" placeholder="Nombre" aria-label="nombre" value="{{ old('first_name') }}" >
                                    @error('first_name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="last_name" class="form-control" placeholder="Apellido" aria-label="apellido" value="{{ old('last_name') }}" >
                                    @error('last_name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <select class="form-select" aria-label="Default select example" name="company">
                                        <option value="">Seleccione la empresa a la que pertenece</option>
                                        @foreach ($companies as $company)
                                            <option value="{{ $company?->getKey() }}">{{ $company?->name }}</option>
                                        @endforeach
                                      </select>
                                      @error('company') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Registrarse</button>
                                </div>
                                <p class="text-sm mt-3 mb-0">Si ya se encuentra registrado <a href="{{ route('login') }}"
                                        class="text-dark font-weight-bolder">Loguéese</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
