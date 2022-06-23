<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="" method="post">
    @csrf
    <input  required name="firstname" placeholder="Noms" type="text">
    <input  required name="numero" placeholder="numero" type="tel">
    <input required  name="montant" placeholder="montant" type="text">
    <button type="submit" name="payer" value="payer">Payer</button>
</form>
</body>
</html>
