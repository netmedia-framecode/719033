<?php
function setActive($page_name, $current_page)
{
  return ($page_name == $current_page) ? 'text-primary font-bold' : 'text-gray-600 hover:text-primary font-medium';
}
?>

<nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-lg transition-all duration-300">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-20">
      <a href="./" class="flex-shrink-0 flex items-center gap-2">
        <img src="assets/img/<?= $data_utilities['logo'] ?>" style="width: 60px;" alt="">
        <div>
          <span class="font-bold text-xl tracking-tight text-gray-900 block leading-none"><?= $data_utilities['name_web'] ?></span>
        </div>
      </a>

      <div class="hidden md:flex space-x-8 items-center">
        <a href="./" class="<?= setActive('home', $page) ?> transition">Beranda</a>
        <a href="tentang" class="<?= setActive('tentang', $page) ?> transition">Tentang</a>
        <a href="prosedur" class="<?= setActive('prosedur', $page) ?> transition">Prosedur</a>
        <a href="kontak" class="<?= setActive('kontak', $page) ?> transition">Kontak</a>
        <a href="auth/" class="bg-primary hover:bg-secondary text-white px-5 py-2.5 rounded-full font-semibold transition shadow-lg shadow-blue-500/30">
          Login
        </a>
      </div>

      <div class="md:hidden flex items-center">
        <button class="mobile-menu-button focus:outline-none">
          <i data-feather="menu"></i>
        </button>
      </div>
    </div>
  </div>

  <div class="hidden mobile-menu md:hidden bg-white border-t p-4 space-y-3 shadow-lg">
    <a href="./" class="block <?= setActive('home', $page) ?>">Beranda</a>
    <a href="tentang" class="block <?= setActive('tentang', $page) ?>">Tentang</a>
    <a href="prosedur" class="block <?= setActive('prosedur', $page) ?>">Prosedur</a>
    <a href="kontak" class="block <?= setActive('kontak', $page) ?>">Kontak</a>
    <a href="auth/" class="block bg-primary text-white text-center px-5 py-2 rounded-md font-semibold">Login</a>
  </div>
</nav>