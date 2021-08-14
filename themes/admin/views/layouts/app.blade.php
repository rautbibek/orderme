<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500&display=swap" rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{'Admin'}}</title>
    <style>
        body{
            margin:0px;
            padding:0px;
            font-family:Roboto,sans-serif;
        }
        .image-container{
            height:50px;
            width:150px;
            border-radius:50%;
            background:#cdd1d6;
            position:relative;
            
            
        }
        .img{
            position:absolute;
            top:-120px;
            height:150px;
            width:150px;
        }
        .wrapper{
            display:flex;
            justify-content:center;
            align-items:center;
            background:#eaeff5;
            height:100vh;
        }
        .login-container {
            display: flex;
            justify-content: center;
            padding:20px;
            
            border-radius: 10px;
            box-shadow: 32px 81px 357px 200px rgba(33,33,33,0.19);
            -webkit-box-shadow: 32px 81px 357px 200px rgba(33,33,33,0.19);
            -moz-box-shadow: 32px 81px 357px 200px rgba(33,33,33,0.19);
            
        }
        .login-card {
            
            
        }
        .custom-textbox{
            height:32px;
            width:350px;
            padding:5px;
            border-radius:2px;
            border:1px solid black;
            margin:10px 0px 10px 0px;

            
        }
        .custom-textbox:focus{
            border:1px solid black;
        }
        .custom-textbox:focus {
            border:none;
        }
        
       .login-button{
           height:40px;
           width:100%;
           margin-top:20px;
           border-radius:10px;
           border:none;
           background-color:green;
           color:white;

       }
       .header-title{
           font-size:18px;
           font-weight:500;
           text-align:center;
           margin-top:20px;
       }
       .group{
           width:100%;
       }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('themes/admin/js/app.js') }}" defer></script>

</head>
<body>
    {{ $slot }}
</body>
</html>
