<?php
echo '<div class="row">';
  echo '<div class="small-12 columns">';
  $obHeadlineStyle = get_field( "ob_headline_style" );
  if ($obHeadlineStyle) {
    $obHeadlineStyle = $obHeadlineStyle;
  } else {
    $obHeadlineStyle = "p";
  }
  $obHeadlineSize = get_field( "ob_headline_size" );
  if ($obHeadlineSize) {
    $obHeadlineSize = $obHeadlineSize;
  } else {
    $obHeadlineSize = "15";
  }
  $obheadlineColor = get_field( "ob_headline_color" );
  if ($obheadlineColor) {
    $obheadlineColor = $obheadlineColor;
  } else {
    $obheadlineColor = "#000";
  }
  $obStyle = ' style="font-size:'.$obHeadlineSize.'px; color:'.$obheadlineColor.'"';

  $ourBrands = get_field( "our_brands" );
  if( $ourBrands ) {  
    echo '<'. $obHeadlineStyle . $obStyle .' class="section-title text-center"><b></b><span class="section-title-main">' . $ourBrands . '</span><b></b></'. $obHeadlineStyle .'>';
  }
  echo '</div>';
echo '</div>';
echo '<div class="row" data-equalizer data-equalize-on="medium" id="brandGrid" style="display: none;">';

  $args = array(
  'order' => 'desc',
  'post_type' => 'brand',
  'category_name' => 'brands',
  'post_status' => 'publish'
  );

  $query = new WP_Query($args);
  if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
  echo '<div class="brandGridItem small-12 columns text-center">';
    edit_post_link('[rediger]', '<em class="edit-link">', '</em>');
    echo '<div style="height:320px; width:100%; background-image: url(' . wp_get_attachment_url( get_post_thumbnail_id($post->ID) ) . ')">';
      $link_to = get_field( "link_to" );
      if( $link_to ) {
      echo '<a class="sSlideLink" href="' . site_url() . $link_to . '" rel="bookmark"><span class="categoryName">'. get_the_title() . '</span></a>';
      }
    echo '</div>';
  echo '</div>';
  endwhile;  wp_reset_postdata(); else :
  _e( 'Sorry, no posts matched your criteria.' );
  endif;
echo '</div>';
?>