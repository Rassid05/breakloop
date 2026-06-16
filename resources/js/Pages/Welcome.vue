<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { 
    Play, 
    Heart, 
    Flame, 
    Coins, 
    Check, 
    Zap, 
    Radio, 
    Mic2, 
    ShieldCheck,
    LogIn,
    UserPlus
} from 'lucide-vue-next';

// Data Mockup untuk Trending Songs
const trendingSongs = [
    { id: 1, title: '#LF X ISA-Dengarlah Bintang Hatiku SUPER EXC[RASSIDREMIXER X 51_LOGIKA]#512_LogikaFamily', artist: 'RassidRemixer', plays: '1.2M', duration: '03:45', image: 'https://picsum.photos/100/100?random=10' },
    { id: 2, title: 'KICAU MANIA 2026 SICEPATKILAT #LUTHFI AP [ ICHA PASIR ] [ Djorgie L3 ]', artist: 'Djorgie L3', plays: '892K', duration: '04:12', image: 'https://picsum.photos/100/100?random=11' },
    { id: 3, title: '#LF X MRK - Takkan Pisah Super Exclusive [ RASSIDREMIXER Ft. IDHUL75 ]#LOGIKA FAMILY', artist: 'RassidRemixer', plays: '750K', duration: '02:58', image: 'https://picsum.photos/100/100?random=12' },
];

// Data Mockup Paket Premium Berbasis Token
const tokenPlans = [
    {
        name: 'Lite Producer Corp',
        tokens: 50,
        price: 'Rp 15.000',
        period: 'sekali beli',
        description: 'Ideal untuk mencoba beberapa loop atau one-shot samples berkualitas tinggi.',
        features: ['50 BreakLoop Tokens (BL)', 'Gunakan di semua kreator sample', 'Lisensi Bebas Royalti (Royalty-Free)'],
        isPopular: false,
    },
    {
        name: 'Monster Sound Corp',
        tokens: 200,
        price: 'Rp 50.000',
        period: 'paling populer',
        description: 'Paket terbaik untuk produser ambisius yang butuh banyak amunisi kit audio.',
        features: ['200 BreakLoop Tokens (BL)', 'Bonus 15 Ekstra Token', 'Lisensi Komersial Penuh', 'Akses Premium Sample Rilis Awal'],
        isPopular: true,
    }
];

// Data Mockup Fitur Utama (Features)
const features = [
    { icon: Radio, title: 'Royalty-Free Audio', desc: 'Semua sample pack yang dibeli dengan token 100% aman digunakan untuk produksi lagu komersial Anda.' },
    { icon: Coins, title: 'Creator Direct Economy', desc: 'Token yang Anda belanjakan mengalir langsung ke produser pembuat sample dengan potongan platform minimal.' },
    { icon: Zap, title: 'Instant WAV Download', desc: 'Sekali klik pakai token, langsung unduh file audio kualitas tinggi (WAV 24-bit) siap pakai di DAW Anda.' }
];
</script>

