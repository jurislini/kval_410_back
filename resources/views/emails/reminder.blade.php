<!DOCTYPE html>
<html>
<head>
    <title>Reminder</title>
</head>
<body>
    <p>Title: {{ $title }}</p>
    <p>Description: {{ $description }}</p>
    <p>Date: {{ $date }}</p>
    @if($latitude && $longitude)
        <p>Location: Latitude - {{ $latitude }}, Longitude - {{ $longitude }}</p>
    @endif
</body>
</html>