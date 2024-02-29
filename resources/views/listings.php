<!-- Esta es la versión original, con la que empezamos a trabajar. Vamos a crear una copia de este archivo y a ponerle la terminación .blade.php, parece ser un tipo de dato más relacionado con laravel. -->

<h1> <?php echo $heading . "(Original php)"?> </h1>
<?php foreach($listings as $listing):?>
    <h2> <?php echo $listing['title']; ?> </h2>
    <p> <?php echo $listing['description']; ?> </p>
<?php endforeach;?>
