<!DOCTYPE html>
<html>
<head>
    <title>Подтверждение Email</title>
</head>
<body>
<h1>Подтверждение Email</h1>
<p>Для завершения регистрации, перейдите по следующей ссылке:</p>
<a href="{{ $confirmationLink }}">Подтвердить Email</a>
<p>Спасибо,<br>{{ config('app.name') }}</p>
</body>
</html>
