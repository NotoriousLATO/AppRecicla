@extends('layouts.app')

@section('content')
@include('partials.ofertas-styles')

<div class="container">
   <h1>Ofertas Disponibles</h1>

   <!-- Formulario de filtrado -->
   <form method="GET" action="{{ route('oferta.index') }}" class="mb-4">
      <div class="d-flex">
         <!-- Filtro por Estado -->
         <div class="me-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
    <option value="">Selecciona un estado</option>
    <option value="disponible" {{ request('estado') == 'disponible' ? 'selected' : '' }}>Disponible</option>
    <option value="aceptada" {{ request('estado') == 'aceptada' ? 'selected' : '' }}>Aceptada</option>
    <option value="rechazada" {{ request('estado') == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
</select>
         </div>

         <!-- Filtro por Precio Mínimo -->
         <div class="me-3">
            <label for="precio_min">Precio Mínimo</label>
            <input type="number" name="precio_min" id="precio_min" class="form-control" value="{{ request('precio_min') }}" placeholder="Precio Mínimo">
         </div>

         <!-- Filtro por Precio Máximo -->
         <div class="me-3">
            <label for="precio_max">Precio Máximo</label>
            <input type="number" name="precio_max" id="precio_max" class="form-control" value="{{ request('precio_max') }}" placeholder="Precio Máximo">
         </div>

         <!-- Botón de Filtrado -->
         <button type="submit" class="btn btn-primary mt-4">Filtrar</button>
      </div>
   </form>

   <div class="d-flex justify-content-start mb-4">
      <a href="{{ route('oferta.create') }}" class="btn btn-success">Agregar Oferta</a>
   </div>

   @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
   @endif

   @if(session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
   @endif

   <div class="table-responsive">
      <table class="table table-striped table-bordered">
         <thead class="thead-dark">
            <tr>
               <th>ID</th>
               <th>Usuario</th>
               <th>Dirección</th>
               <th>Material</th>
               <th>Cantidad</th>
               <th>Precio</th>
               <th>Imagen</th>
               <th>Estado</th>
               <th>Acciones</th>
            </tr>
         </thead>
         <tbody>
            @foreach($ofertas as $oferta)
               <tr>
                  <td>{{ $oferta->id }}</td>
                  <td>{{ $oferta->usuario->name }}</td>
                  <td>{{ $oferta->direccion }}</td>
                  <td>{{ $oferta->material }}</td>
                  <td>{{ $oferta->cantidad }}</td>
                  <td>Bs{{ number_format($oferta->precio, 2) }}</td>
                  <td>
                     @if($oferta->image && Storage::disk('public')->exists($oferta->image))
                        <img src="{{ asset('storage/' . $oferta->image) }}" style="width: 80px; height: auto;">
                     @else
                        Sin imagen
                     @endif
                  </td>
                  <td>{{ ucfirst($oferta->estado) }}</td>
                  <td>
                     <a href="{{ route('oferta.show', $oferta->id) }}" class="btn btn-info btn-sm">Ver</a>
                     @if(Auth::user()->role === 'recolector' && $oferta->estado === 'disponible')
                        <form action="{{ route('oferta.aceptar', $oferta->id) }}" method="POST" style="display:inline;">
                           @csrf
                           <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                        </form>
                        <form action="{{ route('oferta.rechazar', $oferta->id) }}" method="POST" style="display:inline;">
                           @csrf
                           <button type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                        </form>
                     @endif
                  </td>
               </tr>
            @endforeach
         </tbody>
      </table>
   </div>

   {{ $ofertas->links('vendor.pagination.bootstrap-4') }}
</div>

@endsection
