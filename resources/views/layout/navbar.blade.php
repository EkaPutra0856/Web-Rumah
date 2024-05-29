<div>
    <nav class=" bg-transparent border-b-[0.2px] border-gray-500">
        <div class="px-8 mx-auto max-w-8xl">
            <div class="flex items-center justify-between h-16">
                <div class="w-full justify-between flex items-center">
                    <a class="flex-shrink-0 text-white font-bold" href="/">
                        DATABASE PROJECT
                    </a>
                    <div class="hidden md:block">
                        <div class="flex flex-row items-baseline ml-10 space-x-4">
                            <div class="flex flex-col group items-center">
                                <a class="text-gray-300 {{ Request::is('penduduk') || Request::is('wna') || Request::is('ortu') || Request::is('keluarga') || Request::is('keluargaortu') ? 'active:font-semibold text-white scale-105' : '' }} hover:scale-105  hover:text-white px-3 py-2 rounded-md text-sm font-medium"
                                    href="/adminwilayah">
                                    KEPENDUDUKAN
                                </a>
                            </div>

                            <div class="flex flex-col group items-center">
                                <a href="/wilayah"
                                    class="text-gray-300 {{ Request::is('kelahiran') || Request::is('kematian') || Request::is('pajak') || Request::is('bantuan') ? 'active:font-semibold text-white scale-105' : '' }} hover:scale-105  hover:text-white px-3 py-2
                                rounded-md text-sm font-medium">
                                    ADMINISTRASI
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<script>
    let isOpen = false;

    function Dropdown() {
        const dropdownElement = document.getElementById('Dropdown');
        if (isOpen === false) {
            dropdownElement.classList.remove('hidden');
            isOpen = true;
        } else {
            dropdownElement.classList.add('hidden');
            isOpen = false;
        }

        function handleResize() {
            const screenWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            if (screenWidth > 768) {
                dropdownElement.classList.add('hidden');
                isOpen = false;
            }
        }

        // Panggil fungsi handleResize saat halaman dimuat
        handleResize();

        // Tambahkan event listener untuk event resize
        window.addEventListener('resize', handleResize);
    }
</script>
