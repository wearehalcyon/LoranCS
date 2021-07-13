@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Install :: Step 1')

@section('content')
    <div class="form-card">
        <div class="form-logo">
            <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
        </div>
        <h1>Installation - Step 1</h1>
        <p class="desc">Preparing Database & System Requirements</p>
        <div class="database-rules">
            <table class="einstall" cellpadding="0" cellspacing="0">
                <thead></thead>
                <tbody>
                    <tr>
                        <td class="title"><strong>Note</strong></td>
                        <td class="value"><strong>In Fact</strong></td>
                    </tr>
                    <tr>
                        <td class="left-column">For first please create database on your server</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td class="left-column">Check your Database connection in .ENV file. You can find this file in your domain root folder.<code>{{ $_SERVER['DOCUMENT_ROOT'] . '/.env' }}</code></td>
                        <td>{!! $env !!}</td>
                    </tr>
                    <tr>
                        <td class="left-column">Check your PHP version. Minimum required version is <strong>7.4</strong> or newer.</td>
                        <td>{!! $php !!}</td>
                    </tr>
                    <tr>
                        <td class="left-column">Minimum RAM memory required <strong>32MB</strong>. This required for better performance.</td>
                        <td>{!! $ram !!}</td>
                    </tr>
                    <tr>
                        <td class="left-column">Minimum disk free space should be more than <strong>300MB</strong>.</td>
                        <td>{!! $dfs !!}</td>
                    </tr>
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>
        <div class="run-installation">
            <a href="{{ route('einstall-step-2') }}" class="button button-large">Continue Installation</a>
        </div>
        <div class="copyright">Copyright by INTAKE Digital &copy {{ date('Y') }}<br>Version: 1.0.2</div>
    </div>
@endsection

@section('footer-scripts')
    <script>
        $('span.status-message').each(function(){
            if ( $(this).data('status') == 'not-approved' ) {
                $('.run-installation').html('<span class="cant-continue-installation">You can\'t continue installation at the moment. It seems like one of system requirements from table is not able to work with HypeForm Engine. Please check all requirements, fix and try again!</span>');
            }
        });
    </script>
@endsection
