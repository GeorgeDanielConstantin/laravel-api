@extends('layouts.app')

@section('title', 'Project List')

@section('content')
<div class="container">
<div class="d-flex align-items-center justify-content-between">

    <a class="btn btn-primary my-3" href="{{ route('admin.projects.create') }}">Nuovo progetto</a>
    
    <form class="d-flex my-4" role="search">
    <input class="form-control m-2" type="search" name="term" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary" type="submit">Search</button>
</form>   
</div>
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Titolo</th>
                <th scope="col">Slug</th>
                <th scope="col">Categoria</th>
                <th scope="col">Text</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->type?->label }}</td>


                    <td class="d-flex justify-content-between">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                        <a href="{{ route('admin.projects.show', $project) }}">
                        </a>
                        <a href="{{ route('admin.projects.edit', $project) }}">
                        <i class="bi bi-pen"></i>
                        </a>
                        <button class="btn-icon" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$project->id}}">
                        <i class="bi bi-x"></i>
                        </button>
                    </td>

                    <td>
                        <a href="{{ route('admin.projects.show', $project) }}"></a>
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@section('modals')
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
@endsection
@endsection