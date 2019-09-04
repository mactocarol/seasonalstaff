<!-- breadcrumb section Start -->
<div class="breadcrumb text-center">
	<div class="container">
	<h1>contact Us</h1>
	<ul><li><a href="<?php echo site_url('Welcome');?>">home</a></li><li>contact Us</li></ul>
	</div>
</div>
<!-- breadcrumb section End -->
<!-- contact section Start -->
<div class="contact_section">
	<div class="container">
    	<div class="row">
            <div class="col-lg-8 offset-lg-2">
				<div class="contact_form_cover">
					<div class="contact_form_heading">
						<h4>Contact Us</h4>
						<p>Please fill free to contact us about Advertising, Business opportunities general matters or to offer a suggestion.</p>
					</div>
					<form method="post" action="<?php echo base_url(); ?>Welcome/contactmail">
					<div class="contact_form">
						<div class="form_group width_50">
							<label>Name<span class="required_star">*</span></label>
							<div class="input_group">
								<input type="text" name="name" id="name" placeholder="Name" required>
							</div>
						</div>
						<div class="form_group width_50">
							<label>Email<span class="required_star">*</span></label>
							<div class="input_group">
								<input type="email" name="email" id="email" placeholder="Email" required>
							</div>
						</div>
						<div class="form_group width_100">
							<label>Phone Number<span class="required_star">*</span></label>
							<div class="input_group">
								<input type="text" name="phone" id="phone" placeholder="Phone Number" required>
							</div>
						</div>
						<div class="form_group width_100">
							<label>Subject<span class="required_star" required>*</span></label>
							<div class="input_group">
                                <select name="subject" id="subject">
                                    <option value="Advertising opportunity">Advertising opportunity</option>
                                    <option value="Business opportunity">Business opportunity</option>
                                    <option value="General Matters">General Matters</option>
                                    <option value="Offer">Offer</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Other">Other</option>
                                </select>
							</div>
						</div>
						<div class="form_group width_100">
							<label>Your Comment<span class="required_star">*</span></label>
							<div class="input_group">
								<textarea name="comment" id="comment" placeholder="Your Comment" required></textarea>
							</div>
						</div> 
						<div class="form_group width_100 contact_button">
							<button type="submit" value="Send Message" class="contact_btn blue_button">Send Message</button>
						</div>
					</div>
				 </form>	
				</div>
            </div>
        </div>
    </div>
</div>
<!-- contact section End -->