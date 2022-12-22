<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script>
    console.log('here');
    if(Echo.channel('websocket')){
        console.log('1');
    }else{
        console.log('0');
    }
    Echo.channel('websocket').listen('NewMessage',(e) => {
        console.log('1');
    });
</script>
</html>