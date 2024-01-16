@extends('layouts.main-layout')

@section('content')
    <div class="container position-sticky z-index-sticky top-0 mb-2">
        <div class="row">
            <div class="col-12">
                @include('layouts.navbars.guest.navbar')
            </div>
        </div>
    </div>

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form role="form" method="POST" action="{{ route('login.perform') }}">
                        @csrf
                        @method('POST')
                        <div class="flex flex-col mb-3">
                            <label for="email">Correo electrónico</label>
                            <input type="text"
                                name="email"
                                class="form-control form-control-lg"
                                value="{{ old('user') ?? '' }}"
                                placeholder="Ingrese su email"
                                aria-label="email"
                            >
                        </div>
                        <div class="flex flex-col mb-3">
                            <label for="password">Contraseña</label>
                            <input type="password"
                                name="password"
                                class="form-control form-control-lg"
                                aria-label="Password"
                                placeholder="Ingrese su contraseña"
                            >
                            @error('user') <p class="text-danger text-xs pt-1"> {{$message}} </p>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
