
  <div id="top"></div>


  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="cont-slider">
          <img class="d-block w-100" src="img/slider.jpg" alt="slider" style="max-height: 200px; width: auto; object-fit: cover; filter: brightness(50%);">
          <h1 class="center-slider">Galeria</h1>
        </div>
      </div>
    </div>
  </div>

  <div id="content" style="">
  <form action="actions/save.php" method="post">
    <div id="easyPaginate">

    <?php 
      require 'actions/database/images.php';
      foreach ($img as $image) {

          if (isset($_SESSION['saved'])) {

            if (in_array($image['title'], $_SESSION['saved']))
              $checked = 'checked';
            else
              $checked = '';

          }

          if ($img != '')

            echo '<figure class="figure" style="margin: 10px;">
                    <a href="img/upload/' . $image['title'] . '"><img src="img/mini/' . $image['title'] . '" class="figure-img img-fluid img-thumbnail" alt="img"></a>
                    <figcaption class="figure-caption">Nazwa: '. $image['title'] .'</figcaption>
                    <figcaption class="figure-caption">Autor: '. $image['author'] .'</figcaption>
                    <figcaption class="figure-caption"><input type="checkbox" name="' . $image['title'] . '" id="img/mini/' . $image['title'] . '" '. $checked .'><label for="img/mini/' . $image['title'] . '" style="margin:5px;"> Zapamiętaj</label></figcaption>
                  </figure>';

          //echo '<a href=><img src="img/mini/' . $image . '" class="img-responsive img-thumbnail" alt="img"></a>';
      }
    ?>
    </div>
    <br>
    <input type="submit" value="Zapamiętaj" class="btn btn-secondary">

  </form>

 </div>

 <style type="text/css">
  #easyPaginate {width:100%;}
  #easyPaginate img {display:inline;margin-bottom:10px;}
  .easyPaginateNav a {padding:5px;}
  .easyPaginateNav a.current {font-weight:bold;text-decoration:underline;}
 </style>

 <script type="text/javascript" src="assets/js/easyPagination.js"></script>
 <script type="text/javascript">

   $('#easyPaginate').easyPaginate({
      paginateElement: 'figure',
      elementsPerPage: 5,
      effect: 'default'
  });
   
 </script>