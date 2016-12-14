
  <div class="category" id="<?php echo strtolower($category->name); ?>">
    <h2 class="category-title"><?php echo $category->name; ?></h2>
    <div class="category-description"><?php echo $category->description; ?></div>
    <div class="row">
    <?php
    while ($query->have_posts() ) : $query->the_post();
    ?>
      <?php get_template_part( 'content', 'bike' ); ?>
    <?php
    endwhile; 
    ?>
    </div>
  </div>
  