@extends('layouts.main-layout')

@section('content')
    <main class="main-content  mt-5">
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-10 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-header text-center pt-4">
                            <h5>Nueva Empresa</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('companies.store') }}">
                                @csrf
                                @method("POST")
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="name" class="form-control" placeholder="Ingrese nombre de la empresa" aria-label="name" value="{{ old('name') }}" >
                                    @error('name') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="description" name="description" class="form-control" placeholder="Ingrese una descripción" aria-label="description" value="{{ old('description') }}" >
                                    @error('description') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="flex flex-col mb-3">
                                    <input type="text" name="direction" class="form-control" placeholder="Dirección de la empresa" aria-label="direction" value="{{ old('direction') }}" >
                                    @error('direction') <p class='text-danger text-xs pt-1'> {{ $message }} </p> @enderror
                                </div>
                                <div class="text-center d-flex justify-content-center align-items-center">
                                    <button type="submit" class="btn btn-primary w-25 my-4 mb-2">Guardar</button>
                                    <a href="{{ route('companies.index') }}" class="btn btn-danger w-25 my-4 mb-2 ml-3">Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
