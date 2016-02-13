<?PHP
  function sendMessage(){
    $content = array(
      "en" => $_POST["bodyNotif"]
      );
    
    $headings = array("en" => $_POST["titleNotif"]);
    
    $fields = array(
      'app_id' => "da5b14bd-1376-4eda-af11-3bbf4c6b28f4",
      'included_segments' => array('All'),
      'contents' => $content,
      'headings' => $headings
    );
    
    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                           'Authorization: Basic NDk1MmNmN2UtZTY5MS00YzZhLTk1NmEtOTA0ZDI2NDU1ZmVh'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
    
    return $response;
  }
  
  $response = sendMessage();
  $return["allresponses"] = $response;
  $return = json_encode( $return);
  
  print("\n\nJSON received:\n");
  print($return);
  print("\n");
?>