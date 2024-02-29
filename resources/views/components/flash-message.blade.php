@if(session()->has('message'))
    <div
        {{-- Estas propiedades son posibles gracias al framework apline.js, buscalo así en google, para usarlo simplemente hay que agregar el CDN (link o script) en la página principal (en nuestro caso será layout) --}}
        x-data="{show: true}"   {{--Objeto con datos para el div--}}
        x-init="setTimeout(() => show=false, 3000)" {{--pasamos func lambda que queremos que se ejecute despues de 3000 ms, 3s--}}
        x-show="show"   {{-- valor en el que se basará la propiedad x-show, esta es la misma del objeto, que cambiará con la func lamba luego de 3s --}}
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel
                text-white px-48 py-3"
    >
        <p>
            {{ session('message') }}
        </p>
    </div>
@endif
