<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<script>
    fetch("http://eeats.com/api.php?endpoint=getUserById&id=1", {
        method: "GET"
    })
    .then(r =>r.json())
    .then( r => {
        console.log(r);
    })
</script>
</body>
</html>