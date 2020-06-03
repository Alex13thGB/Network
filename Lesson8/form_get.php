<html>
 <body> <form method="GET"> 
<!--указание метода GET--> Login: <input type="text" name="login"><br>
 E-mail: <input type="text" name="email"><br>
 <input type="submit" value="Отправить"> </form>
<?php 
//С помощью суперглобального массива $_GET
 //выводим принятые значения:
 echo "<br/>login = ". $_GET['login'];
 echo "<br/>email = ". $_GET['email'];?>
 </body> 
</html>
