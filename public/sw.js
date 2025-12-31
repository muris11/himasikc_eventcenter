// Service Worker DISABLED
// This project must not be forced into "dark mode" or serve stale cached HTML/assets after deploy.
// Existing installations of this SW will self-unregister and clear caches.

self.addEventListener("install", () => {
    self.skipWaiting();
});

self.addEventListener("activate", (event) => {
    event.waitUntil(
        (async () => {
            const cacheNames = await caches.keys();
            await Promise.all(cacheNames.map((name) => caches.delete(name)));
            await self.clients.claim();
            await self.registration.unregister();
        })()
    );
});

self.addEventListener("fetch", (event) => {
    event.respondWith(fetch(event.request));
});
