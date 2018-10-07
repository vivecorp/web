<? include('numeros.php'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Conversion numeros a letras</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>

<body onLoad="document.forma1.cantidad.focus();">
<form name="forma1" action='<? echo $_SERVER['PHP_SELF']; ?>' method="post">
	<input type="text" name="cantidad" value='<? echo $_POST['cantidad']; ?>' size="50" maxlength="21" />&nbsp;&nbsp;
	<input type="submit" name="boton1" value="Convertir..."><br /><br />
	<textarea cols="70" rows="5"><?	echo numtoletras($_POST['cantidad']);	?></textarea>
	<br />
	
</form>
</body>
</html>
