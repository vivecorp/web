<?php
$timezone = "America/Santiago"; // sets the timezone or region
if(function_exists('date_default_timezone_set')){ // the if function checks if setting the timezone is supported on your server first. You don't want an error thrown to the user do you..?
    date_default_timezone_set($timezone);
}
	//************************ funcion que conecta una base de datos ******************

	function fnConnect()
	{
		$cn=mysql_connect("avivei.com","adminagroanza","Aflatoxina2&");
		if(!$cn)
		{

			return 0;
		}
		$rpta = mysql_select_db("avicola",$cn);
		if(!$rpta)
		{
			$msg = "BD no existe";
			mysql_close($cn);
			return 0;
		}
		return $cn;
	}

	// **************          funcion que imprime valores en pantalla *********************

	function say($cad)
	{
		echo $cad . "\n";
	}

	// *********************    funcion que envia mensaje en pantalla *******************

	function fnShowMsg($title,$msg)
	{
		say("<table width='250'>");
		say("<tr>");
		say("<th align=center valign=middle>$title</th>");
		say("</tr>");
		say("<tr>");
		say("<td align=left valign=middle>".$msg."</td>");
		say("</tr>");
		say("</table>");
	}



	function fnLink($link,$target,$mouseover,$msg)
	{
		$cad = "<A href='$link' target='$target' ";
		$cad .= "onmouseout=\"self.status='';return true\" ";
		$cad .= "onmouseover=\"self.status='$mouseover' ;return true\">";
		$cad .= "$msg</A>";
		return $cad;
	}

	function diaEs($aux)
	{
		switch ($aux)
		{
		case "0":
			$d="Domingo";
			break;
		case "1":
			$d="Lunes";
			break;
		case "2":
			$d="Martes";
			break;
		case "3":
			$d="Miércoles";
			break;
		case "4":
			$d="Jueves";
			break;
		case "5":
			$d="Viernes";
			break;
		case "6":
			$d="Sábado";
			break;
		}


	    return $d;
	}
	function mesEs($aux)
	{
		switch ($aux)
		{
		case "1":
			$d="Enero";
			break;
		case "2":
			$d="Febrero";
			break;
		case "3":
			$d="Marzo";
			break;
		case "4":
			$d="Abril";
			break;
		case "5":
			$d="Mayo";
			break;
		case "6":
			$d="Junio";
			break;
		case "7":
			$d="Julio";
			break;
		case "8":
			$d="Agosto";
			break;
		case "9":
			$d="Septiembre";
			break;
		case "10":
			$d="Octubre";
			break;
		case "11":
			$d="Noviembre";
			break;
		case "12":
			$d="Diciembre";
			break;
		}


			return $d;
	}

	function obtNube($aux)
	{
		if($aux=="Partly Cloudy")
		{
			return "partly-cloudy-day";
		}
		if($aux=="Mostly Sunny")
		{
			return "partly-cloudy-day";
		}
		if($aux=="Sunny")
		{
			return "clear-day";
		}

		if($aux=="Mostly Cloudy")
		{
			return "cloudy";
		}
		if($aux=="Cloudy")
		{
			return "cloudy";
		}
		if($aux=="Scattered Thunderstorms")
		{
			return "rain";
		}
		if($aux=="Thunderstorms")
		{
			return "rain";
		}
	}


?>
