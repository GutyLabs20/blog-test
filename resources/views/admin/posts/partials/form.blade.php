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
            {{-- con isset: verificamos si esta definido o no la variable $post --}}
            @isset ($post->image)
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="">
            @else
                <img id="picture" src="https://cdn.pixabay.com/photo/2020/12/27/12/07/sunrise-5863751_960_720.png" alt="">
            @endisset
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
