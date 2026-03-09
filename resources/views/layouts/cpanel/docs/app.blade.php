@extends('layouts.cpanel.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet"/>
    <style>
        pre[class*="language-"] { border-radius: 8px; max-height: 500px; overflow-y: auto; }
        .doc-section { margin-bottom: 2rem; }
        .doc-section h2 { border-bottom: 2px solid #eff2f5; padding-bottom: 0.5rem; margin-bottom: 1rem; }
        .copy-btn { position: absolute; top: 8px; right: 8px; z-index: 10; }
        .code-block { position: relative; }
    </style>
    @yield('doc_style')
@stop

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-bash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-markup.min.js"></script>
    <script>
        // Copy button functionality
        document.querySelectorAll('.copy-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var code = this.closest('.code-block').querySelector('code').textContent;
                navigator.clipboard.writeText(code).then(function() {
                    toastr.success('Copied to clipboard!');
                });
            });
        });
    </script>
    @yield('doc_script')
@stop
