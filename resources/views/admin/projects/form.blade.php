@extends('layouts.app')

@section('title', ($project->id) ? 'Modifica progetto' : 'Nuovo progetto')

@section('content')
    
    <a class="btn btn-primary my-4" href="{{ route('admin.projects.index') }}">Torna ai progetti</a>
    
    @if($project->id)
        <h1 class='my-4'> Modifica "{{$project->title}}"</h1>
    @else 
        <h1 class='my-4'> Crea un nuovo progetto</h1>
    @endif

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


    @if($project->id)
    <form action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" method="POST">
    @else 
    <form action="{{ route('admin.projects.store') }}" enctype="multipart/form-data" method="POST">
    @endif    
    @csrf

        <div class="row d-flex">
            <div class="col-5">
                <div>
                    
                    <label for="title" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('name') }}" />
                </div>
            </div>
            <div class="flex-column d-flex">
                <label for="image" class="form-label">URL immagine di anteprima</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                <div class="mt-3">
                    <img class="w-100" src="{{$project->getPlaceholder()}}" alt="anteprima" >
                </div>
            </div>

            <div class="col-5">

                <div class="text">
                    <textarea class=" w-100  @error('text') is-invalid @enderror" name="text" id="text" placeholder="Descrizione">
                        {{ old('text') ?? $project->text}}
                    </textarea>
                    @error('text') 
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror  
                </div>  

                <div class="text-center ">
                    <button type="submit" class="btn btn-primary m-5 p-5">Salva</button>    
                </div>

            </div>
        </div>
    </form>
@endsection