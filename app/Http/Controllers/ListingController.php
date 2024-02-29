<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;

class ListingController extends Controller
{
    //Common Resource Routes:
    // index    -   Show all listings
    // show     -   Show single listening
    // create   -   Show form to create new listing
    // store    -   Store new listing
    // edit     -   Show form to edit listing
    // update   -   Update listing
    // destroy  -   Delete listing


    // Show filtered listings
    public function index(){
        //dd(request());
        //dd(request('tag'));

        /*  Esto me retornará todos los datos y me los desplegará sobre la página
        return view('listings.index', [
            // Hay otra manera similar de hacer lo mismo y nos permitirá usar la func filter que acabamos de crear
            //'listings' => Listing::all(),
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get(),
        ]);
        */

        /* Hace lo mismo que el bloque anterior pero me retorna los resultados paginados.*/
        //dd( Listing::latest()->filter(request(['tag', 'search']))->get() );
        return view('listings.index', [
            'listings' => Listing::latest()
                                        ->filter(request(['tag', 'search']))
                                        ->paginate(6), //Otra opción es usar 'simplePaginate()' en lugar de 'paginate()'
                                    ]);

    }

    // Show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            'listing' => $listing,
        ]);
    }

    //Show create form
    public function create(){
        return view('listings.create');
    }


    //Store listing data
    public function store(Request $request){
        //dd($request->file('logo'));
        $formFields = $request->validate([ //Proceso de validación de datos
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //Verificamos que el logo para el listing haya sido añadido
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        //Verificamos el usuario al que vamos a relacionar con el listing creado
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        //flash messages: Mensajes almacenados en el propio navegador
        //Session::flash('message', 'Listing Created');

        // El with es otra forma de pasar flash messages
        return redirect('/')->with('message', 'Listing created successfuly');
    }

    //Show Edit Form
    public function edit(Listing $listing){
        //dd($listing->title);
        return view('listings.edit', ['listing' => $listing]);
    }

    //Update listing data
    public function update(Request $request, Listing $listing){
        //dd($request->file('logo'));

        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([ //Proceso de validación de datos
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        //Verificamos que el logo para el listing haya sido añadido
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
        return back()->with('message', 'Listing updated successfuly!!!');
    }

    //Delete listing data
    public function destroy(Listing $listing){
        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfuly!!!');
    }

    //Manage Listings
    public function manage(){
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}

