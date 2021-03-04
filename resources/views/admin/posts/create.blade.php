@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Agregar Nuevo Post</h1>
@stop

@section('content')

    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong>
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">

            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off']) !!}

                {!! Form::hidden('user_id', auth()->user()->id) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Post']) !!}

                    @error('name')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese slug del Post', 'readonly']) !!}

                    @error('slug')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Categoría') !!}
                    {!! Form::select('category_id', $categorias, null, ['class' => 'form-control']) !!}

                    @error('category_id')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror
                </div>

                <div class="form-group">

                    <p class="font-weight-bold">Etiquetas</p>

                    @foreach ($tags as $tag)
                        <label>
                            {!! Form::checkbox('tags[]', $tag->id, null, ['class' => 'ml-3']) !!}
                            {{$tag->name}}
                        </label>
                    @endforeach

                    <hr>

                    @error('tags')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror

                </div>



                <div class="form-group">

                    <p class="font-weight-bold">Estado</p>

                    <label>{!! Form::radio('status', 1, true) !!}Borrador</label>
                    <label>{!! Form::radio('status', 2, null, ['class' => 'ml-3']) !!}Publicado</label>

                    <hr>

                    @error('status')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror

                </div>

                <div class="form-group">

                    {!! Form::label('extract', 'Extracto') !!}
                    {!! Form::textarea('extract', null, ['class' => 'form-control']) !!}

                    @error('extract')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror

                </div>

                <div class="form-group">

                    {!! Form::label('body', 'Cuerpo del Post') !!}
                    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}

                    @error('body')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror

                </div>

                {!! Form::submit('Crear Post', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@stop


@section('js')

    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/26.0.0/classic/ckeditor.js"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });

        // Plugin ckeditor modo clásico
        ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        });

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        });
    </script>

@endsection
