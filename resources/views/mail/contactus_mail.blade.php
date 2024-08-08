<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ ucfirst(config('app.name')) }}</title>
</head>

<body>
    <p>Name: {{ $data['username'] }}</p>
    <p>Email Id: {{ $data['email'] }}</p>
    <p>Phone Number: {{ $data['phone'] }}</p>
    <p>Subject: {{ $data['subject'] }}</p>
    <p>Message: {{ $data['message'] }}</p>
</body>

</html>
