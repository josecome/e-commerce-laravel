<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
</head>
<body>
    {{ Request::get("p") }}
    <script>
        const goToHomePage = () => {window.location.replace('/');}
        const waitingTime = setTimeout(goToHomePage, 4000);
    </script>
</body>
</html>
