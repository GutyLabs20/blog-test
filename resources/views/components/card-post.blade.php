{{-- para llamar a un componente o vincular --}}
@props(['post'])


<article class="mb-8 bg-white shadow-lg rounded-lg overflow-hidden">

    @if ($post->image)
        <img class="w-full h-72 object-cover object-center" src="{{Storage::url($post->image->url)}}" alt="">
    @else
        <img class="w-full h-72" src="https://cdn.pixabay.com/photo/2020/12/27/12/07/sunrise-5863751_960_720.png" alt="">
    @endif

    <div class="px-6 py-4">
        <h1 class="font-bold text-xl mb-2">
            <a href="{{route('posts.show', $post)}}">{{$post->name}}</a>
        </h1>

        <div class="text-gray-700 text-base">
            {{-- Aquí se cambio por lo de abajo, {{$post->extract}} ya que con esta línea se muestra las etiquetas html--}}
            {!!$post->extract!!}
        </div>
    </div>

    <div class="px-6 pt-4 pb-2">
        @foreach ($post->tags as $tag)
            <a href="{{route('posts.tag', $tag)}}" class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm text-gray-700">
                {{$tag->name}}
            </a>
        @endforeach
    </div>
</article>
