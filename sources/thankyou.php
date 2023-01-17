<?php
if ($wo['loggedin'] == false || $wo['config']['common_things'] != 1) {
    header("Location: " . Wo_SeoLink('index.php?link1=welcome'));
    exit();
}
$wo['description'] = $wo['config']['siteDesc'];
$wo['keywords']    = $wo['config']['siteKeywords'];
$wo['page']        = 'feedback';
$wo['title']       = $wo['config']['siteTitle'];
$wo['content']     = Wo_LoadPage('feedback/thankyou');
