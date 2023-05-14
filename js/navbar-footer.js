function createHeaderAndFooter() {
	var header = `
	<nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding-right: 150px; padding-left: 150px">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">EasyEats</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">

        <!-- LEFT SIDE -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="restaurantes.html">Restaurantes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">Contato</a>
          </li>
        </ul>

        <!-- RIGHT SIDE -->
        <ul class="navbar-nav me-auto"></ul>
          <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#loginModal">
              Login
            </button>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cadastroModal">
              Cadastrar
            </button>
          </li>
        </ul>
        
      </div>
    </div>
  </nav>
	`;

	var footer = `
	`;
	document.body.innerHTML = header + document.body.innerHTML + footer;
}
window.addEventListener("load", createHeaderAndFooter);
