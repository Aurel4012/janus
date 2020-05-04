<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Janus
 * @subpackage janustheme
 * @since janus 1.0.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<b class="screen-overlay"></b>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="site-header">


		 <div class="container-fluid px-0">

		     <?php header_custom() ?>
		 </div>
		 <!-- modal -->
		 <div id="rdv_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		   <div class="modal-dialog modal-dialog-centered" role="document">
		     <div class="modal-content">
		       <div class="modal-header">
		         <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle"><?php _e( 'Vous souhaitez être rappelé?', 'softing' ); ?></h5>
		         <button type="button" id="send_rdv" class="close" data-dismiss="modal" aria-label="Close">
		           <span aria-hidden="true">&times;</span>
		         </button>
		       </div>
		       <div class="modal-body">
		        <form id="form_rdv" class="form-horizontal justify-content-center" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
		        <fieldset>
		         <input type="hidden" name="action" value="my_rdv_form">
		        <!-- Text input-->
		        <h5 class="text-center"><?php _e( 'Votre numéro de téléphone:', 'softing' ); ?></h5>
		        <div class="form-group">
		         
		          <div class="justify-content-center  input-border">
		          <input id="phone" name="phone" type="tel" placeholder="ex: 0123456789" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" class="form-control input-md" required>
		          
		          </div>
		        </div>
		        	 <!-- Text input-->
		        	<h5 class="text-center"><?php _e( 'Quand souhaitez vous être rappelé?', 'softing' ); ?></h5>
		        <!-- Multiple Radios -->
		        <div class="form-group">

		          <div class="justify-content-center  input-border">
		             <div class="radio">
		 	           <label for="radios-0">
		 	             <input type="radio" name="radios" id="radios-0" value="1" checked="checked">
		 	             <?php _e( 'Dès que possible', 'softing' ); ?>
		 	           </label>
		 	       	</div>

		 	        <div class="radio1">
		 	           <label for="radios-1">
		 	             <input type="radio" name="radios" id="radios-1" value="2">
		 	             <?php _e( 'Un autre moment', 'softing' ); ?>
		 	           </label>
		 	        </div>



		          </div>
		        </div>


		       </div>

		       <div class="modal-footer">
		         <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cnl_rdv"><?php _e( 'Fermer', 'softing' ); ?></button>
		         <button type="submit" class="btn btn-primary" id="send_rdv"><?php _e( 'Envoyer', 'softing' ); ?></button>
		       </div>
		       </fieldset>
		 	   </form>
		     </div>
		   </div>
		 </div>
	</header><!-- #masthead -->

