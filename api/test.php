<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<script>
    fetch("http://eeats.com/api.php", {
        method: "POST",
        body: JSON.stringify({ name: "example", endpoint: "saveUser" })
    })
    .then(r =>r.json())
    .then( r => {
        console.log(r);
        console.log(r.datos)
        })
</script>
</body>
</html>