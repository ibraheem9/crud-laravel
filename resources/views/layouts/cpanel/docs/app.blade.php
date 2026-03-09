@extends('layouts.cpanel.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet"/>
    <style>
        /* ─── Documentation Styles ─────────────────────────────── */
        .doc-section { margin-bottom: 2.5rem; }
        .doc-section h2 {
            font-size: 1.15rem; font-weight: 700; color: #0f172a;
            border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 16px;
        }
        .doc-section h5 {
            font-size: 0.95rem; font-weight: 600; color: #1e293b;
            display: flex; align-items: center; gap: 8px;
        }
        .doc-section h5 .method-badge {
            font-size: 0.65rem; font-weight: 600; padding: 3px 8px;
            border-radius: 4px; text-transform: uppercase; letter-spacing: 0.04em;
        }
        .doc-section p { color: #475569; font-size: 0.86rem; line-height: 1.7; }

        /* Code blocks */
        .code-block {
            position: relative; margin-bottom: 16px;
        }
        .code-block pre[class*="language-"] {
            border-radius: 10px; max-height: 500px; overflow-y: auto;
            margin: 0; font-size: 0.82rem; line-height: 1.65;
            border: 1px solid #1e293b;
        }
        .copy-btn {
            position: absolute; top: 10px; right: 10px; z-index: 10;
            background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.15);
            color: #94a3b8; border-radius: 6px; padding: 4px 10px; font-size: 0.75rem;
            cursor: pointer; transition: all 0.15s;
        }
        .copy-btn:hover { background: rgba(255,255,255,0.2); color: #e2e8f0; }

        /* Info boxes */
        .info-box {
            background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px;
            padding: 14px 18px; margin-bottom: 16px; font-size: 0.84rem; color: #1e40af;
        }
        .info-box i { margin-right: 8px; }
        .warning-box {
            background: #fefce8; border: 1px solid #fde68a; border-radius: 10px;
            padding: 14px 18px; margin-bottom: 16px; font-size: 0.84rem; color: #92400e;
        }
        .warning-box i { margin-right: 8px; }
        .success-box {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px;
            padding: 14px 18px; margin-bottom: 16px; font-size: 0.84rem; color: #166534;
        }
        .success-box i { margin-right: 8px; }

        /* Params table */
        .params-table { font-size: 0.82rem; }
        .params-table th {
            font-weight: 600; font-size: 0.75rem; text-transform: uppercase;
            color: #64748b; letter-spacing: 0.04em; background: #f8fafc;
        }
        .params-table td { vertical-align: top; }
        .params-table code {
            background: #f1f5f9; padding: 2px 6px; border-radius: 4px;
            font-size: 0.78rem; color: #0f172a;
        }
        .params-table .type-badge {
            font-size: 0.68rem; padding: 2px 8px; border-radius: 4px;
            font-weight: 600;
        }

        /* Flow diagram */
        .flow-step {
            display: flex; align-items: flex-start; gap: 14px; margin-bottom: 16px;
        }
        .flow-step .step-number {
            width: 28px; height: 28px; border-radius: 8px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.78rem; color: #fff;
            background: var(--primary);
        }
        .flow-step .step-content h6 { font-size: 0.88rem; font-weight: 600; margin-bottom: 2px; }
        .flow-step .step-content p { font-size: 0.82rem; color: #64748b; margin: 0; }
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
