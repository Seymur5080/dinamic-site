<section class="blog py-5">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <h2 class="fs-4">Последние публикации</h2>
         </div>
      </div>
      <div class="row pt-3">
         <div class="col-12 col-md-9 dinamic-blogs">
            <?php if (!empty($allPosts)) : ?>
               <?php foreach ($allPosts as $post) : ?>
                  <div class="row mb-3">
                     <div class="col-12 col-md-4">
                        <img src="<?= BASE_URL . 'assets/img/posts/' . $post['image']; ?>" class="img-thumbnail" alt="Lambo" style="max-height: 210px; width: 100%; height:100%; object-fit: cover;">
                     </div>
                     <div class="col-12 col-md-8">
                        <div class="box bg-white">
                           <h3>
                              <a href="<?= BASE_URL . 'views/main/single-blog.php?id=' . $post['id']; ?>" class="title">
                                 <?= (strlen($post['name']) > 20) ? mb_substr($post['name'], 0, 20, 'UTF-8') . '...' : $post['name']; ?>
                              </a>
                           </h3>
                           <p>
                              <?= (strlen($post['description']) > 250) ? mb_substr($post['description'], 0, 250, 'UTF-8') . '...' : $post['description']; ?>
                           </p>
                           <div class="d-flex justify-content-between align-items-center">
                              <div class="author">
                                 <i class="fa-solid fa-user"></i> <?= $post['username']; ?>
                              </div>
                              <div class="date">
                                 <i cдlass="fa-solid fa-calendar-days pe-2"></i>
                                 <?= date("d-m-Y H:i:s", strtotime($post['created_at'])); ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               <?php endforeach; ?>
            <?php else : ?>
               <div class="row mb-3">
                  <div class="col-12">
                     <h3 class="fs-5 text-center text-danger m-0">Нет информации</h3>
                  </div>
               </div>
            <?php endif; ?>
         </div>
         <div class="col-12 col-md-3">
            <?php require_once 'sidebar.php'; ?>
         </div>
      </div>
      <div class="row">
         <div class="col-12 align-items-center">
            <?php require_once 'pagination.php'; ?>
         </div>
      </div>
   </div>
</section>