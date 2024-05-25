<x-filament-panels::page>
    <div class="rounded-xl bg-white shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
        <details class="group p-4" open>
            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                <span class="text-2xl leading-tight">Pusher SDK</span>
                <span class="transition group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </span>
            </summary>
            <article class="prose max-w-none dark:prose-invert group-open:animate-fadeIn mt-3">
                @markdown
                Pusher clients are fully compatible with the WebSocket protocol implemented by soketi, which means you can easily take advantage of amazing features like private channels, presence channels, and client events. You simply need to point the Pusher compatible client to the soketi server address:

                ```javascript
                const PusherJS = require('pusher-js');

                let client = new PusherJS('app-key', {
                    wsHost: '$host',
                    wsPort: $port,
                    forceTLS: false,
                    encrypted: true,
                    disableStats: true,
                    enabledTransports: ['ws', 'wss'],
                });

                client.subscribe('chat-room').bind('message', (message) => {
                    alert(`\${message.sender} says: \${message.content}`);
                });
                ```

                > Make sure that `enabledTransports` is set to `['ws', 'wss']`. If not set, in case of connection failure, the client will try other transports such as XHR polling, which soketi doesn't support.

                ### SSL Configuration

                When running the server in SSL mode, you may consider setting the `forceTLS` client option to `true`. When this option is set to `true`, the client will connect to the `wss` protocol instead of `ws`:

                ```javascript
                const PusherJS = require('pusher-js');

                let client = new PusherJS('app-key', {
                    wssHost: '$host',
                    wssPort: $port,
                    forceTLS: true,
                    enabledTransports: ['wss'],
                });
                ```

                ### Encrypted Private Channels

                [Pusher Encrypted Private Channels](https://pusher.com/docs/channels/using\_channels/encrypted-channels/) are also supported, meaning that for private channels, you can encrypt your data symmetrically at both your client and backend applications, soketi NOT knowing at all what the actual data is set, acting just like a deliverer.

                ```javascript
                const PusherJS = require('pusher-js');

                let client = new PusherJS('app-key', {
                    encryptionMasterKeyBase64: "YOUR_MASTER_KEY", // generate this with, e.g. 'openssl rand -base64 32'
                });

                client.subscribe('private-encrypted-top-secret-room').bind('message', (message) => {
                    // The message is unknown to soketi
                });
                ```
                @endmarkdown
            </article>
        </details>
        <details class="group p-4 border-t border-gray-100 dark:border-gray-700" open>
            <summary class="flex justify-between items-center font-medium cursor-pointer list-none">
                <span class="text-2xl leading-tight">Laravel Echo</span>
                <span class="transition group-open:rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                    </svg>
                </span>
            </summary>
            <article class="prose max-w-none dark:prose-invert group-open:animate-fadeIn mt-3">
                @markdown
                Laravel Echo is compatible with the PusherJS library. Therefore, its configuration resembles the typical configuration of a PusherJS client such as the example configuration in the previous section of documentation:

                ```javascript
                import Echo from 'laravel-echo';

                window.Pusher = require('pusher-js');

                let laravelEcho = new Echo({
                    broadcaster: 'pusher',
                    key: process.env.MIX_PUSHER_APP_KEY,
                    wsHost: process.env.MIX_PUSHER_HOST,
                    wsPort: process.env.MIX_PUSHER_PORT,
                    wssPort: process.env.MIX_PUSHER_PORT,
                    forceTLS: false,
                    encrypted: true,
                    disableStats: true,
                    enabledTransports: ['ws', 'wss'],
                });

                laravelEcho.private(`orders.\${orderId}`)
                    .listen('OrderShipmentStatusUpdated', (e) => {
                        console.log(e.order);
                    });
                ```

                > Make sure that `enabledTransports` is set to `['ws', 'wss']`. If not set, in case of connection failure, the client will try other transports such as XHR polling, which soketi doesn't support.

                The `MIX_*` environment variables are typically declared in your Laravel application's `.env` file:

                ```bash
                PUSHER_APP_KEY=app-key
                PUSHER_APP_ID=app-id
                PUSHER_APP_SECRET=app-secret
                PUSHER_HOST=$host
                PUSHER_PORT=$port

                MIX_PUSHER_APP_KEY="\${PUSHER_APP_KEY}"
                MIX_PUSHER_HOST="\${PUSHER_HOST}"
                MIX_PUSHER_PORT="\${PUSHER_PORT}"
                ```
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
