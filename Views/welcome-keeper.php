<?php
include_once('header.php');
include_once('nav-bar-keeper.php');

?>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h1>Bienvenido a Pet Hero</h1>
        <h2>You are Keeper</h2>
        <img class="img-fluid mb-50" src="https://freshpikk.com/media/avatar/pets_home_banner.png" alt="blog-image">
      </div>
      <div class="col-lg-12">
        <p>Pet Hero es una aplicacion en que
            personas puedan brindar el servicio del cuidado de mascotas. Dicho cuidado se trata de una
            estadía corta a cambio de una remuneración.
           </p>
        <p class="mb-50">Los usuarios que se registren como Keepers, tienen un perfil en el sitio donde
            exponen que tipo de perro están dispuestos a cuidar (pequeño, mediano o grande) y la
            remuneración esperada por la estadía.</p>
        <p class="mb-50">Por otro lado, existe el tipo de usuario Owner que registra un nuevo perfil en la
            aplicación y será quien contrate el servicio de los Keepers. Una vez completado el
            alojamiento del perro, los Owner tienen la habilidad de generar una review sobre el servicio.</p>
        <div class="text-center">
          <img class="img-fluid mb-50" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSz-SnRxK3o0S1JjJLo0G6ULOzmITv7CluLgQ&usqp=CAU" alt="image">
        </div>
        <p> Los Owners deberán crearle un perfil a cada mascota que poseen. Por cada perfil de
            mascota, deben cargar: una foto, raza, tamaño, plan de vacunación (como imagen) y
            observaciones generales de la misma. La aplicación también brinda la oportunidad de subir
            un video del perro.</p>
            <p> Cuando un Owner selecciona un Keeper de su agrado, se generará una reserva en
            el sistema entre las fechas que requiere. El Keeper en cuestión, deberá aceptar o rechazar
            esta nueva reserva.</p>
            <p>
            En caso de que la reserva sea aceptada por el Keeper, se envía un cupón de pago
            al Owner con el 50% del costo del total de la estadía. Al momento de efectuar el pago, la
            reserva queda confirmada.</p>
      </div>
    </div>
  </div>
</section>
                
<?php
include_once('footer.php');
?>