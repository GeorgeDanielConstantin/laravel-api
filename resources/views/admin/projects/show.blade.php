@extends('layouts.app')

@section('title', 'Project Focus')

@section('content')
<div class="container">
<div class="d-flex justify-content-between">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-4">Torna ai progetti</>
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary my-4">Modifica</a>
    </div>    <div class="card">
        <div class="card-body my-2">
            <h5 class="card-title my-3"><strong>Titolo:</strong> {{ $project->title }}</h5>
            <h6 class="card-subtitle m-3"><strong> Slug:</strong>
                {{ $project->slug }}
            </h6>

            <div class="row">
                <div class="col-6 p-0">
                <img class="w-100" src="{{$project->getPlaceholder()}}" alt="anteprima">                </div>
                <div class="col-6 p-3">
                    <h6>Descrizione:</h6>
                    <p class="card-text">{{ $project->text }}</p>
                </div>
            </div>
        </div>
    </div>
</div>