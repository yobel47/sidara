const CACHE_VER    = 'sidara-v1';
const STATIC_CACHE = `${CACHE_VER}-static`;
const OFFLINE_URL  = '/offline.html';

// Pre-cache offline fallback page on install
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => cache.addAll([OFFLINE_URL]))
            .then(() => self.skipWaiting())
    );
});

// Remove stale caches on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys()
            .then(keys => Promise.all(
                keys.filter(k => k !== STATIC_CACHE).map(k => caches.delete(k))
            ))
            .then(() => self.clients.claim())
    );
});

self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);

    // Only handle same-origin GET
    if (request.method !== 'GET' || url.origin !== self.location.origin) return;

    // Skip Livewire internal endpoint
    if (url.pathname.startsWith('/livewire/')) return;

    // Vite build assets (content-hashed) → cache first, never expire
    if (url.pathname.startsWith('/build/')) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Images, icons, fonts → cache first
    if (url.pathname.match(/\.(png|jpe?g|svg|gif|webp|ico|woff2?|ttf|otf)(\?.*)?$/)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // HTML navigation → always network, offline.html fallback only when truly offline
    if (request.mode === 'navigate' || request.headers.get('Accept')?.includes('text/html')) {
        event.respondWith(
            fetch(request).catch(() => caches.match(OFFLINE_URL))
        );
        return;
    }
});

async function cacheFirst(request) {
    const cached = await caches.match(request);
    if (cached) return cached;
    try {
        const response = await fetch(request);
        if (response.ok) {
            const cache = await caches.open(STATIC_CACHE);
            cache.put(request, response.clone());
        }
        return response;
    } catch {
        return new Response('', { status: 503 });
    }
}
