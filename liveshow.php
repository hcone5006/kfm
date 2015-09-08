
<?php require('./wp-load.php'); ?>

<?php get_header('liveshow'); ?>

<?php //echo do_shortcode('[dj-widget title="" display_djs="1" show_avatar="1" show_link="0" default_name="" show_sched="0" show_playlist="0" show_desc="0"]'); ?>

<div class="bm-player-comment" style="width:90%;height:100px;">
If you have any trouble with high(128kbps), try normal instead<!-- <br /> -->
You'll need some kind of media player for it to work, like:<!-- <br /> -->
Windows Media Player (available for PC/Windows & Mac)<!-- <br /> -->
Winamp Player (Windows platforms only)<!-- <br /> -->
iTunes (Mac OSX & Windows 2000 or XP)<br />
<br />
<strong>KFM's internet stream sponsored by:</strong>
<a href="http://www.iconz.co.nz" target="_blank"><img border="0" style="padding: 5px;" src="/wp-content/themes/theme52169/images/spon-logo-iconz.gif" alt="iconz"></a>
</div>

<div class="liveshowbody">
<?php echo do_shortcode('[bmplayer]'); ?>
</div>

<?php get_footer('liveshow'); ?>

