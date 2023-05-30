<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>EasyEats</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
  <link href='css/main.css' rel="stylesheet">
</head>

<body>

  <?php include 'php/components/navbar.php' ?>

  <!-- PREVIEW RESTAURANTS -->
  <section class="average-section" id="restaurantes-preview">

    <div class="section-text-container">
      <div class="restaurantes-section-wrapper">
        <h1 class="section-heading">Restaurantes</h1>
      </div>
    </div>

    <div class="container mt-5">
      <div class="d-flex justify-content-between">
        <h4>Recommended Jobs</h4> <button class="btn btn-sm btn-outline-dark">Apply all</button>
      </div>
      <div class="row mt-2 g-1">
        <div class="col-md-3">
          <div class="card p-2">
            <div class="text-right"> <small>Full Time</small> </div>
            <div class="text-center mt-2 p-3"> <img src="https://img.icons8.com/color/96/000000/google-logo.png"
                width="60" /> <span class="d-block font-weight-bold">UX Designer</span>
              <hr> <span>Google Inc</span>
              <div class="d-flex flex-row align-items-center justify-content-center"> <i class="fa fa-map-marker"></i>
                <small class="ml-1">FA 100, OH, USA</small> </div>
              <div class="d-flex justify-content-between mt-3"> <span>$40,000</span> <button
                  class="btn btn-sm btn-outline-dark">Apply Now</button> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-2">
            <div class="text-right"> <small>Full Time</small> </div>
            <div class="text-center mt-2 p-3"> <img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"
                width="60" /> <span class="d-block font-weight-bold">UX Designer</span>
              <hr> <span>Instagram Inc</span>
              <div class="d-flex flex-row align-items-center justify-content-center"> <i class="fa fa-map-marker"></i>
                <small class="ml-1">FA 104, OH, USA</small> </div>
              <div class="d-flex justify-content-between mt-3"> <span>$38,000</span> <button
                  class="btn btn-sm btn-outline-dark">Apply Now</button> </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card p-2">
            <div class="text-right"> <small>Full Time</small> </div>
            <div class="text-center mt-2 p-3"> <img src="https://img.icons8.com/officel/80/000000/dribbble.png"
                width="60" /> <span class="d-block font-weight-bold">UX Designer</span>
              <hr> <span>Dribbble Inc</span>
              <div class="d-flex flex-row align-items-center justify-content-center"> <i class="fa fa-map-marker"></i>
                <small class="ml-1">FA 280, OH, USA</small> </div>
              <div class="d-flex justify-content-between mt-3"> <span>$24,000</span> <button
                  class="btn btn-sm btn-outline-dark">Apply Now</button> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    
    <!-- <div class="row">
      <div class="col">
        Column
      </div>
      <div class="col">
        Column
      </div>
      <div class="col">
        Column
      </div>
    </div>
    </div> -->
  </section>
  <!-- SCRIPTS -->
  <script type="text/javascript" src="js/navbar-footer.js"></script>
</body>

</html>