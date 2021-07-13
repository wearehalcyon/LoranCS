@extends('myadmin.main')

@section('head-title', 'Dashboard - Documentation - ' . Core::getOption('sitename'))

@section('title', 'Documentation')

@section('content')
    <div class="docs_tabs">
        <div class="docs_links">
            <ul>
                <li class="tabname active"><a href="#laravel">Laravel Dovumentation</a></li>
                <li class="tabname"><a href="#start">Loran Start</a></li>
                <li class="tabname"><a href="#development">Theme Development</a></li>
            </ul>
        </div>
        <div class="docs_content">
            <ul>
                <li id="laravel" class="tab_content active">
                    <div class="tabcontent">
                        @include('myadmin.partials.docs.laravel')
                    </div>
                </li>
                <li id="start" class="tab_content">
                    <div class="tabcontent">
                        @include('myadmin.partials.docs.loran')
                    </div>
                </li>
                <li id="development" class="tab_content">
                    <div class="tabcontent">
                        @include('myadmin.partials.docs.development')
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection
