<?php
/**
 * Created by PhpStorm.
 * User: xing
 * Date: 27/08/2017
 * Time: 11:40 AM
 */

function main()
{
	$arrDataSource	=
	[
		'province'	=> 'https://github.com/liuqixing/china_regions/raw/master/json/province.json',
		'city'		=> 'https://github.com/liuqixing/china_regions/raw/master/json/city.json',
		'district'	=> 'https://github.com/liuqixing/china_regions/raw/master/json/area.json',
	];
	$arrJson	= [];
	$sOutputJson	= '';
	$sOutputPhp	= '';

	foreach ( $arrDataSource as $sKey => $sUrl )
	{
		$sContent	= file_get_contents( $sUrl );
		if ( is_string( $sContent ) && strlen( $sContent ) > 0 )
		{
			$arrJson[ $sKey ] = @ json_decode( $sContent, true );
		}
		else
		{
			echo "#	FAILED FETCH DATA( $sUrl ).\n";
			exit();
		}
	}

	//
	//	json
	//
	$sOutputJson  = "window.g_de_china_regions={";
	foreach ( $arrJson as $sKey => $arrData )
	{
		$sOutputJson .= ( "\"" . $sKey . "\":" . json_encode( $arrData ) . "," );
	}
	$sOutputJson .= "\"json\":1}";

	//	...
	file_put_contents( 'dist/dechinaregions.js', $sOutputJson );
	file_put_contents( 'dist/dechinaregions.json', json_encode( $arrJson ) );
}


//
//	...
//
main();