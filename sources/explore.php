    <?php

global $sqlConnect;
$data      = array();

$query     = " SELECT * FROM Wo_Pages WHERE active = '1' ORDER BY RAND() LIMIT 100";
$sql_query = mysqli_query($sqlConnect, $query);
while ($item = mysqli_fetch_assoc($sql_query)) {

    if($item['lat'] != "" && $item['lng'] != ""){
        $VisURL = $wo['site_url'].'/'.$item['page_name'];
        //$data['title']=$item['page_name'];
        $data[]= array('title' => $item['page_name'],
            'lat' => $item['lat'],
            'lng' => $item['lng'],
            'description' => '<div class="info_content"><p>'.$item['page_title'].'</p><br/> <i class="fa fa-globe"></i> <a title="Open Page" target="_blank" style="text-decoration: none; border:1px solid green; padding:5px; border-radius:10px;" href='.$VisURL.'>'.$item['page_title'].'</a></div>'
        );
    }
}
$wo['rendom_user']        = $data;
$wo['description'] = '';
$wo['keywords']    = '';
$wo['page']        = 'explore';
$wo['title']       = $wo['lang']['search'] . ' | ' . $wo['config']['siteTitle'];
if ($wo['config']['website_mode'] == 'linkedin') {
    $wo['content'] = Wo_LoadPage('explore/linkedin');
} else {
    $wo['content'] = Wo_LoadPage('explore/content');
}
