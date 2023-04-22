function createHeaderAndFooter() {
	var header = `<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="wrap-menu-header gradient1 trans-0-4">
			<div class="container h-full">
				<div class="wrap_header trans-0-3">
					<!-- Logo -->
					<div class="logo">
						<a href="index.html">
							<img src="images/logos/LOGOBIG.png" alt="IMG-LOGO"
								data-logofixed="images/logos/logoBIG2.png">
						</a>
					</div>
	
					<!-- Menu -->
					<div class="wrap_menu p-l-45 p-l-0-xl">
						<nav class="menu">
							<ul class="main_menu">
								<li>
									<a href="index.html">Home</a>
								</li>
	
								<li>
									<a href="#">Restaurantes</a>
								</li>
	
								<li>
									<a href="#">Suporte</a>
								</li>
	
								<!-- <li>
									<a href="gallery.html">Gallery</a>
								</li> -->
	
								<li>
									<a href="#">Sobre nós</a>
								</li>
	
								<!-- <li>
									<a href="blog.html">Blog</a>
								</li> -->
	
								<li>
									<a href="#">Contato</a>
								</li>
								<button type="button" class="btn4 flex-c-m size39 txt4 trans-0-4 m-10"
									data-bs-toggle="modal" data-bs-target="#logarModal">
									Logar
								</button>
								<button type="button" class="btn5 flex-c-m size39 txt4 trans-0-4 m-10"
									data-bs-toggle="modal" data-bs-target="#registrarModal">
									Registrar
								</button>
	
							</ul>
						</nav>
					</div>
					<!-- Social -->
					<div class="social flex-w flex-l-m p-r-20">
						<a href="#"><i class="fa fa-facebook m-l-21" aria-hidden="true"></i></a>
						<a href="#"><i class="fa fa-twitter m-l-21" aria-hidden="true"></i></a>
	
						<button class="btn-show-sidebar m-l-33 trans-0-4"></button>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- Sidebar -->
	<aside class="sidebar trans-0-4">
		<!-- Button Hide sidebar -->
		<button class="btn-hide-sidebar ti-close color0-hov trans-0-4"></button>

		<!-- - -->
		<ul class="menu-sidebar p-t-95 p-b-70">
			<li class="t-center m-b-13">
				<a href="#" class="txt19">Iníco</a>
			</li>


			<li class="t-center m-b-13">
				<a href="#" class="txt19">Sobre nós</a>
			</li>


			<li class="t-center m-b-13">
				<a href="#" class="txt19">Contato</a>
			</li>

			<li class="t-center">
				<!-- Button3 -->
				<a href="#l" class="btn3 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
					Restaurantes
				</a>
			</li>
		</ul>

		<!-- - -->
		<div class="t-center p-l-60 p-r-60 p-b-40">

			<h4 class="txt20 m-b-33">
				Usuário
			</h4>

			<li class="t-center m-b-13">
				<button type="submit" class="btn6 flex-c-m size13 txt11 trans-0-4 m-l-r-auto">
					Logar
				</button>
			</li>
			<li class="t-center  m-b-13">
				<button type="submit" class="btn6 flex-c-m size13
				trans-0-4 txt11 m-l-r-auto">
					Registrar
				</button>
			</li>
			<!-- - -->
			<!-- <h4 class="txt20 m-b-33">
				Gallery
			</h4> -->

			<!-- Gallery -->
			<!-- <div class="wrap-gallery-sidebar flex-w">
				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-01.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-01.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-02.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-02.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-03.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-03.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-05.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-05.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-06.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-06.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-07.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-07.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-09.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-09.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-10.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-10.jpg" alt="GALLERY">
				</a>

				<a class="item-gallery-sidebar wrap-pic-w" href="images/photo-gallery-11.jpg" data-lightbox="gallery-footer">
					<img src="images/photo-gallery-thumb-11.jpg" alt="GALLERY">
				</a>
			</div> -->
		</div>
	</aside>
	`;

	var footer = `	<!-- Footer -->
	<footer class="bg1">
	<div class="container p-t-40 p-b-70">
				<div class="row justify-content-between">
					<div class="col-sm-6 col-md-4 p-t-50">
						<!-- - -->
						<h4 class="txt13 m-b-33">
							Entre em contato
						</h4>
	
						<ul class="m-b-70">
							<li class="txt14 m-b-14">
								<i class="fa fa-map-marker fs-16 dis-inline-block size19" aria-hidden="true"></i>
								Santa Margarida
							</li>
	
							<li class="txt14 m-b-14">
								<i class="fa fa-phone fs-16 dis-inline-block size19" aria-hidden="true"></i>
								+55 27 99999-9999
							</li>
	
							<li class="txt14 m-b-14">
								<i class="fa fa-envelope fs-13 dis-inline-block size19" aria-hidden="true"></i>
								cardapiodigital@gmail.com
							</li>
						</ul>
	
	
					</div>
	
					<div class="col-sm-6 col-md-4 p-t-50">
						<!-- - -->
						<h4 class="txt13 m-b-32">
							Horários de Atendimento
						</h4>
	
						<ul>
							<li class="txt14">
								09:30 – 18:00
							</li>
	
							<li class="txt14">
								De segunda as sextas
							</li>
						</ul>
					</div>
	
	
	
					<!-- <div class="col-sm-6 col-md-4 p-t-50">
						<h4 class="txt13 m-b-38">
							Gallery
						</h4>
	
						<div class="wrap-gallery-footer flex-w">
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-01.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-01.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-02.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-02.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-03.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-03.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-04.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-04.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-05.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-05.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-06.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-06.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-07.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-07.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-08.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-08.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-09.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-09.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-10.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-10.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-11.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-11.jpg" alt="GALLERY">
							</a>
	
							<a class="item-gallery-footer wrap-pic-w" href="images/photo-gallery-12.jpg" data-lightbox="gallery-footer">
								<img src="images/photo-gallery-thumb-12.jpg" alt="GALLERY">
							</a>
						</div>
	
					</div> -->
				</div>
			</footer>
	`;
	document.body.innerHTML = header + document.body.innerHTML + footer;
}
window.addEventListener("load", createHeaderAndFooter);
