<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h6>Name: {{ $contactMessage->name }}</h6>
    <h6>Phone: {{ $contactMessage->Phone }}</h6>
    <h6>Message:</h6>
    <p>{!! $contactMessage->body !!}</p>
</body>

</html>