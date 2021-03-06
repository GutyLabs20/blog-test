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

            {{-- Se habilitó el atributo files, que sirve para enviar archivos desde el formulario --}}
            {!! Form::open(['route' => 'admin.posts.store', 'autocomplete' => 'off', 'files' => true]) !!}

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



                    @error('status')
                        <span class="text-danger">
                            {{$message}}
                        </span>
                    @enderror

                </div>

                <hr>

                <div class="row mb-4">
                    <div class="col">
                        <div class="image-wrapper">
                            <img id="picture" src="https://cdn.pixabay.com/photo/2020/12/27/12/07/sunrise-5863751_960_720.png" alt="">
                        </div>
                    </div>

                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('file', 'Imagen que mostrará en el post') !!}
                            {{-- Agregue atributo accept solo imagenes y luego hacer la validación en el servidor --}}
                            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

                            @error('file')
                                <span class="text-danger">
                                    {{$message}}
                                </span>
                            @enderror

                        </div>


                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum expedita incidunt ipsum! Tenetur provident quibusdam autem est quisquam optio voluptatem nobis expedita itaque maxime, sit consequatur dolorem distinctio, minus inventore.
                        </p>

                    </div>
                </div>

                <hr>

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

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
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


        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }

    </script>

@endsection
