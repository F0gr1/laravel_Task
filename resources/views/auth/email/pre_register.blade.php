<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>サイトへの仮登録が完了しました</h2><br>
    <br>
    <p>以下のURLからログインして、本登録を完了させてください</p>
    {{url('register/verify/'.$token)}}
</body>
</html>