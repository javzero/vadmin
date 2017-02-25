@extends('vadmin.layouts.main')
@section('title', 'VADmin | Editar Artículo')
@section('header_title', 'Editando artículo: ') 
@section('header_subtitle')
	{{ $article->title }}
@endsection
 

@section('styles')
	{!! Html::style('plugins/texteditor/trumbowyg.min.css') !!}
	{!! Html::style('plugins/jqueryfiler/themes/jquery.filer-dragdropbox-theme.css') !!}
	{!! Html::style('plugins/jqueryfiler/jquery.filer.css') !!}
	{!! Html::style('plugins/chosen/chosen.min.css') !!}
	{!! Html::style('plugins/validation/parsley.css') !!}
	{!! Html::style('plugins/colorpicker/spectrum.css') !!}
@endsection

@section('content')

	<div class="container">
	    <div class="row">
	        {!! Form::open(['route' => ['articles.update', $article], 'method' => 'PUT', 'files' => true]) !!}
	        	<div class="row">
					{{-- Slug--}}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('title', 'Título') !!}
							{!! Form::text('title', $article->title, ['class' => 'form-control', 'placeholder' => 'Título del artículo']) !!}
						</div>
					</div>
					{{-- Title--}}
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('slug', 'Slug') !!}
							{!! Form::text('slug', $article->slug, ['class' => 'SlugInput form-control', 'required']) !!}
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="form-group">
					{!! Form::label('content', 'Contenido') !!}
					{!! Form::textarea('content', $article->content, ['class' => 'form-control Textarea-Editor']) !!}
				</div>

				<div class="row">
					{{-- Code --}}
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label('code', 'Código') !!}
							{!! Form::text('code', $article->code, ['class' => 'form-control', 'placeholder' => 'Ingrese el código']) !!}
						</div>
					</div>
					{{-- Category--}}
					<div class="col-md-4">
						<div class="form-group">
							{!! Form::label('category_id', 'Categoría') !!}
							{!! Form::select('category_id', $categories, $article->category->id, ['class' => 'form-control Select-Category', 'placeholder' => 'Seleccione una opcion', 'required']) !!}
						</div>
					</div>
					{{-- Tags--}}
					<div class="col-md-5">
						<div class="form-group">
							{!! Form::label('tags', 'Tags') !!}
							{!! Form::select('tags[]', $tags, $actual_tags, ['class' => 'form-control Select-Tags', 'multiple', 'required']) !!}
						</div>
					</div>				
				</div>
				{{-- Color Picker--}}
				<div class="row">
					{{-- Composition --}}
					<div class="col-md-3 col-sm-6 col-xs-12">
						<div class="form-group">
							{!! Form::label('composition', 'Composición') !!}
							{!! Form::text('composition', $article->composition, ['class' => 'form-control', 'placeholder' => '']) !!}
						</div>
					</div>
					{{-- Status (active | paused) --}}
					<div class="col-md-3">
						<div class="form-group">
							{!! Form::label('status', 'Estado') !!}
							{!! Form::select('status', ['active' => 'Activo','paused' => 'Pausado'], $article->status, ['class' => 'form-control']) !!}
						</div> 
					</div>
					<div class="col-md-6">
						<div class="form-group colors-container">
							{!! Form::label('status', 'Colores') !!}
							<br>
							<div class="ColorPickerList color-picker-list">								
								<div class=""><input type='text' class='ColorPicker' /></div>
								@if(count($article->colors) == 0)
								@else
								@foreach($article->colors as $color)
									<div class="picked-color" style="background-color:{{ $color->name }}"></div>
								@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
				{{-- Images--}}
				@if(count($article->images) == 0 )
				@else
				<div class="row">
					<div class="col-md-12 actual-images horizontal-list">
						{!! Form::label('images', 'Imágenes actuales') !!}
						<ul>
							@foreach($article->images as $image)
							<li id="Img{{ $image->id }}" class="Edit_Actual_Image" data-imgid="{{ $image->id }}">	
								<img src="{{ asset('webimages/content/products/'.$image->name) }}">
								<div class="overlayItemCenter"><i class="ion-trash-a"></i></div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
				@endif
				<div class="row">
				<hr class="softhr">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('images', 'Agregar imágenes') !!}
							<span style="font-size: 12px"> | Formatos soportados: jpeg, jpg, png, gif</span>
							{!! Form::file('images[]', array('multiple'=>true, 'id' => 'Multi_Images')) !!}
							<div class="ErrorImage"></div>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="row text-center">
					{!! Form::submit('Editar Item', ['class' => 'button buttonOk']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>

@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('plugins/texteditor/trumbowyg.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/jqueryfiler/jquery.filer.min.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/spectrum.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/colorpicker/jquery.spectrum-es.js')}} "></script>
	<script type="text/javascript" src="{{ asset('plugins/validation/parsley.min.js') }}" ></script>
	{{-- <script type="text/javascript" src="{{ asset('plugins/validation/es/parsley-es.min.js') }}" ></script> --}}
	<script type="text/javascript" src="{{ asset('plugins/chosen/chosen.jquery.min.js') }}" ></script>
	<script type="text/javascript" src="{{ asset('js/articles.js')}} "></script>
@endsection

@section('custom_js')
	
	<script>

		// ---- Textarea Text Editor ----- //
		// Path to icons
		$.trumbowyg.svgPath = '{{ asset('plugins/texteditor/icons.svg') }}';
		// Init
		$('.Textarea-Editor').trumbowyg();

		// ---- Color Picker ----- //
		$(".ColorPicker").spectrum({
			
			color: "#fff",
			change: function(color) {
				// var div = ;
				var hex = color.toHexString(); // #ff0000
				// alert(div);
				$('.ColorPickerList').append("<div class='picked-color' style='background-color:"+ hex +"'><input type='hidden' name='color[]' value='"+ hex +"'></div>");
				console.log(hex);
			}
		});



		// ----- Image Delete Ajax ------- //
		// Ask Delete Confirmation
		$('.Edit_Actual_Image').click(function(){
			var id = $(this).data('imgid');
			confirm_delete(id,'Eliminar imágen?','');
		});

		// Proceed to deletion
		function delete_item(id) {	
		
			var route = "{{ url('deleteArticleImg') }}/"+id+"";

			$.ajax({
					url:  route,
					method: 'post',             
					dataType: "json",
					data: {id: id, _token: $('input[name="_token"]').val()
					},
						success: function(data){
					},
					complete: function(data)
					{
						if(data.responseText == 1)
						{
							swal(
							  'Ok!',
							  'Imágen eliminada !',
							  'success'
							);
							$('#Img'+id).hide(400);
						} else {
							swal(
							  'Ups!',
							  'La imágen no se pudo eliminar ! <br> Contacte al servicio técnico.',
							  'error'
							);
						}

					},
					error: function(data)
					{
						console.log(data);
					},
				});

		}
	
		
		
	</script>

@endsection

