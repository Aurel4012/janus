<?php
/**
 * Janus functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Janus
 * @subpackage janustheme
 * @since janus 1.0.0
 */

if ( ! defined( '_S_VERSION' ) ) {
  // Replace the version number of the theme on each release.
  define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'janus_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   *
   * Note that this function is hooked into the after_setup_theme hook, which
   * runs before the init hook. The init hook is too late for some features, such
   * as indicating support for post thumbnails.
   */
  function janus_setup() {
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on Janus, use a find and replace
     * to change 'janus' to the name of your theme in all the template files.
     */
    load_theme_textdomain( 'janus', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
      array(
        'menu-1' => esc_html__( 'Primary', 'janus' ),
      )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
      )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
      'custom-background',
      apply_filters(
        'janus_custom_background_args',
        array(
          'default-color' => 'ffffff',
          'default-image' => '',
        )
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
      'custom-logo',
      array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
      )
    );
  }
endif;
add_action( 'after_setup_theme', 'janus_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function janus_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'janus_content_width', 640 );
}
add_action( 'after_setup_theme', 'janus_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function janus_widgets_init() {
  register_sidebar(
    array(
      'name'          => esc_html__( 'Sidebar', 'janus' ),
      'id'            => 'sidebar-1',
      'description'   => esc_html__( 'Add widgets here.', 'janus' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );
}
add_action( 'widgets_init', 'janus_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function janus_scripts() {
  wp_enqueue_style( 'janus-style', get_stylesheet_uri(), array(), _S_VERSION );
  wp_style_add_data( 'janus-style', 'rtl', 'replace' );

  wp_enqueue_script( 'janus-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

  wp_enqueue_script( 'janus-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), _S_VERSION, true );

  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'janus_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
  require get_template_directory() . '/inc/jetpack.php';
}

$user_info = get_current_user_infos();
function wpdocs_theme_name_scripts() {
wp_register_style('fontawesome',get_stylesheet_directory_uri() . '/css/all.min.css');
wp_enqueue_style('fontawesome');
wp_register_style('bootstrap-style', get_template_directory_uri().'/css/bootstrap.min.css', array(), true);
wp_enqueue_style('bootstrap-style');
wp_register_style('mdb-style', get_template_directory_uri().'/css/mdb.min.css', array(), true);
wp_enqueue_style('mdb-style');
wp_enqueue_style( 'datetimepicker-style',
get_stylesheet_directory_uri() . '/css/jquery.datetimepicker.css');
wp_deregister_script('jquery');
wp_enqueue_script('jquery',get_stylesheet_directory_uri() . '/js/jquery-3.1.1.min.js',[],true);
wp_enqueue_script( 'popper', get_template_directory_uri() . '/js/popper.min',[],true);
wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js',[],true);
wp_enqueue_script( 'mdb', get_template_directory_uri() . '/js/mdb.min.js',[],true);
wp_enqueue_script( 'myjs', get_template_directory_uri() . '/js/myjs.js',[],true);
wp_enqueue_script( 'datetimepicker', get_stylesheet_directory_uri() .'/js/jquery.datetimepicker.full.min.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

function menu_mytheme_setup() {

    register_nav_menus(
        array(
            'top_menu'        => __( 'Top Menu', 'janus' ), // we will be using this top_menu location
            'top_menu_mobile' => __( 'Top Menu Mobile', 'janus' ),
            'header'          => __( 'Header Menu', 'janus' ),
            'footer'          => __( 'footer Menu', 'janus' ),
        )
    );

}
// this will hook the setup function in after other setup actions.
add_action( 'after_setup_theme', 'menu_mytheme_setup' );
function style_top(){
  global $user_info;
  $style_top = '';
  if ($user_info != null){
      if ($user_info->roles[0] == 'administrator'){
          $style_top = ' admin-menu';
      }
  }
  return $style_top;
}
function header_custom(){

  $style_top = style_top();
    $spacing = 'style="top:105px;"';
    
          if ($style_top == strlen($style_top)){
            $spacing = 'style="top:55px;"';
          }

    
    require_once  'inc/class-wp-bootstrap-navwalker.php';
    ?>
    
    <!-- ajout menu top digitalstrategie --> 
  
    <nav class="navbar navbar-expand-lg container-fluid navbar-light bg-white d-md-none d-lg-none d-xl-none mobile_nav">
    
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="ml-auto"><?php the_custom_logo(); ?></div>
      <div class="ml-auto"><a href="tel:0670937002"><i class="fa fa-phone fa-2x fa-flip-horizontal mb-2"></i></a></div>
           <?php if (is_user_logged_in()){ ?>
              <div>
                     <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="false" aria-expanded="false">
                         <i class="fa fa-user-circle fa-2x user-button"></i>
                     </a>
                     <div class="dropdown-menu dropdown-menu-right profile-dropdown my-0 ml-3">
                         <a class="dropdown-item py-0" href="<?php echo get_home_url().'/admin-client/see-profil.php';?>"> <i class="fa fa-user-circle" style="padding-left:2px;"></i> <?php _e( 'Mon profil client', 'janus' ); ?></a>
                         <div class="dropdown-divider my-4"></div>
                         <a class="dropdown-item py-0" href="<?php echo get_home_url().'/securitylog/?action=logout';?>"> <i class="fa fa-user-times" style="padding-left:2px;"></i> <?php _e( 'Déconnexion', 'janus' ); ?></a>
                     </div>
                </div>
           <?php }else{
           ?>

          <div class="ml-3">
           <a href="<?php echo home_url('/admin-client/login.php');?>"><i class="fa fa-user-plus fa-2x"></i></a> 
          </div>
           <?php } ?>
    
      <?php
      wp_nav_menu( array(
          'theme_location'    => 'top_menu_mobile',
          'depth'             => 2,
          'container'         => 'div',
          'container_class'   => 'collapse navbar-collapse',
          'container_id'      => 'navbarSupportedContent',
          'menu_class'        => 'navbar-nav mr-auto',
          'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
          'walker'            => new WP_Bootstrap_Navwalker(),
      ) );
      ?>
      
    </nav>
    
    <nav class="navbar navbar-expand-sm navbar-light white fixed-top py-1 d-none d-sm-none d-md-block d-lg-block d-xl-block <?php echo $style_top; ?> top_menu" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        
            <a class="navbar-brand" href="#"><?php the_custom_logo(); ?></a>
       
        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
            <?php
            wp_nav_menu( array(
                'theme_location'    => 'top_menu',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'navbar-expand-sm',
                'container_id'      => 'bs-example-navbar-collapse-ordi',
                'menu_class'        => 'nav navbar-nav navbar-center top_menu',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ) );




            if (is_user_logged_in()){ ?>

                      <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user ml-auto" data-toggle="dropdown" href="#" role="button"
                         aria-haspopup="false" aria-expanded="false">
                          <i class="fa fa-user-circle fa-3x user-button pull-right mx-2"></i>
                      </a>
                      <a href="tel:0670937002"><i class="fa fa-phone fa-2x fa-flip-horizontal"></i></a>
                      <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                          <a class="dropdown-item" href="<?php echo get_home_url().'/admin-client/see-profil.php';?>"> <i class="fa fa-user-circle" style="padding-left:2px;"></i> <?php _e( 'Mon profil client', 'janus' ); ?></a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="<?php echo get_home_url().'/securitylog/?action=logout';?>"> <i class="fa fa-user-times" style="padding-left:2px;"></i> <?php _e( 'Déconnexion', 'janus' ); ?></a>
                      </div>

            <?php }else{
            ?>

            
                <div class="ml-auto">
                   <a href="<?php echo home_url('/admin-client/login.php');?>"><i class="fa fa-user-plus fa-2x mx-2"></i></a> 
                   <a href="tel:0670937002"><i class="fa fa-phone fa-2x fa-flip-horizontal"></i></a>
                </div>
            <?php } ?>

            
            
       </div>

    </nav>
    <div class="white_space"></div>
    
    <nav class="navbar navbar-expand-md white px-0 py-1  z-depth-1 fixed-top  d-none d-sm-none  d-md-block d-lg-block d-xl-block nav_menu" <?php echo $spacing; ?> role="navigation">
      <div class="container-fluid mx-0">

        <!-- Brand and toggle get grouped for better mobile display -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
             <i class="fa fa-bars"></i>
        </button>
        
            <?php
            wp_nav_menu( array(
                'theme_location'    => 'header',
                'depth'             => 2,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
                'container_id'      => 'bs-example-navbar-collapse-1',
                'menu_class'        => 'navbar-nav mx-auto',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker(),
            ) );
            ?>
        </div>
    </nav>

       <div class="space_page"></div>
    
    <?php
}


function get_current_user_infos() {
    if( is_user_logged_in() ) {
      $user = wp_get_current_user();
      return $user; // This returns an array
      
    } else {
      return null;
    }
  }
  //widget
  if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 1', 'janus'),
        'id' => 'footer_1',
        'before_widget' => '<div class="footer-widget col my-auto text-center"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
          )
        );
      if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 2', 'janus'),
        'id' => 'footer_2',
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s col">',
        'after_widget'  => '</div>',
        'before_title' => '<h4 class="text-center">',
        'after_title' => '</h4>',
          )
        );
      if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 3', 'janus'),
        'id' => 'footer_3',
        'before_widget' => '<div class="footer-widget col"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
          )
        );
      if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 4', 'janus'),
        'id' => 'footer_4',
        'before_widget' => '<div class="footer-widget col"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
          )
        );
      if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 5', 'janus'),
        'id' => 'footer_5',
        'before_widget' => '<div class="footer-widget col"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
          )
        );
      if ( function_exists('register_sidebar') )
          register_sidebar(array(
        'name' => __('Footer Column 6', 'janus'),
        'id' => 'footer_6',
        'before_widget' => '<div class="footer-widget col"><aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside></div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
          )
        );
        function my_handle_form_rdv_submit() {
            
            $phone    = htmlentities($_POST["phone"]);
            $date_rdv = htmlentities($_POST["date_rdv"]);
            $to       = get_bloginfo( 'admin_email');
            if ($_POST["radios"] == 1){
                $date_rdv = 'Dès que possible';
            }
            
            $body = file_get_contents(get_template_directory().'/mail/answer_rdv.php');
            $subject = __( 'Demande de rendez vous téléphonique', 'softing' );
              // $name = explode(' ', $Info_user->senior["senior_fullname"]);
              
              $body = str_replace( "%SUBJECT%", $subject, $body ); 
              // $body = str_replace( "%USERNAME%", $name[0].' '.$name[1], $body ); 
              $body = str_replace( "%HI%", __( 'Bonjour', 'softing' ), $body );
              
              $body = str_replace( "%SENTENCE1%",  __( 'Voici les coordonnées du Client:', 'softing' ), $body );
              $body = str_replace( "%LINK1%", $phone, $body );
              $body = str_replace( "%SENTENCE2%",  __( 'Date et heure souhaitées: ', 'softing' ), $body );
              $body = str_replace( "%SENTENCE3%",  $date_rdv, $body );

              $body = str_replace( "%SENTENCE4%", __( "L'équipe de Janus.", 'softing' ), $body );
              
              $body = str_replace( "%TEXTSN1%", __( 'Suivez nous ', 'softing' ), $body );
              $body = str_replace( "%TEXTSN2%", __( 'sur les réseaux sociaux', 'softing' ), $body );
              $body = str_replace( "%LINKSN%", 'https://www.facebook.com/januscma/', $body );
              
              $body = preg_replace( "!\r?\n!", "\n", $body );
              $headers      = array();

              $headers[]    = "MIME-Version: 1.0";

              $headers[]    = "Content-Type: text/html; charset=UTF-8";

              $headers[]    = "From: Janus &lt;".$to;


              $return_mail = @wp_mail( $to, $subject, $body, $headers );
              
            if ($return_mail){
              header('Content-Type: application/json');
              $reponse = array('reponse' => __( 'Merci, nous allons vous contacter', 'softing' ),
                               'code'    => "1");
              echo json_encode($reponse);
            }else{
              header('Content-Type: application/json');
              $reponse = array('reponse' => __( 'Merci de réessayer, nous rencontrons actuellement des problèmes', 'softing' ),
                               'code'    => "2");
              echo json_encode($reponse);
            }

            // This is where you will control your form after it is submitted, you have access to $_POST here.

        }
        // Use your hidden "action" field value when adding the actions
        if ($_POST['action'] == 'my_rdv_form'){
            add_action( 'admin_post_nopriv_my_rdv_form', 'my_handle_form_rdv_submit' );
            add_action( 'admin_post_my_rdv_form', 'my_handle_form_rdv_submit' );
        }

        add_action('wp_logout','auto_redirect_after_logout');
        function auto_redirect_after_logout(){
          wp_redirect( home_url() );
          exit();
        }
        //maj profile compte client
        if ( isset( $_POST['update_profile'] ) ) {
        $usermeta_array = [];
        $ID = get_current_user_id();
        foreach ($_POST as $key => $value) {
          switch ($key) {
            case 'user_url':
              ${$key} = htmlentities($value); 
              // echo'get_userdata url<br/>';
              break;
            case 'user_email':
              ${$key} = htmlentities($value);
              // echo'get_userdata user_email<br/>';
              break;
            
            default:
              $userdata_array = array("ID","user_url", "user_email");
             
              $usermeta_array[$key] = $value; //creer le tableau clef + valeur
              // echo $key.'<br/>';
              // echo $value.'<br/>'; 
              break;
          }
        }
        //update user_meta
        $result_usermeta = update_usermeta( $ID, 'data', $usermeta_array );
        // var_dump($result_usermeta);

        $Userdata = get_user_meta($ID);
        // var_dump($Userdata);
        //update user_data
        $result_userdata = compact($userdata_array);
        $result_update_user = wp_update_user( $result_userdata );

        if ( (!is_wp_error( $result_userdata) ) && ( !is_wp_error( $result_update_user) ) ){
          header('Content-Type: application/json');
          $reponse = array('reponse' => __( 'Merci, votre profil est à jour', 'softing' ),
                           'code'    => "1");
          echo json_encode($reponse);
        }else{
          header('Content-Type: application/json');
          $reponse = array('reponse' => __( 'Merci de réessayer, nous rencontrons actuellement des problèmes', 'softing' ),
                           'code'    => "2");
          echo json_encode($reponse);
        }
        }

        function my_dump($tmp) {
          echo '<pre>';
          print_r($tmp) ;
          // die();
          echo "</pre>";
        }
        function good_date($date){
          $date = new DateTime($date);
          return $date->format('d-m-Y H:i');
        }