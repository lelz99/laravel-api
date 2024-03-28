@extends('layouts.app')
@section('content')

<div class="container mb-4">
    @foreach ($projects as $project)
    <div class="card mb-5">
        <div class="row g-0">
            <div class="card-header">
                <h2 class="card-title">{{$project->title}}</h2>
            </div>
            <div class="col-md-4">
                <img src="{{asset('storage/' . $project->preview_project)}}" class="img-fluid w-100 h-100" alt="{{$project->title}}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="card-text">{{$project->description}}</p>
                    <p class="card-text mb-0"><strong>Data fine Progetto:</strong> {{$project->end_date}}</p>
                </div>
            </div>
        </div>
    </div>    
    @endforeach
</div>
@endsection