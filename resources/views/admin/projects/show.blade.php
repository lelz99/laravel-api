@extends('layouts.app')

@section('content')
  <h1 class="my-5">Project</h1>
  <div class="card mb-3">
    <div class="row g-0">
      <div class="card-header">
        <h2 class="card-title mb-1">{{$project->title}}</h2>
        {{-- Rivedere Stile --}}
        <p class="fw-bold mb-0"> Tipo: <span class="fw-normal"> @if($project->type) {{$project->type?->label}} @else Nessuno @endif </span> </p>
      </div>
      <div class="col-md-4">
        <img src="{{asset('storage/' . $project->preview_project)}}" class="img-fluid h-100 w-100" alt="{{$project->title}}">
      </div>
      <div class="col-md-8 d-flex flex-column">
        <div class="card-body">
          <p class="card-text">{{$project->description}}</p>
          <div class="row">
            <div class="col-10">
              <ul class="list-unstyled">
                <li><strong>Data fine Progetto:</strong> {{$project->end_date}}</li>
                <li><strong>Data Creazione:</strong> {{$project->created_at}}</li>
                <li><strong>Ultima Modifica:</strong> {{$project->updated_at}}</li>
              </ul>
              <div class="card-text"><strong>Pubblicato:</strong>
                @if($project->is_published) <i class="fa-solid fa-circle-check text-success"></i>
                @else <i class="fa-solid fa-circle-xmark text-danger"></i> 
                @endif
              </div>
            </div>
            <div class="col-md-2 col-12 row row-cols-md-2">
              @foreach($project->technologies as $technology)
              <i class="{{"$technology->icon $technology->color"}} fa-2x"></i>
              @endforeach
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between p-3">
          <a href="{{route('admin.projects.index')}}" class="btn btn-secondary">Torna Indietro</a>
          <div class="d-flex gap-2">
            <a class="btn btn-warning" href="{{route('admin.projects.edit', $project)}}">Modifica</a>
            {{-- da rivedere --}}
            <form action="{{route('admin.projects.destroy', $project)}}" method="POST" class="delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Elimina</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection