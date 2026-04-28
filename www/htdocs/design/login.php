<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8" />
	<title>ログイン</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
</head>
    
<body>
    <div id="container">
        <header>
            <h1>Labelle Co., Ltd.</h1>
            <p>GROUP-SP Personnel Management System</p>
        </header>

        <div class="">
            <form id="login" action="">
                <ul>
                    <li>
                        <label for="userid">ユーザーID</label>
                        <input type="text" id="userid">
                    </li>
                    <li>
                        <label for="password">パスワード</label>
                        <input type="password" id="password">
                    </li>
                </ul>
                <input type="submit" value="ログイン">
            </form>
        </div>
    </div>
    
    <footer>
        <p>Copyright(c) 2018 Group-SP: Personnel Management System All rights reserved.</p>
    </footer>
</body>
</html>