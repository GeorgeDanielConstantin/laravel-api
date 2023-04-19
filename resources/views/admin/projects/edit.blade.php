@extends('layouts.app')

@section('title', 'Project Edit')

@section('content')

    <a class="btn btn-primary m-4" href="{{ route('admin.projects.index') }}"><i class="bi bi-arrow-left-circle-fill"></i></a>

    <h1 class='mt-5'> Modifica "{{$project->title}}"</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <h4>Attenzione: </h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('admin.projects.update', $project) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-5">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('name') ?? $project->title }}"/>
                 @error('title') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
            </div>
            <div class="col-5">
                <label for="image" class="form-label">URL immagine di anteprima</label>
                <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                    value="{{ old('image') ?? $project->image}}" />
                    @error('image') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
            </div>

            <textarea class="col-6 @error('text') is-invalid @enderror" name="text" id="text" placeholder="Descrizione">{{ old('text') ?? $project->text}}</textarea>
             @error('text') 
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Salva</button>
    </form>
@endsection