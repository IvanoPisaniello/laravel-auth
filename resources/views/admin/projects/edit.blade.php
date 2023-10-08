@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="fw-bold py-3 text-uppercase">Inserisci i nuovi dati del tuo progetto</h1>

        <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
            @csrf()

            @method('put')

            <div class="mb-3">
                <label class="form-labal">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                    value="{{ old('title', $project->title) }}">
                @error('title')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Descrizione</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Percorso immagine</label>
                <input type="text" class="form-control @error('thumb') is-invalid @enderror" name="image"
                    value="{{ old('image', $project->image) }}">
                @error('image')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Linguaggi usati</label>
                <input type="text" class="form-control @error('languages_used') is-invalid @enderror" name="languages_used"
    value="{{ old('languages_used', is_array($project->languages_used) ? implode(', ', $project->languages_used) : $project->languages_used) }}">

                @error('languages_used')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-labal">Link GitHub del progetto</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" name="github_url"
                    value="{{ old('github_url', $project->github_url) }}">
                @error('github_url')
                    <div class="alert text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Salva</button>
        </form>
    </div>
@endsection