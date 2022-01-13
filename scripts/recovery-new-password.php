<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Регистрация</title>
  <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body onload="get_hash();">
	<div class="main">
  	<h1 class="form-title">Восстановление пароля</h1>
  	<form id="authorization-block" action="new-password-to-DB.php" method="post">
  	  <div class="row1 required">
    	<label class="" for="email">Введите новый пароль</label><br>
		<input id="password" type="password" name="password" placeholder="6+ латинских букв или цифр" pattern="[0-9A-Za-z]{6,}" required>
		<label><input type="checkbox" class="password-checkbox" onclick="change_password_type();"> Показать пароль</label>
      </div>
      <div class="row2 required">
      	<input type="text" name="hash" id="hash" style="visibility: hidden; position: absolute;">
      </div>
	  <div class="button">
	    <button type="submit" class="btn">Принять</button>
	  </div>
  	</form>
  	<script type="text/javascript">
  	  function get_hash() {
  	  	let params = (new URL(document.location)).searchParams;
  	  	let hash = params.get("hash");
  	  	document.getElementById('hash').value = hash;
  	  }

	  function change_password_type() {
		  let elem = document.getElementById('password');
		  attribute = elem.getAttribute('type');
		  if (attribute == 'password') {
			elem.setAttribute('type', 'text');
			} else {
			  elem.setAttribute('type', 'password');
		  }
	  }
	</script>
</body>
</html>
