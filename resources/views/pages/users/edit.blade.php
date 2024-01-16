@extends("layouts.main-layout")

@section("content")
<main class="main-content  mt-5">
    <div class="container">
        <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
            <div class="col-xl-10 col-lg-10 col-md-10 mx-auto">
                <div class="card z-index-0">
                    <div class="card-header text-center pt-4">
                        <h5>Editar Usuario</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update',['id' => $response?->getKey()]) }}">
                            @csrf
                            @method("PUT")
                            <div class="flex flex-col mb-3">
                                <input type="text" name="username" class="form-control" placeholder="Ingrese un nombre de usuario" aria-label="username" value="{{ $response?->username }}" >
                                @error('username') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Ingrese su correo electrónico" aria-label="email" value="{{ $response?->email }}" >
                                @error('email') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <input type="text" name="first_name" class="form-control" placeholder="Nombre" aria-label="nombre" value="{{ $response?->first_name }}" >
                                @error('first_name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <div class="flex flex-col mb-3">
                                <input type="text" name="last_name" class="form-control" placeholder="Apellido" aria-label="apellido" value="{{ $response?->last_name }}" >
                                @error('last_name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                            </div>
                            <input type="hidden" name="company" value="{{ \auth()->user()->company?->getKey() }}">
                            <div class="text-center d-flex justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary w-25 my-4 mb-2">Guardar</button>
                                <a href="{{ route('users.index') }}" class="btn btn-danger w-25 my-4 mb-2 ml-3">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection