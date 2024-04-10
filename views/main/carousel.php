<section>
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h2 class="text-center fs-3 p-3 m-0">Топ записи</h2>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide">
               <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
               </div>
               <div class="carousel-inner">
                  <?php if (!empty($allPostByTopCategories)) : ?>
                     <?php $count = 1; ?>
                     <?php foreach($allPostByTopCategories as $postByTopCategories) : ?>
                        <?php if ($count == 1) : ?>
                           <div class="carousel-item active">
                              <img src="<?= BASE_URL . '/assets/img/posts/' . $postByTopCategories['posts_image']; ?>" class="d-block w-100" alt="...">
                           </div>
                        <?php else : ?>
                           <div class="carousel-item">
                              <img src="<?= BASE_URL . '/assets/img/posts/' . $postByTopCategories['posts_image']; ?>" class="d-block w-100" alt="...">
                           </div>
                        <?php endif; ?>
                        <?php $count++ ?>
                     <?php endforeach; ?>
                  <?php else: ?>
                     <div class="carousel-item active">
                        <img src="<?= BASE_URL . '/assets/img/wallpaperflare.com_wallpaper.jpg'; ?>" class="d-block w-100" alt="...">
                     </div>
                  <?php endif; ?>
               </div>
               <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
               </button>
               <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
               </button>
            </div>
         </div>
      </div>
   </div>
</section>