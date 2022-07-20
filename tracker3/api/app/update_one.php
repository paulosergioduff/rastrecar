<?php
include_once("config.php");





 function sendMessage(){
        $content = array(
            "en" => 'PLACA: IZH4A73 | IGNIÇÃO DESLIGADA'
            );
			
		$headings = array(
            "en" => 'NOTIFICAÇÃO'
            );

        
        $fields = array(
            'app_id' => "3abaea79-1774-4b00-b465-7ec421533144",
           'filters' => array(array("field" => "tag", "key" => "CPF", "relation" => "=", "value" => "46744444034")),
            'contents' => $content, 
			'template_id' => '43b05f72-03c0-4ce9-a8fd-983023a96fca'
        );
        
        $fields = json_encode($fields, JSON_FORCE_OBJECT);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic YmI0ZTNmNmEtZjIzOS00MjBiLWFkOGItMDQ0NTU4ODI0OWI1'));
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