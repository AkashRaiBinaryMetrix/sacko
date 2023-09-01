<?php /* Template Name: Testimonials */ ?>

<?php get_header();?>
<div class="mainpage-video">
  <video autoplay muted loop>
    <source src="<?php echo get_template_directory_uri();?>/assets/images/video1.mp4" type="video/mp4">
  </video>
</div>

<div class="inner-page">
  <div class="container">
    <div class="title-colleft"><h1 class="inner-title">Testimonials & Reviews</h1></div>

    <div class="testimonial-page">

        <div class="row">

            <div class="col-md-5">
				<div class="testimonial-form blackbg">
					<h2 class="cart-area-title">New Users</h2>
					<form class="testi-form" name="cform" method="post">
                        
                        <div class="form-group">
							<label>Your name</label>
							<input type="text" class="form-control" name="" id="" required="">
						  </div>

						  <div class="form-group">
							<label>Neighborhood, City, & State, or ZIP</label>
							<input type="text" class="form-control" name="" id="" required="">
						  </div>

						  <div class="form-group">
							<label>Year of Service</label>
							<input type="text" class="form-control" name="" id="" required="">
						  </div>

						  <div class="form-group">
							<label>Describe in detail your experience with Bernard Poirier</label>
							<textarea class="form-control" id="comment" rows="5" required=""></textarea>
						  </div>
                
                        <div class="form-group mt-4">
                        <button type="submit" class="common-btn login-btn">Sign Up</button>
                        </div>
        
                        </form>
				</div>
			</div>

            <div class="col-md-7">
                <div class="testimonials-list blackbg">
                    
					<p> There is nothing better than receiving sincere thanks from my clients for a job well done. Some of my clients have shared their thoughts with you below.</p>

					<h4>No Testimonials yet, please leave one!</h4>

                </div>
            </div>

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
