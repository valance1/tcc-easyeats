function createHeaderAndFooter() {
	var header = `
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
        <form action="php/controlador/logCliente.php" method="POST">
        <div class="modal-body">
          <!-- CAMPO EMAIL -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="inputEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
              <label for="inputEmail" class="form-label">Endereço de e-mail</label>
            </div>
            <!-- CAMPO  SENHA -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="inputSenha" name="inputSenha" placeholder="******">
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
                    <input type="text" class="form-control" id="InputNome1" aria-describedby="nomeHelp" name="inputNome" placeholder="Nome Completo">
                    <label for="InputNome1" class="form-label">Nome Completo</label>
                  </div>
                  
                  <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="InputCPF1" aria-describedby="CPFHelp" name="inputCPF" placeholder="CPF">
                    <label for="InputCPF1" class="form-label">CPF</label>
                  </div>
                  
                  
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" name="inputEmail" placeholder="exemplo@emailcom">
                    <label for="InputEmail1" class="form-label">Endereço de e-mail</label>
                  </div>
                  
                  <!-- CAMPO  SENHA -->
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="InputSenha1" name="inputSenha1" placeholder="******">
                    <label for="InputSenha1" class="form-label">Senha</label>
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
              <form action="php/controlador/cadEmpresa.php" method="POST">
              <div class="modal-body">
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="InputNome2" name="inputNome" aria-describedby="nomeHelp" placeholder="Nome Completo">
                  <label for="InputNome2" class="form-label">Nome Completo</label>
                </div>
                
                <div class="form-floating mb-3">
                  <input type="number" class="form-control" id="InputCNPJ1" name="inputCNPJ" aria-describedby="CNPJHelp" placeholder="CNPJ">
                  <label for="InputCNPJ1" class="form-label">CNPJ</label>
                </div>
                
                <div class="row g-2">
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumAgencia" name="inputAgencia" aria-describedby="numAgenciaHelp" placeholder="Agência">
                      <label for="numAgencia" class="form-label">Agência</label>
                    </div>    
                  </div>
                  <div class="col-md">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="InputNumConta" name="inputConta" aria-describedby="numContaHelp" placeholder="Número da Conta">
                      <label for="inputNumConta" class="form-label">Número da Conta</label>
                    </div>    
                  </div>
                </div>

                <div class="form-floating mb-3">
                  <input type="email" class="form-control" id="InputEmail1" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
                  <label for="InputEmail1" class="form-label">Endereço de e-mail</label>
                </div>
                
                <!-- CAMPO  SENHA -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="InputSenha1" name="inputSenha1" placeholder="******">
                  <label for="InputSenha1" class="form-label">Senha</label>
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
          </div>
      </div>
    </div>
  </div>
	`;
	document.body.innerHTML = modals + document.body.innerHTML + footer;
}
window.addEventListener("load", createHeaderAndFooter);
