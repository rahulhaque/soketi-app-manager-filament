<x-filament-panels::page>
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <details class="group p-4" open>
            <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-gray-800 dark:text-gray-200">
                <span class="text-2xl leading-tight">Pusher SDK</span>
                <span class="transition group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </span>
            </summary>
            <article class="prose max-w-none dark:prose-invert group-open:animate-fadeIn mt-3">
                @markdown
                The backend configuration of your real-time messaging infrastructure will depend on the language of your application. However, in this example we will demonstrate configuration the Pusher PHP SDK to interact with soketi, which should be similar to the configuration of server-side Pusher SDKs in other languages:

                ```php
                use Pusher\Pusher;

                \$pusher = new Pusher('app-key', 'app-secret', 'app-id', [
                    'host' => '$host',
                    'port' => $port,
                    'scheme' => 'http',
                    'encrypted' => true,
                    'useTLS' => false,
                ]);
                ```

                ### Encrypted Private Channels

                [Pusher Encrypted Private Channels](https://pusher.com/docs/channels/using\_channels/encrypted-channels/) are also supported, meaning that for private channels, you can encrypt your data symmetrically at both your client and backend applications, soketi NOT knowing at all what the actual data is set, acting just like a deliverer.

                ```php
                use Pusher\Pusher;

                \$pusher = new Pusher('app-key', 'app-secret', 'app-id', [
                    'encryptionMasterKeyBase64' => 'YOUR_MASTER_KEY',  // generate this with, e.g. 'openssl rand -base64 32'
                ]);
                ```
                @endmarkdown
            </article>
        </details>
        <details class="group p-4 border-t border-gray-100 dark:border-gray-700" open>
            <summary class="flex justify-between items-center font-medium cursor-pointer list-none text-gray-800 dark:text-gray-200">
                <span class="text-2xl leading-tight">Laravel Broadcasting</span>
                <span class="transition group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </span>
            </summary>
            <article class="prose max-w-none dark:prose-invert group-open:animate-fadeIn mt-3">
                @markdown
                When using [Laravel's event broadcasting](https://laravel.com/docs/10.x/broadcasting) feature within your application, soketi is even easier to configure. First, replace the default `pusher` configuration in your application's `config/broadcasting.php` file with the following configuration:

                ```php
                'connections' => [
                    'pusher' => [
                        'driver' => 'pusher',
                        'key' => env('PUSHER_APP_KEY', 'app-key'),
                        'secret' => env('PUSHER_APP_SECRET', 'app-secret'),
                        'app_id' => env('PUSHER_APP_ID', 'app-id'),
                        'options' => [
                            'host' => env('PUSHER_HOST', '$host'),
                            'port' => env('PUSHER_PORT', $port),
                            'scheme' => env('PUSHER_SCHEME', 'http'),
                            'encrypted' => true,
                            'useTLS' => env('PUSHER_SCHEME') === 'https',
                        ],
                    ],
                ],
                ```

                > To configure the client for [SSL](https://docs.soketi.app/getting-started/ssl-configuration), you should set the `scheme` option to `http` and the `useTLS` option to `true`.

                ### Self-signed Certificates

                Due to implementation changes in the Pusher PHP SDK, releases of the SDK since the `6.0` release do not support `curl_options`; therefore, self-signed SSL certificates will fail certificate validation since certificate verification cannot be disabled. To bypass SSL Verification, you must use Pusher PHP SDK version `5.0.3`.
                @endmarkdown
            </article>
        </details>
    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:initialized', () => {
            hljs.highlightAll();
        })
    </script>
</x-filament-panels::page>
