<?php 
$allCategories = selectAll('categories');
?>

<div class="sidebar">
   <?php if (mb_strpos($fullUrlSingleBlogPage, 'single-blog.php')) : ?>
      <div class="categories bg-white">
         <h3 class="title mb-3">Категории</h3>
         <ul class="m-0 p-0">
            <?php foreach ($allCategories as $category) : ?>
               <li class="mt-2 mb-2">
                  <a href="#">
                     <i class="fa-solid fa-arrow-right me-2"></i><?= $category['name']; ?>
                  </a>
               </li>
            <?php endforeach; ?>
         </ul>
      </div>
   <?php else : ?>
      <div class="search bg-white mb-3">
            <h3 class="title mb-3">Поиск</h3>
            <form id="search-posts">
               <div class="input-group">
                  <input type="hidden" name="id" value="<?= $_GET['id']; ?>">
                  <input type="text" class="form-control w-100" name="search" placeholder="Введите искомое слово">
               </div>
            </form>
         </div>
      <div class="categories bg-white">
         <h3 class="title mb-3">Категории</h3>
         <ul class="m-0 p-0">
            <?php foreach ($allCategories as $category) : ?>
               <li class="mt-2 mb-2">
                  <a href="<?= BASE_URL . 'views/main/category.php?id=' . $category['id']; ?>">
                     <i class="fa-solid fa-arrow-right me-2"></i><?= $category['name']; ?>
                  </a>
               </li>
            <?php endforeach; ?>
         </ul>
      </div>
   <?php endif; ?>
</div>