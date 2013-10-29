<?php
class Helper{
	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	public static function get_gavatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}

	public static function get_flavor($id=null){
		if($id==null){
			$id = DB::table('flavor')->orderBy(DB::raw('RAND()'))->pluck('id');
		}
		return DB::table('flavor')->where('id', $id)->pluck('name');
	}
	public static function replaceAtReplies($text){
		return preg_replace('/(\@)(\w+)/', '<a href="'.URL::to('user/$2/profile').'">$1$2</a>', $text);
	}
	public static function queryMinecraft( $IP, $Port = 25565, $Timeout = 2 )
	{
		$Socket = Socket_Create( AF_INET, SOCK_STREAM, SOL_TCP );

		Socket_Set_Option( $Socket, SOL_SOCKET, SO_SNDTIMEO, array( 'sec' => (int)$Timeout, 'usec' => 0 ) );
		Socket_Set_Option( $Socket, SOL_SOCKET, SO_RCVTIMEO, array( 'sec' => (int)$Timeout, 'usec' => 0 ) );

		if( $Socket === FALSE || @Socket_Connect( $Socket, $IP, (int)$Port ) === FALSE )
		{
			return FALSE;
		}

		Socket_Send( $Socket, "\xFE\x01", 2, 0 );
		$Len = Socket_Recv( $Socket, $Data, 512, 0 );
		Socket_Close( $Socket );

		if( $Len < 4 || $Data[ 0 ] !== "\xFF" )
		{
			return FALSE;
		}

		$Data = SubStr( $Data, 3 ); // Strip packet header (kick message packet and short length)
		$Data = iconv( 'UTF-16BE', 'UTF-8', $Data );

		// Are we dealing with Minecraft 1.4+ server?
		if( $Data[ 1 ] === "\xA7" && $Data[ 2 ] === "\x31" )
		{
			$Data = Explode( "\x00", $Data );

			return Array(
				'HostName' => $Data[ 3 ],
				'Players' => IntVal( $Data[ 4 ] ),
				'MaxPlayers' => IntVal( $Data[ 5 ] ),
				'Protocol' => IntVal( $Data[ 1 ] ),
				'Version' => $Data[ 2 ]
			);
		}

		$Data = Explode( "\xA7", $Data );

		return Array(
			'HostName' => SubStr( $Data[ 0 ], 0, -1 ),
			'Players' => isset( $Data[ 1 ] ) ? IntVal( $Data[ 1 ] ) : 0,
			'MaxPlayers' => isset( $Data[ 2 ] ) ? IntVal( $Data[ 2 ] ) : 0,
			'Protocol' => 0,
			'Version' => '1.3'
		);
	}
}