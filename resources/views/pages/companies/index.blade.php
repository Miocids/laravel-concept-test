@extends("layouts.main-layout")

@section("content")
<div class="container">
    <div class="d-flex justify-content-end align-items-end mb-4 mt-4">
        <a href="{{ route('companies.create') }}" class="btn btn-secondary">Nueva empresa</a>
    </div>
    <table class="table">
        <thead>
          <tr class="text-center">
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Dirección</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($responses as $company)
                <tr class="text-center">
                    <td>{{ $company?->name }}</td>
                    <td>{{ $company?->description }}</td>
                    <td>{{ $company?->direction }}</td>
                    <td>
                        <a href="{{ route('companies.edit',['id' => $company?->getKey()]) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('companies.destroy',['id' => $company?->getKey()]) }}" method ="POST" >
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger"
                                   value="Borrar"
                            >
                        </form>
                        {{-- <a href="{{ route('companies.destroy',['id' => $company?->getKey()]) }}" class="btn btn-danger">Eliminar</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

</div>
@endsection