@extends('layouts.app')

@section('content')
    <div>
        <div class="w-[25rem] h-[7rem] ml-[8rem]"
            style="
            background-image: url('{{asset('storage/texturas/newPost.png')}}');
            background-size: 100% 100%;
            background-repeat: no-repeat; 
            background-attachment: local;
            background-position: center;
            "
        >
            <svg width="300" height="80" viewBox="0 0 300 200">
                <path id="wave" 
                    d="M 0,140 Q 152.5,70 460,100" 
                    fill="transparent" />
                <text font-size="58" fill="currentColor" font-weight="600" dominant-baseline="middle" letter-spacing="1.5">
                    <textPath href="#wave" startOffset="50%" text-anchor="middle" style="font-family: 'Playfair Display'">
                        Crear nuevo post
                    </textPath>
                </text>
            </svg>
            {{-- <h1>Crear nuevo post</h1> --}}
        </div>
    
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="bg-yellow-300 h-[26rem] w-[46rem] flex flex-col items-center"
            style="
                background-image: url('{{asset('storage/texturas/CreatePost.png')}}');
                background-size: 100% 100%;
                background-repeat: no-repeat; 
                background-attachment: local;
                background-position: center;
            ">
                <div class="flex flex-col">
                    <label class="text-center mt-6" for="title" style="font:family:fantasy;">Título</label>
                    <input class="p-0 border-0 border-b-2 border-b-black mb-4 bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-b-yellow-600"
                    style="box-shadow: 2px 4px 0 0 rgba(0,0,0,0.35);"
                    type="text" name="title" id="title" required>
                </div>
        
                <div class="flex">
                    <div class="flex items-center">
                        <label class="mr-4" for="content">Contenido</label>
                        <textarea class="bg-transparent mb-4 border-0 border-t-4 border-r-2 border-t-black border-r-black focus:outline-none focus:ring-0 focus:border-t-2 focus:border-r-1 focus:border-t-yellow-600 focus:border-r-yellow-600" name="content" id="content" rows="5" required
                        style="box-shadow: inset 0 5px 10px 0 rgba(0,0,0,0.35);"
                        ></textarea>
                    </div>
            
                    <div class="ml-4 flex flex-col">
                        <label class="mt-4 mb-4" for="category_id">Categoría</label>
                        <select class="bg-transparent border-0 border-t-4 border-r-2 border-t-black border-r-black focus:outline-none focus:ring-0 focus:border-t-2 focus:border-r-1 focus:border-t-yellow-600 focus:border-r-yellow-600" name="category_id" id="category_id" required
                        style="box-shadow: inset 0 5px 10px 2px rgba(0,0,0,0.35);"
                        >
                            <option value="">Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="flex gap-2">
                    <div class="flex flex-col">
                        <label for="poster">Subir Imagen</label>
                        <input class="block w-full text-sm text-gray-700
                        file:mr-4 file:py-2 file:px-4
                        file:rounded file:border-0 file:border-b-2 border-b-blac
                      file:bg-amber-300 file:text-black
                     hover:file:bg-yellow-500" type="file" name="poster" id="poster" accept="image/*">
                    </div>
                    <div class="flex flex-col">
                        <p class="mt-2 text-sm font-bold text-gray-700">O pegá un enlace:</p>
                        <input type="url" name="poster_url" id="poster_url" value="{{ old('poster_url', $post->poster_url ?? '') }}" class="p-0 border-0 border-b-2 border-b-black mb-4 bg-transparent focus:outline-none focus:ring-0 focus:border-b-2 focus:border-b-yellow-600"
                        style="box-shadow: 2px 4px 0 0 rgba(0,0,0,0.35);">
                    </div>
                </div>
        
                
                <button type="submit" class="border-2 border-black px-2 py-1">Publicar</button>
            </div>
        </form>
    </div>
@endsection
