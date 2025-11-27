<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Atha Construction — Navbar</title>
  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Alpine.js -->
  <script src="https://unpkg.com/alpinejs@3.16.1/dist/cdn.min.js" defer></script>
  <style>
    /* Small visual tweak to show an example logo circle */
    .logo-placeholder{
      background: linear-gradient(135deg,#ffffff10,#ffffff05);
      border: 1px solid rgba(255,255,255,0.06);
    }
  </style>
</head>
<body class="bg-white text-black">

<!-- Navbar component -->
<nav x-data="nav()" class="w-full z-50 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">

      <!-- Left: Logo -->
      <div class="flex items-center gap-3">
        <a href="#" class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-full logo-placeholder flex items-center justify-center text-black/80 font-bold">AC</div>
          <div class="hidden sm:block">
            <div class="text-lg font-semibold">Atha Construction</div>
            <div class="text-xs text-gray-500">Building dreams</div>
          </div>
        </a>
      </div>

      <!-- Center: Navigation links (desktop) -->
      <div class="hidden md:flex md:items-center md:space-x-6">
        <a href="#" class="nav-link">HOME</a>
        <a href="#" class="nav-link">ABOUT</a>
        <a href="#" class="nav-link">PACKAGES</a>
        <a href="#" class="nav-link">PROPERTIES</a>
        <a href="#" class="nav-link">Careers</a>
        <a href="#" class="nav-link">Blogs</a>
        <a href="#" class="nav-link">Gallery</a>

        <!-- Services dropdown -->
        <div x-data="{open:false}" class="relative">
          <button @click="open = !open" @keydown.escape="open = false" class="nav-link flex items-center gap-1">
            SERVICES
            <svg class="w-3 h-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06-.02L10 10.67l3.71-3.48a.75.75 0 111.02 1.1l-4.2 3.94a.75.75 0 01-1.02 0L5.25 8.28a.75.75 0 01-.02-1.06z" clip-rule="evenodd"/></svg>
          </button>
          <div x-show="open" x-transition class="absolute right-0 mt-2 w-44 bg-white border border-gray-100 rounded-md shadow-lg py-2 text-sm">
            <a href="#" class="block px-4 py-2 hover:bg-gray-50">Residential</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-50">Commercial</a>
            <a href="#" class="block px-4 py-2 hover:bg-gray-50">Renovation</a>
          </div>
        </div>

        <a href="#" class="nav-link">Contact Us</a>
      </div>

      <!-- Right: Action & Mobile menu button -->
      <div class="flex items-center gap-3">
        <a href="#contact" class="hidden md:inline-block px-4 py-2 border border-black rounded-md text-sm font-medium">Get Quote</a>

        <!-- Mobile menu button -->
        <button @click="open = !open" class="md:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none" :aria-expanded="open">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

    </div>
  </div>

  <!-- Mobile menu (slide down) -->
  <div x-show="open" x-transition class="md:hidden border-t border-gray-100">
    <div class="px-4 pt-4 pb-6 space-y-2">
      <a href="#" class="block py-2 font-medium">HOME</a>
      <a href="#" class="block py-2">ABOUT</a>
      <a href="#" class="block py-2">PACKAGES</a>
      <a href="#" class="block py-2">PROPERTIES</a>
      <a href="#" class="block py-2">Careers</a>
      <a href="#" class="block py-2">Blogs</a>
      <a href="#" class="block py-2">Gallery</a>
      <div class="pt-2 border-t border-gray-100">
        <div x-data="{openServices:false}" class="py-2">
          <button @click="openServices = !openServices" class="w-full text-left font-medium">SERVICES</button>
          <div x-show="openServices" x-transition class="mt-2 pl-4 space-y-1 text-sm">
            <a href="#" class="block py-1">Residential</a>
            <a href="#" class="block py-1">Commercial</a>
            <a href="#" class="block py-1">Renovation</a>
          </div>
        </div>
      </div>
      <a href="#contact" class="block mt-3 inline-block w-full text-center border border-black rounded-md py-2">Get Quote</a>
    </div>
  </div>
</nav>

<script>
  function nav(){
    return {
      open:false
    }
  }
</script>

<!-- Utility classes for nav links (keeps HTML tidy) -->
<style>
  .nav-link{
    @apply text-sm font-medium tracking-wide text-black/90 hover:text-black;
  }
  /* Dark mode ready: if you wish to invert colors, change body class to bg-black text-white and tweak */
</style>

</body>
</html>
