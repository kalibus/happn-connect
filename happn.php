<?php
	
	$ch = curl_init('https://connect.happn.fr/connect/oauth/token');
	
	curl_setopt_array($ch, array(
		CURLOPT_CONNECTTIMEOUT => 2,
		CURLOPT_HEADER => FALSE,
		CURLOPT_HTTPHEADER => array(
			'Content-Type: application/x-www-form-urlencoded',
			'User-Agent: happn/713 CFNetwork/672.0.8 Darwin/14.0.0'
		),
		CURLOPT_PORT => 443,
		CURLOPT_POST => TRUE,
		CURLOPT_POSTFIELDS => http_build_query(array(
			'assertion_type' => 'facebook_access_token',
			'assertion' => '', // This should be obtained from Charles Proxy
			'scope' => 'mobile_app',
			'grant_type' => 'assertion',
			'client_secret' => '', // This should be obtained from Charles Proxy
			'client_id' => '' // This should be obtained from Charles Proxy
		)),

		CURLOPT_RETURNTRANSFER => TRUE
	));
	
	$response = curl_exec($ch);
	
	if ($response === FALSE)
	{
		$error = curl_error($ch);
		
		curl_close($ch);
		
		exit($error);
	}
	
	curl_close($ch);
	
	$json = json_decode($response, TRUE);
	
	if (isset($json['error_code']) && ! $json['error_code'])
	{
		$access_token = $json['access_token'];
	}
	else
	{
		exit("Could not get a valid access token");
	}
	
	// Find people who we have crossed paths with
	echo "rechasados";
	$ch = curl_init('https://api.happn.fr/api/users/me');
	
	curl_setopt_array($ch, array(
		
		CURLOPT_HTTPHEADER => array(
			'Authorization: OAuth="'.$access_token.'"',
			'User-Agent: happn/713 CFNetwork/672.0.8 Darwin/14.0.0'
		),
		CURLOPT_CUSTOMREQUEST => "PUT",
		CURLOPT_POSTFIELDS => http_build_query(array(

			"about"=>"estado 2",
			"age"=>25,
			"birth_date"=>"",
			"credits"=>10,
			"display_name"=>"",
			"distance"=>19999.0,
			"fb_id"=>,
			"first_name"=>"Tomas2",
			"gender"=>"male",
			"id"=>"4520683970",
			"is_action_processing"=>true,
			"job"=>"estado 2b",
			"last_name"=>"",
			"login"=>"email",
			"matching_age_max"=>26,
			"matching_age_min"=>18,
			"matching_distance"=>500,
			"matching_female"=>1,
			"matching_male"=>0,
			"role"=>"CLIENT",
			"school"=>"estado 2c",
			"unread_conversations"=>0,
			"workplace"=>"estado 2d",
			"error_code"=>0,
			"status"=>0,
			"success"=>true
		)),
		CURLOPT_RETURNTRANSFER => TRUE
	));
		
	$response = curl_exec($ch);
	$json = json_decode($response, TRUE);
	echo json_encode($json,JSON_PRETTY_PRINT)

	
	?>
