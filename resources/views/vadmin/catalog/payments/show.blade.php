@extends('vadmin.partials.main')

@section('title', 'Vadmin | Previsualización')

@section('header')
	@component('vadmin.components.header')
		@slot('breadcrums')
		    <li class="breadcrumb-item"><a href="{{ url('vadmin')}}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('payments.index')}}">Métodos de Pago</a></li>
            <li class="breadcrumb-item active">{{ $item->name }} <b></b></li>
		@endslot
		@slot('actions')
		@endslot
	@endcomponent
@endsection

@section('content')
    <div class="row">
        @component('vadmin.components.container')
            @slot('title')
                </b><h1>Método de Pago</h1>
            @endslot
            @slot('content')
                <b>Nombre: </b>{!! $item->name !!}</p>
                <b>Descripción:</b> {!! $item->description !!}</p>
                <b>Recargo:</b> % {!! $item->percent !!}</p>
				<hr class="softhr">
				<br>
				<a href="{{ url('vadmin/payments/'.$item->id.'/edit') }}" class="btn btnGreen"><i class="icon-pencil2"></i> Editar método de pago</a> 
        	@endslot
        @endcomponent
    </div>
@endsection

@section('scripts')
@endsection

