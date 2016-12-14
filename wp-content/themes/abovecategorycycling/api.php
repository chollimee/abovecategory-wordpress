<?php
  require __DIR__ . '/vendor/autoload.php';
  use Underscore\Types\Arrays;

  add_action('rest_api_init', function(){
    register_rest_route('ac/v1', '/products/(?P<id>\d+)/reviews', array('methods'=>'GET', 'callback'=> 'get_product_reviews'));
  });

  add_filter( 'posts_where' , 'allow_wildcards');
  function allow_wildcards($where) {
    $where = str_replace("meta_key = 'products_%_product", "meta_key LIKE 'products_%_product", $where);
    return $where;
  }

  function fix_posts_data($posts)
  {
    foreach($posts as $post)
    {
      setup_postdata($post);
      $post->link = get_permalink($post->ID);
      $post->post_excerpt = get_the_excerpt($post->ID);
    }
    wp_reset_postdata();
  }

  function get_product_reviews($data) {
    $post_ids = array();

    // get ac reviews
    if(isset($data['id']))
    {
      $posts = get_posts(array(
      'post_type' => 'product',
      'meta_key' => 'shopify_id',
      'meta_value' => $data['id']
      ));

      $post_ids = Arrays::pluck($posts, 'ID');
    }

    if(isset($data['bike_id']))
    {
      $post_ids[] = $data['bike_id'];
    }

    if(count($post_ids) > 0){
      $ac_reviews_query = new WP_Query(array(
        'post_type' => array('product_review','journal'),
        'meta_key' => 'products_%_product',
        'meta_value' => $post_ids,
        'tax_query' => array(
          'relation'=>'OR',
          array(
            'taxonomy'=>'category',
            'terms'=>array('ac'),
            'field'=>'slug',
            'operator'=>'IN'
            ),
          array(
            'taxonomy'=>'review_type',
            'terms'=>array('ac'),
            'field'=>'slug',
            'operator'=>'IN'
            )
          )
        ));

      $ac_reviews = $ac_reviews_query->get_posts();

      $media_reviews_query = new WP_Query(array(
        'post_type' => array('product_review', 'journal'),
        'meta_key' => 'products_%_product',
        'meta_value' => $post_ids,
        'tax_query' => array(
          'relation'=>'OR',
          array(
            'taxonomy'=>'category',
            'terms'=>array('media'),
            'field'=>'slug',
            'operator'=>'IN'
            ),
          array(
            'taxonomy'=>'review_type',
            'terms'=>array('media'),
            'field'=>'slug',
            'operator'=>'IN'
            )
          )
        ));

      $media_reviews = $media_reviews_query->get_posts();

      fix_posts_data($ac_reviews);
      fix_posts_data($media_reviews);
    }else{
      $ac_reviews = [];
      $media_reviews = [];
    }

    return array('ac'=>$ac_reviews, 'media'=>$media_reviews);
  }