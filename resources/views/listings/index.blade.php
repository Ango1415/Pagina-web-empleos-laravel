<x-layout>
    @include('partials._hero')
    @include('partials._search')
    <!-- Este script ya es de tipo blade.php. La diferencia entre el original y este es que
        podemos utilizar signos diferentes en lugart de las etiquetas y sintaxis de php,
        esto se hace para tener un código más limpio y entendible.
        También podemos hacer uso de directivas propias de laravel, útiles por ejemplo para hacer loops.
    -->

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        {{--
        <h1> {{ $heading }} </h1>

        @php // Bloque de códgio php
        $test = 1;
        @endphp
        Result: {{ $test }}

        @if(count($listings) == 0)      <!--Condicinales-->
            <p>NO LISTINGS FOUND</p>
            @endif
        --}}

        <!-- Hay otro tipo de condicionales, muy similar a if, su nombre es unless -->
        <!--este parece ser al contrario del if, si la condición es falsa entra al bloque, es decir, se entendería, ejecute esto 'a menos que' esto sea verdadero -->
        @unless(count($listings) == 0)
            @foreach($listings as $listing) <!--Esto es una directiva-->
                {{-- Esto hace parte del ejemplo inicial del curso
                <h2>
                    <a href="/listings/{{ $listing['id'] }}">
                        {{ $listing['title'] }}
                    </a>
                </h2>
                <p> {{ $listing['description'] }} </p>
                --}}

                <x-listing-card :listing="$listing"/>

            @endforeach
        @else
            <p>NO LISTINGS FOUND</p>
        @endunless
    </div>

    <div class="mt-6-p-4">
        {{ $listings ->links() }}
    </div>

</x-layout>
