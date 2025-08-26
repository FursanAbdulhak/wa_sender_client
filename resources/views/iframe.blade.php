<div>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>WhatsApp Sender Client</title>
        <style>
            .body {
                margin: 0;
                padding: 0;
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
            }

            .container {
                /* width: 100%; */
                height: 100vh;
                display: flex;
                flex-direction: column;
            }

            .header {
                background-color: #25D366;
                color: white;
                padding: 10px 20px;
                text-align: center;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .iframe-container {
                flex: 1;
                position: relative;
                overflow: hidden;
            }

            iframe {
                width: 100%;
                height: 100%;
                border: none;
                display: block;
            }

            .loading {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
                color: #666;
            }

            .spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #25D366;
                border-radius: 50%;
                width: 40px;
                height: 40px;
                animation: spin 2s linear infinite;
                margin: 0 auto 10px;
            }

            @keyframes spin {
                0% {
                    transform: rotate(0deg);
                }

                100% {
                    transform: rotate(360deg);
                }
            }

            .error {
                color: #e74c3c;
                text-align: center;
                padding: 20px;
                background-color: #fff;
                margin: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <div>
        <div class="container body">
            <div class="header">
                <h1>WhatsApp Sender Client</h1>
                @if (isset($email))
                    <p>Connected as: {{ $email }}</p>
                @endif
            </div>

            <div class="iframe-container">
                <div class="loading" id="loading">
                    <div class="spinner"></div>
                    <p>Loading WhatsApp Client...</p>
                </div>

                @if (isset($url))
                    <iframe id="whatsapp-iframe" src="{{ $url }}" onload="hideLoading()" onerror="showError()"
                        sandbox="allow-same-origin allow-scripts allow-forms allow-popups allow-top-navigation"
                        loading="lazy">
                    </iframe>
                @else
                    <div class="error">
                        <h3>Configuration Error</h3>
                        <p>No URL provided for the WhatsApp client.</p>
                    </div>
                @endif
            </div>
        </div>

        <script>
            function hideLoading() {
                const loading = document.getElementById('loading');
                if (loading) {
                    loading.style.display = 'none';
                }
            }

            function showError() {
                const loading = document.getElementById('loading');
                const container = document.querySelector('.iframe-container');

                if (loading) {
                    loading.innerHTML = `
                    <div class="error">
                        <h3>Loading Error</h3>
                        <p>Failed to load the WhatsApp client. Please check your connection and try again.</p>
                        <button onclick="location.reload()" style="
                            background-color: #25D366;
                            color: white;
                            border: none;
                            padding: 10px 20px;
                            border-radius: 5px;
                            cursor: pointer;
                            margin-top: 10px;
                        ">Retry</button>
                    </div>
                `;
                }
            }

            // Handle iframe communication if needed
            window.addEventListener('message', function(event) {
                // Handle messages from iframe if needed
                console.log('Message from iframe:', event.data);
            });

            // Auto-hide loading after timeout
            setTimeout(function() {
                const loading = document.getElementById('loading');
                if (loading && loading.style.display !== 'none') {
                    showError();
                }
            }, 30000); // 30 seconds timeout
        </script>
    </div>

</div>
