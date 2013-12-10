<?php
/*
  Plugin Name: Omni Muneris
  Plugin URL: http://constantin-blog.eu
  Description: Ajoute des fonctions utiles et inclassables    Version: 1.0
  Author: <a href="http://constantin-blog.eu" target="_blank">Constantin Boulanger</a>
  Author URL: http://constantin-blog.eu
*/


// gère les conflits entre jquery ui et l'uploader de wp
if (is_admin()) {
wp_deregister_script('jquery');
wp_enqueue_script('customadminjs', get_template_directory_uri() .'/js/upload.js'); 
wp_enqueue_script('jquery-2', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js');  
}

add_action('admin_bar_menu', 'add_toolbar_items', 999);
function add_toolbar_items($admin_bar){
	$admin_bar->add_menu( array(
		'id'    => 'Omni Muneris',
		'title' => 'Omni Muneris',
		'href'  => home_url().'/wp-admin/admin.php?page=OmniMuneris',
		'meta'  => array(
			'title' => __('Omni Muneris'),			
		),
	));
	
}

function globalfunctionAdmin() 
{
		add_menu_page('Omni Muneris', 'Omni Muneris', 10, 'OmniMuneris', 'adminFonctionGlobales');
}


add_action('admin_menu', 'globalfunctionAdmin');

function adminFonctionGlobales()
{
?>
	<!-- Gestion du jQuery -->
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
	<?php wp_enqueue_script('jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js');  ?>
	<script>
		$(document).ready(function() {
			$("#tabs").tabs();
			
		});
  	</script>
	<style>
	textarea 
	{
		width: 600px;
		height: 230px;
		border: 3px solid #cccccc;
		padding: 5px;
		font-family: Tahoma, sans-serif;
		
	}

	
	em
	{ font-weight:normal;}

.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Geneva, Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #0083C4; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 8px 6px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 16px; font-weight: normal; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00557F; border-left: 3px solid #E1EEF4;font-size: 14px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEf4; color: #00557F; }.datagrid table tbody td:first-child { border-left: none; width: 30%; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #0083C4;background: #E1EEf4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #00557F; color: #FFFFFF; background: none; background-color:#006699;}

	
	</style>

	
	<div class="wrap">
			
	<h2>Omni Muneris - Administration</h2>
		<?php if( isset($_GET['settings-updated']) ) { ?>
			<div id="message" class="updated">
				<p><strong><?php _e('Settings saved.') ?></strong></p>
			</div>
		<?php } ?>
	<form method="post" action="options.php">
		<?php settings_fields('fonctionsGlobales');?>
		

	<div id="tabs">
			<ul>
				<li><a href="#interface">Interface WP</a></li>
				<li><a href="#optimisation">Optimisation</a></li>
				<li><a href="#referencement">Référencement</a></li>
				<li><a href="#publicite">Publicité</a></li>
			</ul>
			
			<div id="interface">			
				<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th>Libellé</th>
							<th>Activé</th>						
						</tr>
					</thead>
					<tbody>												
						<tr>
							<td>Colorer la page d'administration des articles en fonction de leur status</td>
							<td><input name="colorArticle" type="checkbox" value="1" <?php checked( '1', get_option( 'colorArticle' ) ); ?> /></td>
						</tr>						
						<tr class="alt">
							<td>Afficher la page "Toutes les Options"</td>
							<td><input name="allSettings" type="checkbox" value="1" <?php checked( '1', get_option( 'allSettings' ) ); ?> /></td>
						</tr>
						<tr>
							<td>Supprimer l'admin Bar du Front</td>
							<td><input name="RemoveABar" type="checkbox" value="1" <?php checked( '1', get_option( 'RemoveABar' ) ); ?> /></td>
						</tr>
						<tr class="alt">
							<td>Activer le filtre par auteur pour les articles</td>
							<td><input name="AuthorFilter" type="checkbox" value="1" <?php checked( '1', get_option( 'AuthorFilter' ) ); ?> /></td>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
			
			<div id="optimisation">			
				<div class="datagrid">
				<table>
					<thead>
						<tr>
							<th>Libellé</th>
							<th>Activé</th>						
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Activer le pré-chargement HTML5</td>
							<td><input name="prefetchHTML5" type="checkbox" value="1" <?php checked( '1', get_option( 'prefetchHTML5' ) ); ?> /></td>
						</tr>
						<tr class="alt">
							<td>Charger les scripts javascripts dans le footer </td>
							<td><input name="JSToFooter" type="checkbox" value="1" <?php checked( '1', get_option( 'JSToFooter' ) ); ?> /></td>
						</tr>
						<tr >
							<td>Rendre le lien non cliquable dans les commentaires</td>
							<td><input name="clickable_link_comment" type="checkbox" value="1" <?php checked( '1', get_option( 'clickable_link_comment' ) ); ?> /></td>
						</tr>
						<tr class="alt">
							<td>Désactiver l'autoPing</td>
							<td><input name="noSelfPing" type="checkbox" value="1" <?php checked( '1', get_option( 'noSelfPing' ) ); ?> /></td>
						</tr>
						<tr >
							<td>Activer le responsive pour les vidéos</td>
							<td><input name="responsiveVideo" type="checkbox" value="1" <?php checked( '1', get_option( 'responsiveVideo' ) ); ?> /></td>
						</tr>
						<tr class="alt">
							<td>Activer la compression des images à 75% de leur qualité<br><em>Optimise le chargement des pages</em></td>
							<td><input name="compressionJPG" type="checkbox" value="1" <?php checked( '1', get_option( 'compressionJPG' ) ); ?> /></td>
						</tr>						
					</tbody>
				</table>
				</div>
			</div>
			
			
			<div id="referencement">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th>Libellé</th>
								<th>Activé</th>
								
							</tr>
						</thead>


						<tbody>
							<tr>
								<td>Rediriger directement la recherche quand il n'y a qu'un résultat</td>
								<td> <input name="RedirectSingle" type="checkbox" value="1" <?php checked( '1', get_option( 'RedirectSingle' ) ); ?> /></td>
							</tr>
							<tr class="alt">
								<td>Supprimer les meta inutiles<br><em>Balise Générator et Shortlink</em></td>
								<td><input name="RemoveMeta" type="checkbox" value="1" <?php checked( '1', get_option( 'RemoveMeta' ) ); ?> /></td>
							</tr>
							<tr>
								<td>Créer les meta pour les articles<br><em>Inutile si vous utiliser déjà un plugin pour le SEO</em></td>
								<td><input name="CreaMeta" type="checkbox" value="1" <?php checked( '1', get_option( 'CreaMeta' ) ); ?> /></td>
							</tr>
							<tr class="alt">
								<td>Eviter le duplicate Content pour les commentaires paginés<br><em>Rajoute une balise canonical</em></td>
								<td><input name="AvoidCommentDuplicate" type="checkbox" value="1" <?php checked( '1', get_option( 'AvoidCommentDuplicate' ) ); ?> /></td>
							</tr>
							<tr>
								<td>Eviter le duplicate Content pour les catégories<br><em>Rajoute une balise canonical</em></td>
								<td><input name="AvoidCatDuplicate" type="checkbox" value="1" <?php checked( '1', get_option( 'AvoidCatDuplicate' ) ); ?> /></td>
							</tr>
							<tr class="alt">
								<td>Eviter les erreurs 404 d'une pagination</td>
								<td><input name="Eviter404" type="checkbox" value="1" <?php checked( '1', get_option( 'Eviter404' ) ); ?> /></td>
							</tr>	
							<tr>
								<td>Mettre les commentaires en DoFollow</td>
								<td><input name="dofollow_comment" type="checkbox" value="1" <?php checked( '1', get_option( 'dofollow_comment' ) ); ?> /></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			
			
			
			
			<div id="publicite">
				<div class="datagrid">
					<table>
						<thead>
							<tr>
								<th>Libellé</th>
								<th>Activé</th>
							</tr>
						</thead>
						<tbody>
							<tr class="alt">
								<td>Publicité en début d'article (is_single())</td>
								<td><textarea name="pubBeforeArticle" cols="20"rows="5" id="pubBeforeArticle"><?php echo get_option('pubBeforeArticle'); ?></textarea></td>
							</tr>
							<tr>
								<td>Publicité en fin d'article (is_single())</td>
								<td><textarea name="pubAfterArticle" cols="20"rows="5" id="pubBeforeArticle"><?php echo get_option('pubAfterArticle'); ?></textarea></td>
							</tr>
						</tbody>
					</table>
				</div>						
			</div>
	</div>
	
	
	
		
		
		
		<?php submit_button();?>
	</form>
	
	</div>
<?php
}
 

add_action( 'admin_init', 'saveBDDFonctions' );
function saveBDDFonctions()
{
	register_setting( 'fonctionsGlobales', 'AuthorFilter' );
	register_setting( 'fonctionsGlobales', 'RemoveABar' );
	register_setting( 'fonctionsGlobales', 'RemoveMeta' );
	register_setting( 'fonctionsGlobales', 'JSToFooter' );
	register_setting( 'fonctionsGlobales', 'prefetchHTML5' );
	register_setting( 'fonctionsGlobales', 'RedirectSingle' );
	register_setting( 'fonctionsGlobales', 'CreaMeta' );	
	register_setting( 'fonctionsGlobales', 'AvoidCommentDuplicate' );
	register_setting( 'fonctionsGlobales', 'AvoidCatDuplicate' );
	register_setting( 'fonctionsGlobales', 'Eviter404' );
	register_setting( 'fonctionsGlobales', 'colorArticle' );		
	register_setting( 'fonctionsGlobales', 'dofollow_comment' );	
	register_setting( 'fonctionsGlobales', 'clickable_link_comment' );	
	register_setting( 'fonctionsGlobales', 'noSelfPing' );	
	register_setting( 'fonctionsGlobales', 'responsiveVideo' );	
	register_setting( 'fonctionsGlobales', 'pubBeforeArticle' );	
	register_setting( 'fonctionsGlobales', 'pubAfterArticle' );	
	register_setting( 'fonctionsGlobales', 'allSettings' );	
	register_setting( 'fonctionsGlobales', 'compressionJPG' );	
	
}
//Supprimer les salutations en haut à droite 
function good_bye_howdy( $wp_admin_bar ) 
{
	global $current_user;
	$my_account=$wp_admin_bar->get_node('my-account');
	$howdy = sprintf( __('Howdy, %1$s'), $current_user->display_name );
	$title = str_replace( $howdy, '', $my_account->title );
	$wp_admin_bar->add_node( array(
	'id' => 'my-account',
	'title' => $title,
	'meta' => $my_account->meta
	) );
}
//fin suppression salutations


if(get_option('colorArticle') ==1)
{
	function color_css_post_status() {
		?>
		<style>
		.status-draft{background: #FFFF99 !important;}
		.status-future{background: #CCFF99 !important;}
		.status-pending{background: #87C5D6 !important;}
		.status-private{background:#FFCC99 !important;}
		.status-publish{}
		</style>
		<?php
    }
    add_action('admin_print_styles-edit.php','color_css_post_status');
}

add_filter( 'admin_bar_menu', 'good_bye_howdy' );

if (get_option('Eviter404') == 1)
{
	add_action('template_redirect', 'baw_template_redirect_no_404_pagination' );
	function baw_template_redirect_no_404_pagination()
	{	
		if (!is_home())
		{
			// Récupération de la variable "paged"
			$paged = get_query_var( 'paged' );
			// Si nous sommes sur une page 404 avec une page &gt; à 0
			if( is_404() && $paged>0 ):
				global $wp_rewrite;
				// Je recrée une URL correcte en supprimant la demande de pagination
				$url = preg_replace( "#/$wp_rewrite->pagination_base/$paged(/+)?$#", '', $_SERVER['REQUEST_URI'] );
				// Je redirige vers cette URL
				wp_redirect( $url, 301 );
				// Et die() après une redirection ;) 
				die();
			endif;
		}
	}
}

if (get_option('AvoidCatDuplicate') == 1)
{
	add_action('wp', 'baw_non_duplicate_content' );
	function baw_non_duplicate_content( $wp )
	{
		global $wp_query;
			// Si le nom de catégorie trouvée est différente entre le rewrite match et la variable requetée, alors on redirige
		if( isset( $wp_query->query_vars['category_name'], $wp_query->query['category_name'] )
			&& $wp_query->query_vars['category_name'] != $wp_query->uery['category_name'] ):
					// L'URL correcte dans laquelle on remplace la catégorie requetée par son véritable nom
			$correct_url = str_replace( $wp_query->query['category_name'], $wp_query->query_vars['category_name'], $wp->request );
					// Redirection 301
			wp_redirect( home_url( $correct_url ), 301 );
					// Toujours die() après une redirection
			die();
		endif;
	}
}

if (get_option('JSToFooter') == 1)
{
	function insert_js_in_footer() {

		// On verifie si on est pas dans l'admin
		if( !is_admin() ) :

			// On annule jQuery installer par WordPress (version 1.4.4
			wp_deregister_script( 'jquery' );

			// On declare un nouveau jQuery dernière version grace au CDN de Google
			wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js','',false,true);
			wp_enqueue_script( 'jquery' );

			// On insere le fichier de ses propres fonctions javascript
			wp_register_script('functions', get_bloginfo( 'template_directory' ).'/js/functions.js','',false,true);
			wp_enqueue_script( 'functions' );

	   endif;

	}
	add_action('init', 'insert_js_in_footer');  
}


//HTML5 PREFETCH
if (get_option('prefetchHTML5') == 1)
{
	add_action('wp_head', 'gkp_prefetch');
	function gkp_prefetch() {
		if ( is_single() ) {  ?>
			
			<!-- Préchargement de la page d'accueil -->
			<link rel="prefetch" href="<?php echo home_url(); ?>" />
			<link rel="prerender" href="<?php echo home_url(); ?>" />
			
			<!-- Préchargement de l'article suivant -->
			<link rel="prefetch" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
			<link rel="prerender" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
		<?php
		}
	} 
}

if (get_option('RedirectSingle') == 1)
{
	//rediriger automatiquement vers l'article quand il n'y a qu'un resultat de recherche
	add_action('template_redirect', 'single_result');
	function single_result() {
		if (is_search()) {
			global $wp_query;
			if ($wp_query->post_count == 1) {
				wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
			}
		}
	}
}

if (get_option('CreaMeta') == 1)
{
	//Meta automatique des articles dans le head
	function create_meta_desc() {
		global $post;
		if (!is_single()) { return; }
			$meta = strip_tags($post->post_content);
			$meta = strip_shortcodes($post->post_content);
			$meta = str_replace(array("\n", "\r", "\t"), ' ', $meta);
			$meta = substr($meta, 0, 125);
			echo "<meta name='description' content='$meta' />";
		}
	add_action('wp_head', 'create_meta_desc'); 
}


//Filtre par auteurs dans la page d'administration des articles !
if (get_option('AuthorFilter') == 1)
{		
	function restrict_manage_authors() {

			global $wpdb, $typenow;

			// On prepare la requete pour recuperer tous les auteurs qui ont publiés au moins 1 article
			$query = $wpdb->prepare( 'SELECT DISTINCT post_author
				FROM '. $wpdb->posts . '
				WHERE post_type = %s
			', $typenow );

			// On recupere les id
			$users = $wpdb->get_col($query);

		   // On génére le select avec la liste des auteurs
			wp_dropdown_users(array(
					'show_option_all'       => 'Voir tous les auteurs',
					'show_option_none'      => false,
					'name'                  => 'author',
					'include'		=> $users,
					'selected'              => !empty($_GET['author']) ? (int)$_GET['author'] : 0,
					'include_selected'      => true
			));
	   
		}
	add_action('restrict_manage_posts', 'restrict_manage_authors');

}
if (get_option('RemoveABar') == 1)
{
	//Supprimer l'admin bar du site
	function my_function_admin_bar(){
		return false;
	}
	add_filter( 'show_admin_bar' , 'my_function_admin_bar');
}

if (get_option('RemoveMeta') == 1)
{
	//Supprimer la meta generator
	remove_action('wp_head', 'wp_generator');
	//Supprimer les shortlink
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}


if (get_option('clickable_link_comment') == 1){remove_filter('comment_text', 'make_clickable', 9);}

add_action('wp_head', 'myAdsense');
function myAdsense()
{
	 if (!is_user_logged_in(admin))
	{
	?>

		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-27450446-1']);
		  _gaq.push(['_setDomainName', 'constantin-blog.eu']);
		  _gaq.push(['_trackPageview']);

		  (function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
	<?php
	} 
	}	if (get_option('dofollow_comment') == 1){	function commentdofollow($text) {	return str_replace('" rel="nofollow">', '">', $text);}	add_filter('comment_text', 'commentdofollow');	remove_filter('pre_comment_content', 'wp_rel_nofollow', 15);	function remove_nofollow($string){	return str_ireplace(' nofollow', '', $string);}	add_filter('get_comment_author_link', 'remove_nofollow');}


if (get_option('noSelfPing') == 1)
{
	// Désactiver les rétroliens vers son propre site
	function mes_pings( &$liens ) {
		$home = get_option( 'home' );
		foreach ( $liens as $l => $lien )
			if ( 0 === strpos( $lien, $home ) )
				unset($liens[$l]);
	}
	add_action( 'pre_ping', 'mes_pings' );	
}

if (get_option('responsiveVideo') == 1)
{
	/* Ajout du script fitvids.js */
	function fitvids_js() {
	 if (!is_admin()) {
	 wp_register_script('fitvids', 'http://constantin-blog.eu/wp-includes/js/jquery.fitvids.js', 'jquery', '1.0', true);
	 wp_enqueue_script('fitvids');
	 }
	 }
	 add_action('wp_enqueue_scripts', 'fitvids_js');	
	 
	 /* Vidéo responsive */
	 function wpc_video_responsive() { ?>
	 <script>
	 jQuery(document).ready(function(){
	 jQuery("#main").fitVids();
	 });
	 </script>
	 <?php }
	add_action('wp_head', 'wpc_video_responsive');
}
/********** GESTION DE LA PUBLICITE **********/

if (get_option('pubBeforeArticle') != '' && get_option('pubAfterArticle') != '')
{
	add_filter('the_content', 'pubBeforeArticle');

	function pubBeforeArticle($content) 
	{
	   if (is_single()) {
		  $content = '<div align="center" id="monplugingenere" style="margin-bottom:10px">'.get_option('pubBeforeArticle'). '</div> <!-- google_ad_section_start -->' . $content.' <!-- google_ad_section_end --><div align="center" id="monplugingenere" style="margin-top:10px">'.get_option('pubAfterArticle'). '</div> ';
	   }
	   return $content;
	}

}

if (get_option('pubBeforeArticle') != '' && get_option('pubAfterArticle') == '')
{
	add_filter('the_content', 'pubBeforeArticle');

	function pubBeforeArticle($content) 
	{
	   if (is_single()) {
		  $content = '<div align="center" id="monplugingenere" style="margin-bottom:10px">'.get_option('pubBeforeArticle'). '</div> <!-- google_ad_section_start -->' . $content.' <!-- google_ad_section_end -->';
	   }
	   return $content;
	}

}

if (get_option('pubAfterArticle') != '' && get_option('pubBeforeArticle') == '')
{
	add_filter('the_content', 'pubAfterArticle');

	function pubAfterArticle($content) 
	{
	   if (is_single()) {
		  $content = '<!-- google_ad_section_start -->' . $content.' <!-- google_ad_section_end --><div align="center" id="monplugingenere" style="margin-top:10px">'.get_option('pubAfterArticle'). '</div> ';
		  
	   }
	   return $content;
	}

}
/********** GESTION DE LA PUBLICITE **********/
if (get_option('allSettings') == 1)
{
    // ajout d'un menu dans l'admin  
    // visible uniquement pour les admin  
    if (!function_exists('add_all_general_settings_link')) {  
       function add_all_general_settings_link() {  
          add_options_page(__('All Settings'), __('All Settings'), 'administrator', 'options.php');  
       }  
       add_action('admin_menu', 'add_all_general_settings_link');  
    }  
}

if (get_option('compressionJPG') == 1)
{
     add_filter('wp_editor_set_quality', 'modifyQuality'); 
	 add_filter( 'jpeg_quality', 'modifyQuality' );

	function modifyQuality( $quality ) {
 
		return 75;
 
	}
}
	
?>
