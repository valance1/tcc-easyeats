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

  var modals =`
  <!-- LOGIN Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          
          <h5 class="modal-title" id="ModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          
        </div>
        <form action="" method="POST">
        <div class="modal-body">
          <!-- CAMPO EMAIL -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
              <label for="InputEmail" class="form-label">Endereço de e-mail</label>
            </div>
            <!-- CAMPO  SENHA -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="inputSenha" placeholder="******">
              <label for="inputSenha" class="form-label">Senha</label>
              <!-- TEM QUE BOTAR UM BOTÃO DE "ESQUECI MINHA  SENHA" -->
            </div>
            
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-primary">Confirmar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <!--CADASTRO Modal -->
  <div class="modal fade" id="cadastroModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">

            <button class="nav-link active" id="nav-pessoa-tab" data-bs-toggle="tab" data-bs-target="#nav-pessoa" type="button" role="tab" aria-controls="nav-pessoa" aria-selected="true">Pessoa</button>

            <button class="nav-link" id="nav-empresa-tab" data-bs-toggle="tab" data-bs-target="#nav-empresa" type="button" role="tab" aria-controls="nav-empresa" aria-selected="false">Empresa</button>

          </div>
        </nav>
          <div class="tab-content" id="nav-tabContent">
            <!-- MODAL DE CLIENTE -->
            <div class="tab-pane fade show active" id="nav-pessoa" role="tabpanel" aria-labelledby="nav-pessoa-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="php/controlador/cadPessoa.php" method="POST">
              <div class="modal-body">
                
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputNome" name="inputNome" aria-describedby="nomeHelp" placeholder="Nome Completo">
                    <label for="inputNome" class="form-label">Nome Completo</label>
                  </div>
                  
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="inputCPF" name="inputCPF" aria-describedby="CPFHelp" placeholder="CPF">
                    <label for="inputCPF" class="form-label">CPF</label>
                  </div>
                  
                  
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="InputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
                    <label for="InputEmail" class="form-label">Endereço de e-mail</label>
                  </div>
                  
                  <!-- CAMPO  SENHA -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="inputSenha1" name="inputSenha1" placeholder="******">
                    <label for="inputSenha1" class="form-label">Senha</label>
                  </div>
                  
                  <!-- CONFIRMAR SENHA -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="InputSenha2" name="inputSenha2" placeholder="******">
                    <label for="InputSenha2" class="form-label">Confirmar Senha</label>
                  </div>
          
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
              </div>
              </form>
            </div>

            <!-- MODAL DA EMPRESA -->
            <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Empresa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="" method="POST">
              <div class="modal-body">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="InputNome2" aria-describedby="nomeHelp" placeholder="Nome Completo">
                  <label for="InputNome2" class="form-label">Nome Completo</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="InputCNPJ1" aria-describedby="CNPJHelp" placeholder="CNPJ">
                  <label for="InputCNPJ1" class="form-label">CNPJ</label>
                </div>
                
                <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumAgencia" aria-describedby="numAgenciaHelp" placeholder="Agência">
                      <label for="numAgencia" class="form-label">Agência</label>
                    </div>    
                  </div>
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumConta" aria-describedby="numContaHelp" placeholder="Número da Conta">
                      <label for="inputNumConta" class="form-label">Número da Conta</label>
                    </div>    
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
                  <label for="InputEmail" class="form-label">Endereço de e-mail</label>
                </div>
                
                <!-- CAMPO  SENHA -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="inputSenha" placeholder="******">
                  <label for="inputSenha" class="form-label">Senha</label>
                </div>
                
                <!-- CONFIRMAR SENHA -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="InputSenha2" placeholder="******">
                  <label for="InputSenha2" class="form-label">Confirmar Senha</label>
                </div>
    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
              </div>
              </form>
            </div>
          </div>
      </div>
    </div>
  </div>
	`;
	document.body.innerHTML = header + modals + document.body.innerHTML + footer;
}
window.addEventListener("load", createHeaderAndFooter);
