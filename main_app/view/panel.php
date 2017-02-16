<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="/picktures/main_app/css/panel.css">
</style>
</head>
<body>
<?php echo '<p>You are ' . $LoginHandler->nickname . ' in the ' . $LoginHandler->returnperm($LoginHandler->nickname) . ' group</p>'; ?>
