<div class="container-acc">
  <div class="row">
    <div id="primary" class="col-md-6 col-xs-12 content-relative">
      <div class="hidden-sm-down border-acc-right"></div>
      <div class="content-block">
        <div id="emails">
          <h2>EMAIL</h2>
          <?php
            if( have_rows('emails') ):
                while ( have_rows('emails') ) : the_row();
                ?>
                  <div class="contact-item">
                    <div class="email-description"><?php echo get_sub_field('description'); ?></div>
                    <div class="email-address"><strong><?php echo get_sub_field('email'); ?></strong></div>
                  </div>
                <?php
                endwhile;
            endif;
          ?>
        </div>

        <div id="tele">
          <h2>TELE</h2>
          <div class="contact-item tele"><strong><?php echo get_field('tele'); ?></strong></div>
        </div>
      </div>
    </div>

    <div class="clearfix hidden-sm-up"></div>

    <div id="secondary" class="col-md-6 col-xs-12">
      <div class="content-block">
        <h2>SAUSALITO SHOP</h2>
        <div class="contact-item shop-address">
          <?php echo get_field('shop_address'); ?>
        </div>

        <div class="contact-item shop-hours">
          <div><strong>SHOP HOURS</strong></div>
          <?php
            if( have_rows('shop_hours') ):
                while ( have_rows('shop_hours') ) : the_row();
                ?>
                <div class="row day-hours">
                    <div class="col-md-3 col-xs-6"><?php echo get_sub_field('day'); ?></div>
                    <div class="col-md-9 col-xs-6"><strong><?php echo get_sub_field('hours'); ?></strong></div>
                </div>
                <?php
                endwhile;
            endif;
          ?>
        </div>
      </div>
    </div>
  </div>
</div>


<div id="map"></div>


<script>
  var lat = parseFloat("<?php echo get_field("shop_location")["lat"];?>");
  var lng = parseFloat("<?php echo get_field("shop_location")["lng"];?>");
  var img = "<?php echo get_template_directory_uri()?>/html/images/marker.png";
  var shopLocation = {lat: lat, lng: lng};
  var map;

  function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: lat, lng: lng},
      zoom: 16,
      scrollwheel: false,
      draggable: true,
      disableDefaultUI: true,
      zoomControlOptions: {
          position: google.maps.ControlPosition.TOP_RIGHT
      },
      styles: require("scripts/Contact.js").map_styles
    });

    var marker = new google.maps.Marker({
      position: shopLocation,
      map: map,
      title: '',
      icon: img
    });

    var zoomControlDiv = document.createElement('div');
    require("scripts/Contact.js").ZoomControl(zoomControlDiv, map);

    zoomControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(zoomControlDiv);
  }
</script>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsB4Qp4QImCrDZ2dKzdpFPIizppkKpZ_g&callback=initMap">
</script>



