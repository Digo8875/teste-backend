@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">
            <a href="{{ route('home') }}" title="{{__('Voltar')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 mr-3'>
                <i class="fas fa-home fa-lg"></i>
            </a>
            {{ __('Seus Links') }}
        </div>

        <div class="card-body mt-4">

            <table class='table table-striped table-responsive-xl rounded title table-hover'>
                <thead class='rounded thead-dark'>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('Link')}}</th>
                        <th class="text-center">{{ __('Identificador')}}</th>
                        <th class="text-center">{{ __('Acessos')}}</th>
                        <th class="text-center">{{ __('Ações')}}</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($links) < 1)
                    <tr>
                        <td class="text-center" colspan="5">{{ __("Não há registros no sistema") }}</td>
                    </tr>
                @else
                    @for($i = 0; $i < count($links); $i++)
                        <tr>
                            <td class="text-center" style="vertical-align: middle;">{{ $i + 1 }}</td>
                            <td class="text-center" style="vertical-align: middle;">{{ $links[$i]->url }}</td>
                            <td class="text-center" style="vertical-align: middle;">
                                <a href="{{ route('get_link', $links[$i]->slug) }}" target="_blank" rel="noopener noreferrer">
                                    {{ $links[$i]->slug }}
                                </a>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">{{ $links[$i]->accesses }}</td>

                            <td class="text-center" style="vertical-align: middle;">
                                <div class="row m-0 p-0 justify-content-center">
                                    <a href="{{ route('links.show', $links[$i]->id) }}" title="{{__('Detalhes')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 m-1'>
                                        <i class="fas fa-search-plus fa-lg"></i>
                                    </a>

                                    <a href="{{ route('links.edit', $links[$i]->id) }}" title="{{__('Editar')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 m-1'>
                                        <i class="fas fa-edit fa-lg"></i>
                                    </a>

                                    <a href="#" title="{{__('Excluir')}}" style='cursor: pointer; border: 1px solid gray; text-decoration:none;' class='rounded p-2 m-1' onclick="event.preventDefault(); document.getElementById('excluir-obj-form-{{$i}}').submit();">
                                        <i class="far fa-trash-alt fa-lg"></i>
                                    </a>
                                    <form id="excluir-obj-form-{{$i}}" action="{{ route('links.destroy', $links[$i]->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection
