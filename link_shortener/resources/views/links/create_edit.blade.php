@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" title="{{__('Voltar')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 mr-3'>
                <i class="fas fa-undo-alt fa-lg"></i>
            </a>
            {{ isset($link->id) ? __('Editar Link') : __('Novo Link') }}
        </div>

        <div class="card-body mt-4">
            @if(isset($link->id))
            <form method="POST" action="{{ route('links.update', $link->id) }}" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
            @else
            <form method="POST" action="{{ route('links.store') }}" enctype="multipart/form-data">
            @endif
                @csrf

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right ">{{ __('URL') }}<span style="color: red;">*</span></label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ isset($link->url) ? $link->url  : old('url') }}" placeholder="{{ __('URL completa com http/https') }}" required maxlength="250">

                        @error('url')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="slug" class="col-md-4 col-form-label text-md-right ">{{ __('Identificador') }}</label>

                    <div class="col-md-6">
                        <input id="slug" type="text" class="form-control @error('slug') is-invalid @enderror" name="slug" value="{{ isset($link->slug) ? $link->slug  : old('slug') }}" placeholder="{{ __('Identificador') }}" maxlength="8">

                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row justify-content-center mb-0 mt-5">
                    <div class="col-md-12 d-flex justify-content-center">
                        @if(!isset($link->id))
                            <button type="submit" class="btn btn-primary px-4">
                                {{ __('Cadastrar') }}
                            </button>
                        @else
                            <button type="submit" class="btn btn-success px-4">
                                {{ __('Atualizar') }}
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
