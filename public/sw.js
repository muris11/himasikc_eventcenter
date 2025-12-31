// Service Worker untuk caching agresif
const CACHE_NAME = "hima-sikc-v1";
const STATIC_CACHE = "hima-sikc-static-v1";

// Resources yang akan di-cache
const STATIC_ASSETS = [
    "/",
    "/build/manifest.json",
    "/favicon.ico",
    "/logo.png",
];

// Install event - cache static assets
self.addEventListener("install", (event) => {
    event.waitUntil(
        caches.open(STATIC_CACHE).then((cache) => cache.addAll(STATIC_ASSETS))
    );
    self.skipWaiting();
});

// Activate event - cleanup old caches
self.addEventListener("activate", (event) => {
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames.map((cacheName) => {
                    if (
                        cacheName !== STATIC_CACHE &&
                        cacheName !== CACHE_NAME
                    ) {
                        return caches.delete(cacheName);
                    }
                })
            );
        })
    );
});

// Fetch event - serve from cache first, then network
self.addEventListener("fetch", (event) => {
    // Only cache GET requests
    if (event.request.method !== "GET") return;

    // Skip external requests
    if (!event.request.url.startsWith(self.location.origin)) return;

    // Skip admin routes
    if (event.request.url.includes("/admin")) return;

    event.respondWith(
        caches.match(event.request).then((cachedResponse) => {
            if (cachedResponse) {
                return cachedResponse;
            }

            return fetch(event.request)
                .then((response) => {
                    // Don't cache non-successful responses
                    if (!response.ok) return response;

                    // Cache static assets
                    if (
                        event.request.url.includes("/build/") ||
                        event.request.url.includes("/storage/") ||
                        event.request.url.includes(".css") ||
                        event.request.url.includes(".js")
                    ) {
                        const responseClone = response.clone();
                        caches
                            .open(CACHE_NAME)
                            .then((cache) =>
                                cache.put(event.request, responseClone)
                            );
                    }

                    return response;
                })
                .catch(() => {
                    // Return offline fallback if available
                    return caches.match("/");
                });
        })
    );
});
