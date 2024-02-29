<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Models\Listing; //Una vez creado nuestro modelo lo utilizamos para suministrar la data

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Common Resource Routes:
// index    -   Show all listings
// show     -   Show single listening
// create   -   Show form to create new listing
// store    -   Store new listing
// edit     -   Show form to edit listing
// update   -   Update listing
// destroy  -   Delete listing

//Listing Routes

//All Listings
Route::get('/', [ListingController::class, 'index']);   //2do para, 1. nombre de la clase y 2. nombre del método definido en la clase

//Show create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Show Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage']);

//Store Listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');


//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

//Single Listings - Es importante dejar esta de últimas porque si no interpreta que lo que haya despues de listings/ es un parámetro
Route::get('/listings/{listing}', [ListingController::class, 'show']);






//Users Routes

//Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');    //guest de invitado

//Create New User
Route::post('/users', [UserController::class, 'store']);

//Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Log User In
Route::post('/users/authenticate',[UserController::class, 'authenticate']);














//Estas son las peticiones HTTP que podemos ejecutar mediante unas rutas especificadas

/* Ejercicio listings */
//Esta ruta la definimos para abrir el home de nuestras URL '/'
//Vamos a utilizar algo denominado como rout model binding, es decir, pasar parámetros mediante el routing
// All listing
/*
Route::get('/', function () { //En nuestro ejemplo cambiamos el nombre del script de bienvenida (en la carpeta views) de welcome a listings, por ello la cambiamos acá también.
    return view('listings', [       //Este segundo parámetro serán variables que podemos enviar a la hora de redirigirnos a la ruta especificada.
        'heading' => 'Latest Listings',
        'listings' => Listing::all(),
    ]);
});
*/

//Single listing
/*Esta es la versión 2 - Esta versión no la entiendo mucho porque igualmente pasamos solo el id, no todo el objeto listing mediante la url*/
/*
Route::get('/listings/{listing}', function(Listing $listing){
    return view('listing', [
        'listing' => $listing,
    ]);
});
*/

/*Esta es la versión 1
Route::get('/listings/{id}', function($id){
    $listing = Listing::find($id);
    if(isset($listing)){
        return view('listing', [
            'listing' => $listing,
        ]);
    } else{
        abort('404');
    }
});
*/

//Vamos a crear una
Route::get('/hello', function(){
    //return response("<h1>Hello world from Laravel</h1>");  //El método response nos ayuda a gestionar las respuestas HTTP, dependiendo del tipo de respuesta que se reciba (por defecto tiene como status 200)
    //return response("<h1>Hello world from Laravel</h1>", 400);  //Cambiamos el status a 400, mira el inspector del navegador, ve a network y verifica la respuesta que recibes
    return response("<h1>Hello world from Laravel</h1>")    //Tambien podemos añadir headers a la request
        ->header('Content-type', 'text/plain')
        ->header('foo', 'bar');
});

//Crearemos otro tipo de petición, en este caso que se pase un parámetro 'id'
//Pondremos un constaint para que no se pueda poner cualquier tipo de dato en le parámetro id, para ello vamos hasta el final del mismo parámetro de clase (antes del ;)
//try /posts/14
Route::get('/posts/{id}', function($id){
    dd($id);                                    //dd - die and debug es un método que nos ayudará en el proceso de debuggin, esto detendrá la ejecución y muestra en pantalla (navegador) el valor que se desea consultar, en este caso será la var $id
    ddd($id);                                   //ddd - dump, die and debug es similar al anterior pero presenta más ayudas y toda una interfaz gráfica para hacer debugging
    return response('Post '. $id);
}) -> where('id', '[0-9]+');                    //Utiliza regex, ahora si usas la URL para hacer la petición y no pasas valores numéricos verás que retorna un error 404 NOT FOUND


//Vamos a crear otra petición que use query params
//Try '/search?name=Angel&city=Soatá'
Route::get('/search', function(Request $request){
    //dd($request);
    return $request->name . ' ' . $request->city;
});



