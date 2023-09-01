<?php /* Template Name: Contact Us */ ?>

<?php get_header();?>

<div class="mainpage-video">
  <video autoplay muted loop playsinline>
    <source src="<?php echo get_template_directory_uri();?>/assets/images/contact-video.mp4" type="video/mp4">
  </video>
</div>

<div class="inner-page">
  <div class="container">
    <div class="title-colleft"><h1 class="inner-title"><?php the_field('contact_heading')?></h1></div>

    <div class="contact-page">
        
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="materialContainer">
                    
                  <?php echo do_shortcode('[contact-form-7 id="125" title="Contact form 1"]'); ?>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="contact-details">
                    <div>
                        
   
                       <?php if( have_rows('box') ): ?>
              <?php while( have_rows('box') ): the_row(); ?>
                        <div class="contact-box">
                            <div class="contact-icon">
                               <?php the_sub_field('image');?>
                            </div>
                            <div class="contact-title">
                                <h4> <?php the_sub_field('heading');?></h4>
                                <p><?php the_sub_field('paragraph');?></p>
                            </div>
                        </div>
<?php  endwhile; 
			endif; 
			?>
       
                    </div>
                </div>
            </div>
        </div>

       <div class="contact-map mt-5">
        <?php the_field('iframe')?>
       </div> 

    </div>

  </div>
</div>


<div class="translang-bar wow slideInUp">
  <div class="container">

   <div class="row align-items-center">
     <div class="col-md-7">
         <div class="register-left">
             <h4 class="title mb-0">TRADUIRE DANS UNE AUTRE LANGUE</h4>    
           </div>
     </div>

     <div class="col-md-5 text-md-right">
         <a href="#" class="common-btn">Choose Language</a>
     </div>

 </div>

  </div>
</div>

<?php get_footer();?>
