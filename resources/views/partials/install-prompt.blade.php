{{-- resources/views/partials/install-prompt.blade.php --}}
{{-- Banner ajakan install PWA. Muncul otomatis kalau belum ter-install & belum pernah ditutup.
     Style .install-prompt-pos / .install-prompt-card ada di resources/css/app.css --}}
<div
    x-data="{
        show: false,
        isIOS: false,
        isDesktop: false,
        deferredPrompt: null,
        init() {
            const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true;
            if (isStandalone || localStorage.getItem('sidaraInstallDismissed') === '1') return;

            this.isIOS = /iphone|ipad|ipod/.test(window.navigator.userAgent.toLowerCase());
            this.isDesktop = window.matchMedia('(min-width: 1024px)').matches;

            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                this.deferredPrompt = e;
                this.show = true;
            });

            // iOS Safari tidak punya event beforeinstallprompt, jadi kasih instruksi manual.
            if (this.isIOS) {
                this.show = true;
            }
        },
        async install() {
            if (!this.deferredPrompt) return;
            this.deferredPrompt.prompt();
            await this.deferredPrompt.userChoice;
            this.deferredPrompt = null;
            this.show = false;
        },
        dismiss() {
            this.show = false;
            localStorage.setItem('sidaraInstallDismissed', '1');
        },
    }"
    x-show="show"
    x-transition
    style="display:none"
    class="install-prompt-pos fixed inset-x-0 pointer-events-none"
>
    <div class="install-prompt-card pointer-events-auto rounded-2xl border border-gray-200 bg-white p-4 shadow-lg">

        <div class="flex items-start gap-3">
            <img src="{{ asset('icon-192x192.png') }}" alt="SI DARA" class="w-10 h-10 rounded-lg shrink-0">

            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-gray-900">Install Aplikasi SI DARA</p>

                <template x-if="!isIOS && !isDesktop">
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                        Biar lebih mudah dibuka lagi nanti, langsung dari layar HP kamu.
                    </p>
                </template>
                <template x-if="!isIOS && isDesktop">
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                        Biar lebih mudah dibuka lagi nanti, tanpa perlu buka browser dan ketik alamatnya.
                    </p>
                </template>
                <template x-if="isIOS">
                    <p class="text-xs text-gray-500 mt-1 leading-relaxed">
                        Tap tombol <strong>Bagikan</strong> <span aria-hidden="true">⬆️</span> di Safari, lalu pilih
                        <strong>"Tambah ke Layar Utama"</strong>.
                    </p>
                </template>
            </div>

            <button @click="dismiss" class="shrink-0 p-1 -m-1 text-gray-400 hover:text-gray-600" aria-label="Tutup">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <template x-if="!isIOS">
            <div class="flex items-center gap-2 mt-3">
                <button @click="install"
                    class="flex-1 py-2.5 rounded-xl bg-rose-500 text-white text-sm font-bold">
                    Install
                </button>
                <button @click="dismiss"
                    class="px-4 py-2.5 rounded-xl text-gray-500 text-sm font-semibold">
                    Nanti saja
                </button>
            </div>
        </template>
        <template x-if="isIOS">
            <button @click="dismiss" class="w-full mt-3 py-2.5 rounded-xl bg-gray-100 text-gray-600 text-sm font-semibold">
                Mengerti
            </button>
        </template>
    </div>
</div>
