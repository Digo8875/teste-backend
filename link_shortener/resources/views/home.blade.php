@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0 my-5 justify-content-center">
        <a role="button" class="btn btn-primary shadow mx-3" href="{{ route('links.create') }}">{{ __('Novo LINK') }}</a>
        <a role="button" class="btn btn-success shadow mx-3" href="{{ route('links.index') }}">{{ __('Meus LINKs') }}</a>
        <a role="button" class="btn btn-info shadow mx-3" href="#">{{ __('Exportar Meus LINKs') }}</a>
    </div>

    <hr>
    <div class="row m-0 p-0 mt-5 justify-content-center">
        <form method="POST" action="{{ route('import_links') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="file_links" class="col-12 col-form-label">{{ __("Importe Links com um arquivo .CSV") }}</label>

                <div class="col-12">
                    <input type="file" id="file_links" name="file_links" class="form-control @error('file_links') is-invalid @enderror">

                    @error("file_links")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row justify-content-center mb-0 mt-2">
                <div class="col-md-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger px-4">
                        {{ __('Importar Links') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
