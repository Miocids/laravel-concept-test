@extends("layouts.main-layout")

@section("content")
<div class="container">
    <div class="d-flex justify-content-end align-items-end mb-4 mt-4">
        <a href="{{ route('users.create') }}" class="btn btn-secondary">Nuevo usuario</a>
    </div>
    <table class="table">
        <thead>
          <tr class="text-center">
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($responses as $user)
                <tr class="text-center">
                    <td>{{ $user?->first_name }}</td>
                    <td>{{ $user?->last_name }}</td>
                    <td>
                        <a href="{{ route('users.edit',['id' => $user?->getKey()]) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('users.destroy',['id' => $user?->getKey()]) }}" method ="POST" >
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" class="btn btn-danger"
                                   value="Borrar"
                            >
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
      </table>

</div>
@endsection