<?php
    /**
     * Este es un modelo para nuestro proyecto, sirve para mapear las tablas en BD.
     * Se desechó porque esta se creó de forma manual y él menciona que es mucho mejor
     * utilizar modelos creados con Elocuent
     */


    namespace App\Models;
    /*Él menciona repetidamente una herramienta llamada 'Elocuent, esta herramienta
        seguro nos permitirá hacer este mismo proceso de creación de modelos, sin embargo
        los escribiremos nosotros mismos para aprender su estructura.
     */

    //Estos modelos los usaremos para gestionar los datos (p.ejm en BD)
    class Listing {
        public static function all(){
            return [
                [
                    'id' => 1,
                    'title' => 'Listing One',
                    'description' => 'Eiusmod exercitation cupidatat excepteur excepteur
                    Lorem Lorem nisi minim reprehenderit quis commodo et. Exercitation
                    nulla consequat ut et aliquip ex mollit aute incididunt eu aliquip.
                    Nostrud aliqua cupidatat non deserunt adipisicing.'
                ],
                [
                    'id' => 2,
                    'title' => 'Listing Two',
                    'description' => 'Non duis officia et nulla qui quis quis anim eiusmod.
                    Minim aliqua et id cupidatat Lorem nisi consequat ea veniam. Aute
                    eiusmod elit esse exercitation incididunt culpa exercitation non aliqua
                    ullamco elit eu. Consectetur anim esse minim sit do excepteur ut deserunt
                    minim.'
                ],
            ];
        }

        public static function find($id){
            $listings = self::all();
            foreach($listings as $listing){
                if($listing['id'] == $id){
                    return $listing;
                }
            }
        }


    }
?>
