<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Extiende de la clase Model de Elocuent, por si misma esta clase ya tiene implementada
 * mucha funcionalidad, como los métodos 'all()' y 'find()'
 */

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags', 'logo', 'user_id'];  //Se añaden estos filleable como parámetro necesario para enviar datos desde el formulario de creación de listings

    public function scopeFilter($query, array $filters){
        //dd($filters['tag']);
        if($filters['tag'] ?? false){   //Esto es para hacer el filtrado de listings por los tags, ?? esto lo entendí como si: filters tags NO ES falso
            $query->where('tags', 'like', '%'.request('tag').'%');
        }

        if($filters['search'] ?? false){    //Esto es para el filtro por la barra de búsqueda
            $query  ->where('title', 'like', '%'.request('search').'%')
                    ->orWhere('description', 'like', '%'.request('search').'%')
                    ->orWhere('tags', 'like', '%'.request('search').'%');
        }
    }

    //Vamos a relacionar los modelos de Listing y User
    public function user(){
        //La relación que vamos a contruir será ' listing belongs to user'
        return $this->belongsTo(User::class, 'user_id'); //Ponemos el nombre de la clase y el identificador de la misma (no sé si sea el campo en la tabla users o en la tabla listings :/) para poder hacer la relación
    }
}
