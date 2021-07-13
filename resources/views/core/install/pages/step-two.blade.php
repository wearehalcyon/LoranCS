@extends('layouts.core-app')

@section('site-title', config('app.name', 'Laravel') . ' - Install :: Step 2')

@section('content')
    <div class="form-card">
        <div class="form-logo">
            <img src="{{ asset('public/includes/images/loran-logo-colored.svg') }}" alt="HypeForm CMS Logo">
        </div>
        <h1>Installation - Step 2</h1>
        <p class="desc">Create your own Administrator account</p>
        <form action="{{ route('einstall-create-account') }}" method="POST">
            @csrf
            <div class="database-rules">
                <table class="einstall" cellpadding="0" cellspacing="0">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td class="title"><strong>Description</strong></td>
                            <td class="value finish"><strong>Field</strong></td>
                        </tr>
                        <tr>
                            <td class="left-column">Name</td>
                            <td><input type="text" name="name" autofocus="off" autocomplete="off" autofill="off" placeholder="John Doe"></td>
                        </tr>
                        <tr>
                            <td class="left-column">Email</td>
                            <td><input type="email" name="email" autofocus="off" autocomplete="off" autofill="off" placeholder="example@example.com"></td>
                        </tr>
                        <tr>
                            <td class="left-column">Password</td>
                            <td><input type="password" name="password" autofocus="off" autocomplete="off" autofill="off" placeholder="&S6df9a9S^D&("></td>
                        </tr>
                        <tr>
                            <td class="left-column">Site Name</td>
                            <td><input type="text" name="sitename" autofocus="off" autocomplete="off" autofill="off" placeholder="My Website"></td>
                        </tr>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
            <div class="run-installation">
                <button type="submit" class="button button-large">Finish Installation</button>
            </div>
        </form>
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
