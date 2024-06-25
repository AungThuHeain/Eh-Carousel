<?php
/*
Plugin Name: Eh Carousel
Description: To show recent posts in home page carousel by using shortcode "[eh_carousel]"
Author: Aung Thu Heain
*/

function get_recent_post_in_carousel()
{
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="<KEY>" crossorigin="anonymous">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        <?php
                        $query = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 20,
							'order' => 'DESC',
                        ));
                        $index = 0;
                        while ($query->have_posts()) {
                            $query->the_post();

                        ?>

                            <div class="carousel-item <?php if ($index === 0) echo 'active';  ?>">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h6><?php echo get_the_title(); ?></h6>
                                        <?php echo get_the_date(); ?>
                                        <hr>
                                        <?php
                                        $exc = get_the_excerpt();
                                        echo substr($exc, 0, 100);
                                        ?>
                                        <div class="my-3">
                                            <a class="btn btn-sm btn-readmore text-danger" href="<?php echo get_permalink()   ?>">READ MORE</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <?php the_post_thumbnail('full', ['class' => 'carousel-img']) ?>
                                    </div>
                                </div>

                            </div>

                        <?php
                            $index++;
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon visually-hidden" aria-hidden="true"></span>
						 <img style="width:20px;" class="d-none d-lg-block" src="<?php echo plugin_dir_url(__FILE__) . 'images/circle-left-regular.svg' ?>">
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon visually-hidden" aria-hidden="true"></span>
                        <img style="width:20px;" class="d-none d-lg-block" src="<?php echo plugin_dir_url(__FILE__) . 'images/circle-right-regular.svg' ?>">
                        <span class="visually-hidden" >Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
		@media(min-width:768px){
		   .carousel {
            padding: 20px 16%;
          }
		}

        .btn-readmore {
            border: 1px solid #ff0000;
			border-radius:5px;
        }

        .carousel-img {
            width: 270px !important;
            height: 270px !important;
        }

        .carousel-inner {
            padding: 10px 10%;
            background: white;
        }
		
		.carousel-control-prev, .carousel-control-next{
		  width:2%;
		}
		
		.carousel-control-prev{
		    left:17%;
		}
		
		.carousel-control-next{
		    right:17%;
		}
		
	
    </styl>

<?php
}
add_shortcode('custom_carousel', 'get_recent_post_in_carousel');
