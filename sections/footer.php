<footer class="bg-gray-900 text-white py-10 border-t border-gray-800 mt-auto">
  <div class="max-w-7xl mx-auto px-4 text-center">
    <div class="flex justify-center items-center gap-2 mb-4">
      <img src="assets/img/<?= $data_utilities['logo'] ?>" style="width: 40px;" alt="">
      <span class="font-bold text-xl"><?= $data_utilities['name_web'] ?></span>
    </div>
    <p class="text-gray-400 text-sm mb-6">Sistem Pendukung Keputusan Penerimaan Bantuan Langsung Tunai.</p>
    <p class="text-gray-500 text-sm">Copyright &copy; <a href="https://wasd.netmedia-framecode.com" class="text-decoration-none">WASD Netmedia
        Framecode</a> <?= date('Y') ?> | Develop by Anthania Gende</p>
  </div>
</footer>

<script>
  feather.replace();
  const btn = document.querySelector("button.mobile-menu-button");
  const menu = document.querySelector(".mobile-menu");
  if (btn) {
    btn.addEventListener("click", () => {
      menu.classList.toggle("hidden");
    });
  }
</script>
</body>

</html>