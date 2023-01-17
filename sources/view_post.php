<?php
if ($wo['loggedin'] == false || $wo['config']['common_things'] != 1) {
  header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
  exit();
}
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'view_post';
$wo['title']       = $wo['config']['siteTitle'];
$wo['content']     = Wo_LoadPage('common_things/view_post');