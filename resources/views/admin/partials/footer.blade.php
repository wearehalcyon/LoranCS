<footer class="footer">
    <div class="thankyou">
        {!! __('<em>Thank you for using ' . Core::App()['appurl'] . '.</em>') !!}
    </div>
    <div class="version">
        @if(Core::serverAPI()['version'] > Core::App()['ver'])
            {!! __('<em><a href="' . route('my-admin-core-update') . '">Available new version - ' . Core::serverAPI()['version'] . '</a></em>') !!}
        @else
            {!! __('<em>Version: ' . Core::App()['ver'] . ' Build: ' . Core::App()['build'] . ' [' . Core::App()['release'] . ']</em>') !!}
        @endif
    </div>
</footer>
