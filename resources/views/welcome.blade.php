<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{route('payer')}}" method="post">
    @csrf
    <input name="firstname" placeholder="Noms" type="text">
    <input name="numero" placeholder="numero" type="tel">
    <input name="montant" placeholder="montant" type="text">
    <button type="submit" name="isValidate">Payer</button>
</form>
</body>
</html>
