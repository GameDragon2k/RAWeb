<?php
	require_once('db.inc.php');
	
	if( !ValidatePOSTChars( 'g' ) )
	{
		echo "FAILED";
		return;
	}
	
	$gameID = seekPOST('g');
	settype( $gameID, 'integer' );
	
	if( validateFromCookie( $user, $points, $permissions, Permissions::Unregistered ) )
	{
		echo "OK:";
		
		$numUnlocks = getUserUnlocksDetailed( $user, $gameID, $dataOut );
		foreach( $dataOut as $nextAwarded )
		{
			echo $nextAwarded['Title'] . " (" . $nextAwarded['Points'] . ")" . "_:_";		//	_:_ delim 1
			
			if( $nextAwarded['HardcoreMode'] == 1 )
				echo "h";
				
			echo $nextAwarded['ID'] . "::";			//	::	delim 2
		}
		
		exit;
	}
	else
	{
		echo "FAILED: Invalid User/Password combination.\n";
		exit;
	}
?>