<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;

//Esta clase es para poblar las tablas de nuestra BD, utiliza los elementos que hay en factories
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Crea 10 dummy users (datos de 10 usuarios generados de forma aleatoria)
        // \App\Models\User::factory(10)->create();

        //En la parte final del curso, el tutor decidió crear un solo usuario y asignarle a él todos listings que ya tenemos creados.
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ]);

        // \App\Models\User::factory()->create([
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]);

        /* Opción 2 para seeder de Listing: solo aplica una vez hayamos creado nuestro
        archivo ListingFactory*/
        Listing::factory(6)->create([
            'user_id' => $user->id,
        ]);

        //De la siguiente manera vamos a crear un seeder para nuestra clase Listing
        /* Opción 1 para seeder de Listing
        Listing::create([
            'title' => 'Laravel Senior Developer',
            'tags' => 'laravel, javascript',
            'company' => 'Acme Corp',
            'location' => 'Boston, MA',
            'email' => 'email1@email.com',
            'website' => 'https://www.acme.com',
            'description' => 'Pariatur tempor ad reprehenderit tempor excepteur ad
            quis quis minim aliqua officia sit sunt. Adipisicing voluptate mollit
            aliquip quis mollit qui magna ullamco culpa et. Nisi amet enim voluptate
            labore quis. Officia et ullamco pariatur Lorem deserunt voluptate veniam ad
            tempor non est fugiat. Dolor sunt magna enim non officia laborum in nulla
            sint laborum proident amet ullamco. Minim aute reprehenderit eu ad laboris
            exercitation mollit. Sint enim sunt exercitation nisi in aute fugiat officia
            tempor mollit aute irure.'
        ]);

        Listing::create([
            'title' => 'Full-Stack Engineer',
            'tags' => 'laravel, backend, API',
            'company' => 'Stark Industries',
            'location' => 'New York, NY',
            'email' => 'email2@email.com',
            'website' => 'https://www.starkindustries.com',
            'description' => 'Deserunt do dolore ea quis ad aliqua eiusmod velit
            consectetur. Duis aliqua fugiat aliqua velit cupidatat veniam ad voluptate
            commodo magna minim et. Proident do pariatur sunt amet Lorem excepteur.
            Nulla laboris commodo ut velit eu aliquip elit ut in. Voluptate aliqua dolor
            commodo et.'
        ]);
        */

    }
}
