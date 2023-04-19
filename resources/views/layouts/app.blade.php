<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name',) }} @yeld('title')</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
    <!-- Usando Vite -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div>
        @include('layouts.partials.navbar')
        <main class="container">
            @yield('content')
        </main>
    </div>

@foreach($projects as $project)
    <div class="modal fade text-dark" id="delete-modal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina "{{$project->title}}"</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Operazione non è reversibile
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>

            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="text-danger">              
                @method('delete') 
                @csrf

                <button type="submit" class="btn btn-danger">Ok</button>
            </form>

            </div>
            </div>
        </div>
    </div>
@endforeach
</body>


</html>
