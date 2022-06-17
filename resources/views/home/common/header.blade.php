<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>学之源</title>
  
  	@if ($system->font == 2)
        <link rel="stylesheet" href="{{URL::asset('Home/css/font-fzyt.css')}}">
    @else
        <link rel="stylesheet" href="{{URL::asset('Home/css/font-default.css')}}">
    @endif
  
    <link rel="stylesheet" href="{{URL::asset('Home/css/public.css')}}">
    @if ($system->logo == 2)
        <link rel="stylesheet" href="{{URL::asset('Home/css/logo.css')}}">
    @endif
    @if ($system->theme == 2)
        <link rel="stylesheet" href="{{URL::asset('Home/css/theme1.css')}}">
    @elseif ($system->theme == 3)
        <link rel="stylesheet" href="{{URL::asset('Home/css/theme2.css')}}">
    @elseif ($system->theme == 4)
        <link rel="stylesheet" href="{{URL::asset('Home/css/theme3.css')}}">
    @endif
    <style>
        header {
            background: url("{{asset('storage/'.$system->banner)}}") no-repeat center right;
            background-size: cover;
        }

        @media screen and (max-width: 1200px) {
            header {
                background: url("{{asset('storage/'.$system->banner)}}") no-repeat fixed;
                background-size: 100% auto;
            }
        }
        

    </style>
</head>

<body>
    <header>
        <img src="{{asset('storage/'.$system->headimg)}}" alt="">
        <a href="/" class="top">Zero@Room</a>
        <p>{{$system->tip}}</p>
        <div class="link">
            <a href="{{$system->git}}" target="_blank"></a>
            <a href="{{$system->sina}}" target="_blank"></a>
            <a href="mailto:{{$system->qq}}"></a>
        </div>
    </header>