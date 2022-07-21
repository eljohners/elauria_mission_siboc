var cacheName = 'Mang Juan';
var filesToCache = [
  '/',
  '/cart.php',
  '/cart_design.css',
  '/js/main.js',
  '/checkout.php',
  'checkout_design.css',
  '/index.php',
  '/style.css',
  '/login.php',
  '/login_design.css',
  '/milktea.php',
  '/milktea_design.css',
  '/signup_design.php',
  '/signup_design.css',
  '/admin/adminlogin.php',
  '/admin/adminlogindesign.css',
  '/admin/deliver.php',
  '/admin/deliver_design.css',
  '/admin/edit_milktea.php',
  '/admin/index.php',
  '/admin/index_design.css',
  '/admin/milktea_admin.php',
  '/admin/milktea_admin_design.css',
  '/admin/new_milktea.php',
  '/admin/new_milktea_design.css',
  '/admin/order.php',
  '/admin/order_design.css'
];

/* Start the service worker and cache all of the app's content */
self.addEventListener('install', function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
  self.skipWaiting();
});

/* Serve cached content when offline */
self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
