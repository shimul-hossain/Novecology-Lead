<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('check') }}" method="POST">
        @csrf
        <input type="text" name="fiscal"> 
        <input type="text" name="facture">
        <input type="submit" value="Submit">
    </form>
</body>
</html>