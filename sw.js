let staticCacheName = "pwa-v" + new Date().getTime();
let filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/assets/img/icons/apple-icon-57x57.png',
    '/assets/img/icons/apple-icon-60x60.png',
    '/assets/img/icons/apple-icon-72x72.png',
    '/assets/img/icons/apple-icon-76x76.png',
    '/assets/img/icons/apple-icon-114x114.png',
    '/assets/img/icons/apple-icon-120x120.png',
    '/assets/img/icons/apple-icon-144x144.png',
    '/assets/img/icons/apple-icon-152x152.png',
    '/assets/img/icons/apple-icon-180x180.png',
    '/assets/img/icons/android-icon-192x192.png',
];

// install
self.addEventListener("install", e =>{
    e.waitUntil(
        caches.open("static").then(cache => {
            return cache.addAll(filesToCache);
        })
    )
});

// Clear cache on activate
self.addEventListener('activate', e => {
    e.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("pwa-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", e => {
    e.respondWith(
        caches.match(e.request)
            .then(response => {
                return response || fetch(e.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});