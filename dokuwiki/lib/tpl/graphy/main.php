<?php
/**
 * DokuWiki Graphy Template
 * Based on the starter template and a wordpress theme of the same name
 *
 * @link     http://dokuwiki.org/template:graphy
 * @author   desbest <afaninthehouse@gmail.com>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die(); /* must be run from within DokuWiki */
@require_once(dirname(__FILE__).'/tpl_functions.php'); /* include hook for template functions */
header('X-UA-Compatible: IE=edge,chrome=1');

$showTools = !tpl_getConf('hideTools') || ( tpl_getConf('hideTools') && !empty($_SERVER['REMOTE_USER']) );
$showSidebar = page_findnearest($conf['sidebar']) && ($ACT=='show');
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <script defer type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel="stylesheet" id="graphy-font-css" href="https://fonts.googleapis.com/css?family=Source+Serif+Pro%3A400%7CLora%3A400%2C400italic%2C700&amp;subset=latin%2Clatin-ext" type="text/css" media="all">

</head>

<body id="dokuwiki__top">

<div id="page" class="hfeed site <?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
    <a class="skip-link screen-reader-text" href="#content">Skip to content</a>

    <header id="masthead" class="site-header">
        <?php tpl_includeFile('header.html') ?>

        <div class="site-branding">
        <?php /* how to insert logo instead (if no CSS image replacement technique is used):
                        upload your logo into the data/media folder (root of the media manager) and replace 'logo.png' accordingly:
                        tpl_link(wl(),'<img src="'.ml('logo.png').'" alt="'.$conf['title'].'" />','id="dokuwiki__top" accesskey="h" title="[H]"') */ ?>
        <div class="site-title"><?php tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?></div>
        <?php if ($conf['tagline']): ?>
            <div class="site-description"><?php echo $conf['tagline'] ?></div>
        <?php endif ?>
        <!-- header_social menu -->
            <nav id="header-social-link" class="header-social-link social-link">
                <?php //wp_nav_menu( array( 'theme_location' => 'header-social', 'depth' => 1, 'link_before'  => '<span class="screen-reader-text">', 'link_after'  => '</span>' ) ); ?>
            </nav><!-- #header-social-link -->
        </div><!-- .site-branding -->

        <!-- graphy_hide_navigation -->
        <nav id="site-navigation" class="main-navigation">

            <button class="menu-toggle"  aria-controls="primary-menu" aria-expanded="false"><span class="menu-text">Menu</span></button>
            <div class="menu-my-first-menu-container"><ul id="menu-my-first-menu" class="menu nav-menu" aria-expanded="false">
                <!-- SITE TOOLS -->
                <?php tpl_toolsevent('sitetools', array(
                    'recent'    => tpl_action('recent', 1, 'li', 1),
                    'media'     => tpl_action('media', 1, 'li', 1),
                    'index'     => tpl_action('index', 1, 'li', 1),
                )); ?>
                <div class="search-form"><?php tpl_searchform() ?></div>
        </ul></div>
            <!-- primary menu -->
            
        </nav><!-- #site-navigation -->

        <div id="header-image" class="header-image">
            <img src="" width="" height="" alt=""> <!-- img graphy-page-thumbnail -->
        </div><!-- #header-image -->

    </header><!-- #masthead -->

    <div id="primary" class="content-area"><main id="main" class="site-main">
    <div id="content" class="site-content">

        <?php
        /**
        * The template used for displaying single post.
        *
        * @package Graphy
        */
        ?>

        <ul class="a11y skip">
        <li><a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a></li>
        </ul>

        <div class="post-full post-full-summary">
        <article <?php //post_class(); ?>>
            <div class="entry-content">
                <!-- BREADCRUMBS -->
                <?php if($conf['breadcrumbs']){ ?>
                <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                <?php } ?>
                <?php if($conf['youarehere']){ ?>
                <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                <?php } ?>

                <?php tpl_flush() /* flush the output buffer */ ?>
                <?php tpl_includeFile('pageheader.html') ?>

                <div class="padhere2"><?php html_msgarea() /* occasional error and info messages on top of the page */ ?></div>

                <div class="page" id="dokuwiki__content">
                    
                    <!-- wikipage start -->
                    <?php tpl_content() /* the main content */ ?>
                    <!-- wikipage stop -->
                    <div class="clearer"></div>
                </div>

                <?php tpl_flush() ?>
                <?php tpl_includeFile('pagefooter.html') ?>
                <?php //wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'graphy' ), 'after'  => '</div>', 'pagelink' => '<span class="page-numbers">%</span>',  ) ); ?>
            </div><!-- .entry-content -->
        </article><!-- #post-## -->
        </div><!-- .post-full -->


</div> <!-- #content -->
</main></div> <!-- main and primary -->

