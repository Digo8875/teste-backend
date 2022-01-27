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

    <div class="row m-0 p-0 mt-5 justify-content-center">
        <a role="button" class="btn btn-primary shadow mx-3" href="{{ route('links.create') }}">{{ __('Novo LINK') }}</a>
        <a role="button" class="btn btn-success shadow mx-3" href="{{ route('links.index') }}">{{ __('Meus LINKs') }}</a>
    </div>
</div>
@endsection
