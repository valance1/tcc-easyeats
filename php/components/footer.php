<?php
error_reporting(0);

echo '<section class="footerSection" id="footer">
  <footer class="footer d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
    <p class="col-md-4 mb-0">© 2023 EasyEats LTDA</p>

    <ul class="nav col-md-4 justify-content-end">
      <li class="nav-item"><a href="index.php" class="nav-link px-2">Home</a></li>
      <li class="nav-item"><a href="restaurantes.php" class="nav-link px-2">Restaurantes</a></li>
      <li class="nav-item"><button type="button" class="btn nav-link px-2" id="contactModalOpenButton" data-bs-toggle="modal" data-bs-target="#contactModal" style="color: #fff !important;" >Contato</button></li>
    </ul>
  </footer>
</section>';
?>