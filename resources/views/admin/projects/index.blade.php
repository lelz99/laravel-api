@extends('layouts.app')

@section('content')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nome</th>
      <th scope="col">Tipo</th>
      <th scope="col">Tecnologie</th>
      <th scope="col">Pubblicato</th>
      <th scope="col">Data Fine Progetto</th>
      <th scope="col">Data Creazione</th>
      <th scope="col">Ultima Modifica</th>
      <th scope="col">
        <a class="btn btn-sm btn-success fw-bold" href="{{route('admin.projects.create')}}">Nuovo Progetto</a>
      </th>
    </tr>
  </thead>
  <tbody>
    @forelse($projects as $project)
    <tr>
      <th scope="row">{{$project->id}}</th>
      <td>{{$project->title}}</td>
      <td>
        <div>
          {{-- Rivedere Stile --}}
          @if($project->type) {{$project->type?->label}} @else Nessuno @endif
        </div>
      </td>
      <td>
        @foreach($project->technologies as $technology)
        <i class="{{"$technology->icon $technology->color"}} fa-2x"></i>
        @endforeach
      </td>
      <td>
        @if($project->is_published) <i class="fa-solid fa-circle-check text-success ms-4"></i>
        @else <i class="fa-solid fa-circle-xmark text-danger ms-4"></i> 
        @endif
      </td>
      <td>{{$project->end_date}}</td>
      <td>{{$project->created_at}}</td>
      <td>{{$project->updated_at}}</td>
      <td>
        <div class="d-flex gap-1">
          <a href="{{route('admin.projects.show', $project)}}" class="btn btn-sm btn-primary"><i class="fa-regular fa-eye"></i></a>                
          <a href="{{route('admin.projects.edit', $project)}}" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen"></i></a>
          <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash"></i></button>
          </form>            
        </div>
      </td>
    </tr>
    @empty
    <td colspan="9" class="text-center">
      <h2>Non ci sono progetti</h2>
    </td>
    @endforelse
  </tbody>
</table>
@endsection