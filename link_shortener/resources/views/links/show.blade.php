@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" title="{{__('Voltar')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 mr-3'>
                <i class="fas fa-home fa-lg"></i>
            </a>
            {{ __('Detalhes do Link') }}
        </div>

        <div class="card-body mt-4">

            <table class='table table-striped table-responsive-xl rounded title table-hover'>
                <thead class='rounded thead-dark'>
                    <tr>
                        <th class="text-center">{{ __('Link')}}</th>
                        <th class="text-center">{{ __('Short')}}</th>
                        <th class="text-center">{{ __('Acessos')}}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="vertical-align: middle;">{{ $link->url }}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            <a href="{{ route('get_link', $link->slug) }}" target="_blank" rel="noopener noreferrer">
                                {{ $link->slug }}
                            </a>
                        </td>
                        <td class="text-center" style="vertical-align: middle;">{{ $link->accesses }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row m-0 p-0 mt-5">
                <h5>{{ __('Acessos ao Link') }}</h5>
            </div>
            <table class='table table-striped table-responsive-xl rounded title table-hover'>
                <thead class='rounded thead-dark'>
                    <tr>
                        <th class="text-center">{{ __('Data')}}</th>
                        <th class="text-center">{{ __('IP')}}</th>
                        <th class="text-center">{{ __('User-Agent')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($accessors) < 1)
                        <tr>
                            <td class="text-center" colspan="5">{{ __("Não há acessos ao Link") }}</td>
                        </tr>
                    @else
                        @foreach($accessors as $accessor)
                            <tr>
                                <td class="text-center" style="vertical-align: middle;">{{ $accessor->created_at->format('d M Y H:i') }}</td>
                                <td class="text-center" style="vertical-align: middle;">{{ $accessor->ip }}</td>
                                <td class="text-center" style="vertical-align: middle;">{{ $accessor->user_agent }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