<template>
    <Head title="Welcome to BreakLoop" />

    <div class="min-h-screen bg-[#0b0c0e] text-white flex flex-col relative overflow-hidden selection:bg-emerald-500 selection:text-black antialiased">
        
        <!-- ================= STICKY NAVBAR ================= -->
        <nav class="sticky top-0 z-50 w-full bg-[#0b0c0e]/75 backdrop-blur-lg border-b border-gray-900/80 px-6 py-4 flex items-center justify-between transition-all duration-300">
            <Link :href="'/'" class="flex items-center gap-2 text-emerald-500 font-black text-xl tracking-wider focus:outline-none group">
                <Radio :size="24" class="text-emerald-500 animate-pulse group-hover:scale-110 transition-transform duration-300" />
                <span class="bg-gradient-to-r from-emerald-400 to-teal-500 bg-clip-text text-transparent group-hover:brightness-125 transition-all">BreakLoop</span>
            </Link>

            <!-- Menggunakan String URL agar Aman dari Bug Route Ziggy -->
            <div class="flex items-center gap-3">
                <Link 
                    :href="'/login'" 
                    class="text-xs font-bold text-gray-400 hover:text-white px-4 py-2 rounded-xl hover:bg-[#111317] transition-all duration-300 flex items-center gap-1.5 focus:outline-none"
                >
                    <LogIn :size="14" />
                    Log In
                </Link>
                <Link 
                    :href="'/register'" 
                    class="text-xs font-bold bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2.5 rounded-xl shadow-md shadow-emerald-500/20 hover:scale-[1.03] active:scale-[0.98] transition-all duration-300 flex items-center gap-1.5 focus:outline-none"
                >
                    <UserPlus :size="14" />
                    Sign Up
                </Link>
            </div>
        </nav>

        <!-- Efek Pendaran Cahaya Neon Latar Belakang (Animated Glows) -->
        <div class="absolute w-[500px] h-[500px] bg-emerald-500/5 rounded-full filter blur-[140px] top-[-10%] left-[-10%] animate-[pulse_8s_infinite_alternate] pointer-events-none"></div>
        <div class="absolute w-[600px] h-[600px] bg-purple-500/5 rounded-full filter blur-[160px] top-[30%] right-[-10%] animate-[pulse_11s_infinite_alternate] pointer-events-none"></div>
        <div class="absolute w-[400px] h-[400px] bg-teal-500/5 rounded-full filter blur-[130px] bottom-0 left-[20%] pointer-events-none"></div>

        <!-- CONTAINER UTAMA -->
        <main class="flex-1 max-w-6xl w-full mx-auto p-6 md:p-12 space-y-24 z-10">
            
            <!-- ================= HERO SECTION (ANIMATED) ================= -->
            <section class="text-center max-w-3xl mx-auto space-y-6 py-12 relative">
                <!-- Mini Badge Accent -->
                <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-[10px] font-semibold tracking-widest uppercase animate-fade-in">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    Next-Gen Audio Marketplace
                </div>
                
                <h1 class="text-4xl md:text-6xl font-black tracking-tight leading-[1.15] text-transparent bg-clip-text bg-gradient-to-b from-white via-gray-200 to-gray-500 drop-shadow-sm">
                    Smarter Looping.<br>
                    <span class="bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500 bg-clip-text text-transparent drop-shadow-[0_0_15px_rgba(52,211,153,0.1)]">
                        Decentralized Music.
                    </span>
                </h1>
                
                <p class="text-sm md:text-base text-gray-400 max-w-lg mx-auto leading-relaxed font-medium">
                    Dengarkan audio kualitas studio tanpa gangguan jeda, dukung musisi lokal secara langsung menggunakan token, dan rasakan kebebasan bermusik.
                </p>
                
                <div class="pt-4 flex justify-center gap-4">
                    <Link 
                        :href="'/register'"
                        class="inline-flex items-center bg-[#111317] border border-gray-800 hover:border-emerald-500/50 text-gray-200 hover:text-white text-xs font-bold px-7 py-4 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-emerald-500/5 hover:scale-[1.02] active:scale-[0.98] group"
                    >
                        <span>Mulai Mendengarkan Gratis</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="ml-2 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </Link>
                </div>
            </section>

            <!-- ================= TRENDING SECTION (HOVER GLOW) ================= -->
            <section class="space-y-6">
                <div class="flex items-center gap-2">
                    <Flame class="text-orange-500 animate-bounce" :size="22" />
                    <h2 class="text-xl font-extrabold tracking-tight text-gray-100">Trending Right Now</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <Link 
                        v-for="song in trendingSongs" 
                        :key="song.id"
                        :href="'/login'"
                        class="bg-[#111317]/40 border border-gray-900/60 rounded-2xl p-4 flex items-center justify-between hover:bg-[#14171d] hover:border-gray-800 hover:shadow-2xl hover:shadow-emerald-500/[0.02] transition-all duration-300 group cursor-pointer focus:outline-none"
                    >
                        <div class="flex items-center gap-4 min-w-0">
                            <!-- Image Container with standard Tailwind sizes -->
                            <div class="relative flex-shrink-0 overflow-hidden rounded-xl border border-gray-800">
                                <img :src="song.image" class="w-12 h-12 rounded-xl object-cover group-hover:scale-110 transition-transform duration-500" />
                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <Play :size="16" class="text-emerald-400 fill-emerald-400 animate-[spin_4s_linear_infinite]" />
                                </div>
                            </div>
                            <div class="min-w-0">
                                <h3 class="text-sm font-bold truncate text-gray-200 group-hover:text-emerald-400 transition-colors duration-300">{{ song.title }}</h3>
                                <p class="text-xs text-gray-500 mt-0.5">{{ song.artist }}</p>
                                <span class="text-[10px] font-medium text-emerald-500/70 mt-1 block">{{ song.plays }} plays</span>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="text-xs text-gray-600 font-mono">{{ song.duration }}</span>
                            <Heart :size="14" class="text-gray-600 group-hover:text-rose-500 group-hover:scale-110 transition-all duration-300" />
                        </div>
                    </Link>
                </div>
            </section>

            <!-- ================= CREATOR PORTAL BANNER (ADVANCED ANIMATION) ================= -->
            <section>
                <div class="relative bg-gradient-to-r from-emerald-950/20 via-[#111317] to-[#0c0e12] border border-emerald-500/10 rounded-3xl p-8 md:p-10 overflow-hidden flex flex-col md:flex-row items-center justify-between gap-8 group/banner shadow-xl">
                    <!-- Subtle inner line effect -->
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/[0.02] to-transparent opacity-0 group-hover/banner:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                    
                    <div class="space-y-3 text-center md:text-left relative z-10">
                        <div class="inline-flex items-center gap-1.5 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                            <Mic2 :size="12" class="animate-pulse" /> For Artists & Designers
                        </div>
                        <h2 class="text-2xl md:text-3xl font-black text-white tracking-tight leading-none">
                            Publish Your Music. <span class="text-emerald-400">Earn 100% Revenue.</span>
                        </h2>
                        <p class="text-xs md:text-sm text-gray-400 max-w-xl leading-relaxed">
                            Apakah kamu seorang musisi? Unggah aransemen musik buatanmu, perluas audiens jangkauanmu di BreakLoop, dan cairkan pendapatan royalti token secara transparan tanpa potongan tersembunyi.
                        </p>
                    </div>

                    <div class="flex-shrink-0 w-full md:w-auto relative z-10">
                        <Link 
                            :href="'/register'"
                            class="w-full md:w-auto bg-emerald-500 hover:bg-emerald-400 text-black text-xs font-black px-6 py-4 rounded-xl shadow-lg shadow-emerald-500/10 hover:shadow-emerald-400/30 hover:scale-[1.04] active:scale-[0.98] transition-all duration-300 block text-center focus:outline-none"
                        >
                            Join Creator Portal
                        </Link>
                    </div>
                </div>
            </section>

            <!-- ================= TOKEN PLANS (CARD GLOW EFFECTS) ================= -->
            <section class="relative">
                <div class="text-center max-w-md mx-auto mb-12">
                    <div class="inline-flex items-center gap-1.5 text-purple-400 font-extrabold text-xs mb-2 tracking-widest uppercase">
                        <Coins :size="14" class="animate-spin-slow" /> BUY BREAKLOOP TOKENS
                    </div>
                    <h2 class="text-2xl font-black tracking-tight text-white">Top-Up Token untuk Belanja</h2>
                    <p class="text-xs text-gray-500 mt-1">Beli koin token sesuai kebutuhan produksi musikmu untuk ditukarkan dengan materi sample pack berlisensi penuh.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl mx-auto">
                    <div 
                        v-for="plan in tokenPlans" 
                        :key="plan.name"
                        class="bg-[#111317]/50 border p-6 md:p-8 rounded-3xl flex flex-col justify-between relative shadow-xl hover:scale-[1.02] transition-all duration-500 group/card"
                        :class="plan.isPopular ? 'border-emerald-500/30 shadow-emerald-500/[0.02]' : 'border-gray-900/80 hover:border-gray-800'"
                    >
                        <!-- Top-right Glow effect on hover -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-emerald-500/5 rounded-full filter blur-xl opacity-0 group-hover/card:opacity-100 transition-opacity duration-500"></div>

                        <div v-if="plan.isPopular" class="absolute -top-3 right-8 bg-gradient-to-r from-emerald-500 to-teal-500 text-black font-black text-[9px] uppercase tracking-widest px-3 py-1 rounded-full shadow-lg">
                            Best Value
                        </div>

                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-white group-hover/card:text-emerald-400 transition-colors duration-300">{{ plan.name }}</h3>
                                    <p class="text-[11px] text-gray-500 mt-1 leading-relaxed">{{ plan.description }}</p>
                                </div>
                                <div class="text-right flex-shrink-0">
                                    <div class="text-emerald-400 font-black text-xl flex items-center justify-end gap-1 bg-emerald-950/30 px-2.5 py-1 rounded-xl border border-emerald-900/20">
                                        <Coins :size="16" class="text-emerald-400" /> {{ plan.tokens }} <span class="text-xs font-semibold text-gray-500">BL</span>
                                    </div>
                                </div>
                            </div>

                            <div class="my-6 border-t border-gray-900/80 pt-4">
                                <span class="text-3xl font-black text-white tracking-tight">{{ plan.price }}</span>
                                <span class="text-xs text-gray-500 ml-1">/ {{ plan.period }}</span>
                            </div>

                            <ul class="space-y-3 my-6">
                                <li v-for="feat in plan.features" :key="feat" class="flex items-center gap-2.5 text-xs text-gray-400">
                                    <div class="w-4.5 h-4.5 bg-emerald-500/10 border border-emerald-500/20 rounded-full flex items-center justify-center text-emerald-400 flex-shrink-0">
                                        <Check :size="10" stroke-width="3" />
                                    </div>
                                    <span class="hover:text-gray-200 transition-colors duration-200">{{ feat }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-2">
                            <Link 
                                :href="'/login'"
                                class="w-full text-center block font-bold text-xs py-3.5 rounded-xl transition-all duration-300 focus:outline-none"
                                :class="plan.isPopular 
                                    ? 'bg-emerald-500 hover:bg-emerald-400 text-black shadow-md shadow-emerald-500/10 hover:shadow-emerald-400/30' 
                                    : 'bg-[#16181f] hover:bg-gray-800 text-gray-300 border border-gray-800 hover:border-gray-700'"
                            >
                                Beli Token Sekarang
                            </Link>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ================= FEATURES SECTION (GRID HOVER ANIMATION) ================= -->
            <section class="border-t border-gray-900/60 pt-16">
                <div class="flex items-center gap-2 mb-10 justify-center">
                    <ShieldCheck class="text-emerald-500 animate-pulse" :size="20" />
                    <h2 class="text-xs font-bold tracking-widest text-gray-500 uppercase">Platform Features</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div 
                        v-for="item in features" 
                        :key="item.title"
                        class="bg-[#111317]/20 border border-gray-900/40 p-6 rounded-2xl space-y-4 hover:bg-[#111317]/60 hover:border-gray-800 hover:translate-y-[-4px] transition-all duration-300 group"
                    >
                        <div class="w-10 h-10 bg-[#16181f] border border-gray-800 rounded-xl flex items-center justify-center text-emerald-400 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-black transition-all duration-300">
                            <component :is="item.icon" :size="18" />
                        </div>
                        <div class="space-y-1">
                            <h3 class="text-sm font-bold text-gray-200 group-hover:text-white transition-colors">{{ item.title }}</h3>
                            <p class="text-xs text-gray-500 leading-relaxed">{{ item.desc }}</p>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- ================= FOOTER ================= -->
        <footer class="border-t border-gray-900/60 py-8 text-center text-[11px] text-gray-600 tracking-wide">
            &copy; 2026 BreakLoop Music Platform. All rights reserved.
        </footer>
    </div>
</template>

<style scoped>
/* Custom utilities animation fallback */
.animate-spin-slow {
    animation: spin 8s linear infinite;
}
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}
</style>