<!-- begin sidebar -->
<div id="secondary" class="sidebar-area" role="complementary">
    <div class="normal-sidebar widget-area">
        <div class="normal-sidebar widget-area">

            <aside id="writtensidebar" class="widget">
            <!-- ********** ASIDE ********** -->
            <?php if ($showSidebar): ?>
                <?php tpl_includeFile('sidebarheader.html') ?>
                <?php tpl_include_page($conf['sidebar'], 1, 1) /* includes the nearest sidebar page */ ?>
                <?php tpl_includeFile('sidebarfooter.html') ?>
                <div class="clearer"></div>
            <?php endif; ?>
            </aside>

            <aside class="widget">
            <h2 class="widget-title">Page Tools</h2><ul>

            <!-- PAGE ACTIONS -->
            <?php if ($showTools): ?>
            <h3 class="a11y"><?php echo $lang['page_tools'] ?></h3>
                <?php tpl_toolsevent('pagetools', array(
                    'edit'      => tpl_action('edit', 1, 'li', 1),
                    'discussion'=> _tpl_action('discussion', 1, 'li', 1),
                    'revisions' => tpl_action('revisions', 1, 'li', 1),
                    'backlink'  => tpl_action('backlink', 1, 'li', 1),
                    'subscribe' => tpl_action('subscribe', 1, 'li', 1),
                    'revert'    => tpl_action('revert', 1, 'li', 1),
                    //'top'       => tpl_action('top', 1, 'li', 1),
                )); ?>
            <?php endif; ?>
            </ul></aside>      

            <?php if ($conf['useacl'] && $showTools): ?><aside class="widget"><!-- USER TOOLS -->
            <h2 class="widget-title">User Tools</h2><ul>

             
                
                <h3 class="a11y"><?php echo $lang['user_tools'] ?></h3>
                    <?php
                        if (!empty($_SERVER['REMOTE_USER'])) {
                            echo '<li class="user">';
                            tpl_userinfo(); /* 'Logged in as ...' */
                            echo '</li>';
                        }
                    ?>
                    <?php /* the optional second parameter of tpl_action() switches between a link and a button,
                             e.g. a button inside a <li> would be: tpl_action('edit', 0, 'li') */
                    ?>
                    <?php tpl_toolsevent('usertools', array(
                        'admin'     => tpl_action('admin', 1, 'li', 1),
                        'userpage'  => _tpl_action('userpage', 1, 'li', 1),
                        'profile'   => tpl_action('profile', 1, 'li', 1),
                        'register'  => tpl_action('register', 1, 'li', 1),
                        'login'     => tpl_action('login', 1, 'li', 1),
                    )); ?>
                
            
            </ul></aside><?php endif ?>    
        </div>
    </div><!-- .normal-sidebar -->
</div><!-- #secondary -->
<!-- end sidebar -->


    <footer id="colophon" class="site-footer">

        <!-- footer sidebar -->

        <div class="site-bottom">

            <div class="site-info">
                <div class="site-copyright">
                    &copy; <?php echo date( 'Y' ); ?> <a href="addhere" rel="home"><?php tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?></a>
                </div><!-- .site-copyright -->
                <div class="site-credit">
                    <a href="">Powered by Dokuwiki</a>
                    <span class="site-credit-sep"> | </span>
                    <a href="http://dokuwiki.org/theme:graphy">Graphy theme by desbest and Themegraphy</a>
                     <div class="doc"><?php tpl_pageinfo() /* 'Last modified' etc */ ?></div>
                     <?php tpl_license('button') /* content license, parameters: img=*badge|button|0, imgonly=*0|1, return=*0|1 */ ?>
                     <?php tpl_includeFile('footer.html') ?>
                </div><!-- .site-credit -->
            </div><!-- .site-info -->

        </div><!-- .site-bottom -->

    </footer><!-- #colophon -->

</div><!-- #page -->


<!-- end of graphy -->


    <?php /* with these Conditional Comments you can better address IE issues in CSS files,
             precede CSS rules by #IE8 for IE8 (div closes at the bottom) */ ?>
    <!--[if lte IE 8 ]><div id="IE8"><![endif]-->

    <?php /* the "dokuwiki__top" id is needed somewhere at the top, because that's where the "back to top" button/link links to */ ?>
    <?php /* tpl_classes() provides useful CSS classes; if you choose not to use it, the 'dokuwiki' class at least
             should always be in one of the surrounding elements (e.g. plugins and templates depend on it) */ ?>




    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
    <!--[if lte IE 8 ]></div><![endif]-->

    <script defer type="text/javascript" src="<?php echo tpl_basedir();?>/navigation.js"></script>
    <!-- due to the way dokuwiki buffers output, this javascript has to
            be before the </body> tag and not in the <head> -->
</body>
</html>
