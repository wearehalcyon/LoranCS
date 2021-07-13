<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ Core::getOption('sitename') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    {{ Core::enqueueStyles() }}
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header_container">
            <div class="top">
                <div class="logo">
                    <a href="{{ Core::getOption('siteurl') }}">
                        <h2>{{ Core::getOption('sitename') }}</h2>
                    </a>
                </div><!-- Header Logo -->
                <div class="header_menu">
                    {{ Core::getMenu('main_menu') }}
                </div><!-- Header Menu -->
            </div>
            <div class="hero">
                <div class="hero_text">
                    <h1>{{ Core::getOption('sitename') }}</h1>
                    <h3>{{ Core::getOption('sitedesc') }}</h3>
                </div>
            </div>
        </div>
    </header>
