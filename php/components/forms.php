<?php

// if ( dummy.value.trim() === '' || dummy.value.trim() === null ){
// 	dummy.classList.add("is-invalid");
// 	return;
// }else{
//    dummy.classList.remove("is-invalid")
// }
echo '
<!-- LOGIN Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">  
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Login</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="php/controlador/logCliente.php" id="loginForm" method="POST">
		  <div class="modal-body">
			<!-- CAMPO EMAIL -->
			  <div class="form-floating mb-3">

				<input type="email" class="form-control" id="inputLogEmail" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
				<label for="inputLogEmail" class="form-label">Endereço de e-mail</label>
				<div class="invalid-feedback">Preencha seu e-mail</div>

			  </div>
			  <!-- CAMPO  SENHA -->
			  <div class="form-floating mb-3">

				<input type="password" class="form-control" id="inputLogSenha" name="inputSenha" placeholder="******">
				<label for="inputLogSenha" class="form-label">Senha</label>
				<div class="invalid-feedback">Preencha sua senha</div>

			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success">Confirmar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	<!-- ==================================================================================== -->
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
				<form id="cadPessoa" action="php/controlador/cadPessoa.php" method="POST">
				<div class="modal-body">
				  
					<div class="form-floating mb-3">
					  <input type="text" class="form-control" id="inputRegNomePessoa" aria-describedby="nomeHelp" name="inputNome" placeholder="Nome Completo">
					  <label for="inputRegNomePessoa" class="form-label">Nome Completo</label>
					  <div class="invalid-feedback">Nome inválido</div>
					</div>
					
					<div class="form-floating mb-3">
					  <input type="text" class="form-control" id="inputRegCPF" aria-describedby="CPFHelp" name="inputCPF" placeholder="CPF" maxlength="11">
					  <label for="inputRegCPF" class="form-label">CPF</label>
					  <span class="form-text">Digite o CPF sem pontuação, ex. 11122233344</span>
					  <div class="invalid-feedback">CPF inválido</div>
					</div>
					
					
					<div class="form-floating mb-3">
					  <input type="email" class="form-control" id="inputRegEmailPessoa" aria-describedby="emailHelp" name="inputEmail" placeholder="exemplo@emailcom">
					  <label for="inputRegEmailPessoa" class="form-label">Endereço de e-mail</label>
					  <div class="invalid-feedback">Email inválido</div>
					</div>
					
					<!-- CAMPO  SENHA -->
					<div class="form-floating mb-3">
					  <input type="password" class="form-control" id="inputRegSenhaPessoa1" name="inputSenha1" placeholder="******">
					  <label for="inputRegSenhaPessoa1" class="form-label">Senha</label>
					  <div class="invalid-feedback">Senha inválida</div>
					</div>
					
					<!-- CONFIRMAR SENHA -->
					<div class="form-floating mb-3">
					  <input type="password" class="form-control" id="inputRegSenhaPessoa2" name="inputSenha2" placeholder="******">
					  <label for="inputRegSenhaPessoa2" class="form-label">Confirmar Senha</label>
					  <div class="invalid-feedback">Senha inválida</div>
					  <span class="form-text">Digite a senha idêntica à anterior</span>
					</div>

					<div class="mb-3 form-check">
						<input type="checkbox" class="form-check-input" id="termosdeservico">
						<label class="form-check-label" for="termosdeservico">Eu concordo com os <a href="termos.php"><b>termos de serviço</b></a></label>
					</div>
			
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
				  <button type="submit" class="btn btn-success">Confirmar</button>
				</div>
				</form>
			  </div>

			  <!-- ==================================================================================== -->
			  <!-- MODAL DA EMPRESA -->
			  <div class="tab-pane fade" id="nav-empresa" role="tabpanel" aria-labelledby="nav-empresa-tab">
				<div class="modal-header">
				  <h5 class="modal-title" id="exampleModalLabel">Cadastro de Empresa</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="php/controlador/cadEmpresa.php" id="cadEmpresa" method="POST">
				<div class="modal-body">

				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="inputRegCPFEmpresa" aria-describedby="CPFHelp" name="inputCPF" placeholder="CPF" maxlength="11">
					<label for="inputRegCPFEmpresa" class="form-label">CPF</label>
					<div class="invalid-feedback">CPF inválido</div>
					<span
					class="form-text">Digite o CPF do dono da empresa</span>
				</div>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="InputRegNomeDonoEmpresa" name="inputNome" aria-describedby="nomeHelp" placeholder="Nome do Dono">
					<label for="InputRegNomeDonoEmpresa" class="form-label">Nome do Dono</label>
					<div class="invalid-feedback">Nome inválido</div>
					<span
					class="form-text">Digite o nome do dono da empresa</span>
				</div>
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="InputRegNomeEmpresa" name="inputNome" aria-describedby="nomeHelp" placeholder="Nome da Empresa">
					<label for="InputRegNomeEmpresa" class="form-label">Nome da Empresa</label>
					<div class="invalid-feedback">Nome inválido</div>
					<span
					class="form-text">Digite o nome fantasia da sua empresa</span>
				</div>
				  
				  <div class="form-floating mb-3">
					<input type="text" class="form-control" id="InputRegCNPJ" name="inputCNPJ" aria-describedby="CNPJHelp" placeholder="CNPJ" maxlength="14">
					<label for="InputRegCNPJ" class="form-label">CNPJ</label>
					<div class="invalid-feedback">CNPJ inválido</div>
				  </div>
				  
				  <div class="row g-2">
					<div class="col-md">
					  <div class="form-floating mb-3">
						<input type="text" class="form-control" id="InputNumAgencia" name="inputAgencia" aria-describedby="numAgenciaHelp" maxlength="4" placeholder="Agência">
						<label for="InputNumAgencia" class="form-label">Agência</label>
						<div class="invalid-feedback">Agencia inválida</div>
						<span
						class="form-text">Insira a sua agência bancária no formato numérico, ex. 1234</span>
					  </div>    
					</div>
					<div class="col-md">
					  <div class="form-floating mb-3">
						<input type="text" class="form-control" id="InputNumConta" name="inputConta" aria-describedby="numContaHelp" placeholder="Número da Conta" maxlength="8">
						<label for="InputNumConta" class="form-label">Número da Conta</label>
						<div class="invalid-feedback">Conta inválida</div>
						<span
						class="form-text">Digite o número da conta para depósitos, 8-9 dígitos</span>
					  </div>    
					</div>
				  </div>
  
				  <div class="form-floating mb-3">
					<input type="email" class="form-control" id="InputRegEmailEmpresa" name="inputEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
					<label for="InputRegEmailEmpresa" class="form-label">Endereço de e-mail</label>
					<div class="invalid-feedback">E-mail inválido</div>
				  </div>
				  
				  <!-- CAMPO  SENHA -->
				  <div class="form-floating mb-3">
					<input type="password" class="form-control" id="InputRegSenhaEmpresa1" name="inputSenha1" placeholder="******">
					<label for="InputRegSenhaEmpresa1" class="form-label">Senha</label>
					<div class="invalid-feedback">Senha inválida</div>
				  </div>
				  
				  <!-- CONFIRMAR SENHA -->
				  <div class="form-floating mb-3">
					<input type="password" class="form-control" id="InputRegSenhaEmpresa2" name="inputSenha2" placeholder="******">
					<label for="InputRegSenhaEmpresa2" class="form-label">Confirmar Senha</label>
					<div class="invalid-feedback">Senha inválida</div>
					<span
					class="form-text">Digite a senha idêntica à anterior</span>
				  </div>

				  <div class="mb-3 form-check">
					<input type="checkbox" class="form-check-input" id="termosdeservico">
					<label class="form-check-label" for="termosdeservico">Eu concordo com os <a href="termos.php"><b>termos de serviço</b></a></label>
				  </div>
	  
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
				  <button type="submit" class="btn btn-success">Confirmar</button>
				</div>
				</form>
			  </div>
			</div>
		</div>
	  </div>
	</div>
	
	<!-- CONTATO MODAL -->
	<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">  
		  <div class="modal-header">
			<h5 class="modal-title" id="ModalLabel">Contato</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		  </div>
		  <form action="php/controlador/contato.php" id="contactForm" method="POST">
		  <div class="modal-body">
			<!-- CAMPO EMAIL -->
			  <div class="form-floating mb-3">
				<input type="email" class="form-control" id="inputContactEmail" name="inputContactEmail" aria-describedby="emailHelp" placeholder="exemplo@emailcom">
				<label for="inputContactEmail" class="form-label">Endereço de e-mail</label>
			  </div>
			  <div class="form-floating mb-3">
				<input type="text" class="form-control" id="inputContactNomePessoa" aria-describedby="nomeHelp" name="inputNomeContato" placeholder="Nome Completo">
				<label for="inputContactNomePessoa" class="form-label">Nome</label>
			  </div>
			  <div class="form-floating mb-3">
			  	<textarea type="text" class="form-control" id="inputContactMensagem" aria-describedby="MensagemHelp" name="inputMensagemContato" placeholder="Insira sua mensagem aqui"></textarea>
				<label for="inputContactMensagem" class="form-label">Mensagem</label>
			  </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
			<button type="submit" class="btn btn-success">Confirmar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	
	';
?>