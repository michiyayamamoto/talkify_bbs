<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>聞きたいトピックを投稿しよう</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    @yield("extra_head")

</head>
<body>
    
    <a href="{{ route('topics.index') }}"><h1 style="background:orange;color:white;text-align:center;">質問したいことを投稿</h1></a>
    <main class="container">@yield("main")</main>
    
</body>
</html>