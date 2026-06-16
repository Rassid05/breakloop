<script setup>
import { Link, usePage } from '@inertiajs/vue3'
import { computed, ref } from 'vue'
import { 
    LayoutDashboard, 
    Users, 
    Mic2, 
    Music, 
    Library, 
    UploadCloud, 
    BarChart3, 
    Compass, 
    Heart, 
    Store, 
    LogOut, 
    User as UserIcon, 
    ChevronDown,
    Bell,
    Menu,
    X
} from 'lucide-vue-next'

const user = computed(() => usePage().props.auth?.user)
const currentUrl = computed(() => usePage().url)

// State Kontrol Responsive
const isProfileOpen = ref(false)
const isSidebarMobileOpen = ref(false) // State laci sidebar mobile

const isActive = (url) => currentUrl.value.startsWith(url)
</script>

<template>
    <div class="flex h-screen bg-[#07080a] text-gray-100 antialiased selection:bg-emerald-500 selection:text-black overflow-hidden">
        
        <!-- ================= OVERLAY BLACKOUT (Hanya muncul di HP saat sidebar terbuka) ================= -->
        <transition name="fade">
            <div 
                v-if="isSidebarMobileOpen" 
                @click="isSidebarMobileOpen = false"
                class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"
            ></div>
        </transition>

        <!-- ================= SIDEBAR (DESKTOP & MOBILE SIDE-DRAWER) ================= -->
        <aside 
            class="fixed inset-y-0 left-0 w-64 bg-[#0b0c0e] border-r border-gray-900/80 flex flex-col justify-between z-50 transition-transform duration-300 lg:static lg:translate-x-0"
            :class="isSidebarMobileOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <!-- Pendaran cahaya dekoratif di atas sidebar -->
            <div class="absolute top-0 left-0 w-full h-32 bg-gradient-to-b from-emerald-500/[0.03] to-transparent pointer-events-none"></div>

            <div>
                <!-- Header / Logo Brand + Tombol Close (Mobile Only) -->
                <div class="p-6 border-b border-gray-900/60 flex items-center justify-between">
                    <Link href="/" class="flex items-center gap-2.5 focus:outline-none group">
                        <div class="w-8 h-8 rounded-xl bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20 group-hover:scale-105 transition-transform duration-300">
                            <Music :size="16" class="text-black stroke-[2.5]" />
                        </div>
                        <div>
                            <h1 class="text-lg font-black tracking-wider bg-gradient-to-r from-white via-gray-200 to-gray-400 bg-clip-text text-transparent">
                                BreakLoop
                            </h1>
                            <p class="text-[10px] font-semibold text-emerald-500/80 uppercase tracking-widest mt-0.5">
                                Audio Platform
                            </p>
                        </div>
                    </Link>

                    <!-- Tombol X Close (Hanya muncul di HP) -->
                    <button @click="isSidebarMobileOpen = false" class="lg:hidden p-1 text-gray-500 hover:text-white transition-colors focus:outline-none">
                        <X :size="20" />
                    </button>
                </div>

                <!-- Bagian Navigasi Menu Dinamis Berdasarkan Role -->
                <nav class="p-4 space-y-1.5 overflow-y-auto max-h-[calc(100vh-160px)]">
                    <div class="px-3 mb-3 text-[10px] font-bold text-gray-600 uppercase tracking-widest">
                        Menu — {{ user?.role || 'Guest' }}
                    </div>

                    <!-- 1. NAVIGATION UNTUK ADMIN -->
                    <template v-if="user?.role === 'admin'">
                        <Link href="/admin/dashboard" :class="[isActive('/admin/dashboard') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <LayoutDashboard :size="16" :class="isActive('/admin/dashboard') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Dashboard</span>
                        </Link>
                        <Link href="/admin/users" :class="[isActive('/admin/users') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Users :size="16" :class="isActive('/admin/users') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Manage Users</span>
                        </Link>
                        <Link href="/admin/artists" :class="[isActive('/admin/artists') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Mic2 :size="16" :class="isActive('/admin/artists') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Manage Artists</span>
                        </Link>
                        <Link href="/admin/songs" :class="[isActive('/admin/songs') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Music :size="16" :class="isActive('/admin/songs') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Manage Songs</span>
                        </Link>
                    </template>

                    <!-- 2. NAVIGATION UNTUK ARTIST -->
                    <template v-else-if="user?.role === 'artist'">
                        <Link href="/artist/dashboard" :class="[isActive('/artist/dashboard') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <LayoutDashboard :size="16" :class="isActive('/artist/dashboard') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Dashboard</span>
                        </Link>
                        <Link href="/artist/songs" :class="[isActive('/artist/songs') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Library :size="16" :class="isActive('/artist/songs') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>My Songs</span>
                        </Link>
                        <Link href="/artist/upload" :class="[isActive('/artist/upload') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <UploadCloud :size="16" :class="isActive('/artist/upload') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Upload Song</span>
                        </Link>
                        <Link href="/artist/statistics" :class="[isActive('/artist/statistics') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <BarChart3 :size="16" :class="isActive('/artist/statistics') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Statistics</span>
                        </Link>
                    </template>

                    <!-- 3. NAVIGATION UNTUK REGULAR USER / BUYER -->
                    <template v-else>
                        <Link href="/discover" :class="[isActive('/discover') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Compass :size="16" :class="isActive('/discover') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Discover</span>
                        </Link>
                        <Link href="/favorites" :class="[isActive('/favorites') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Heart :size="16" :class="isActive('/favorites') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Favorites</span>
                        </Link>
                        <Link href="/samples" :class="[isActive('/samples') ? 'bg-emerald-500 text-black font-bold shadow-lg shadow-emerald-500/10' : 'text-gray-400 hover:text-white hover:bg-[#111317]']" class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-semibold transition-all duration-300 group">
                            <Store :size="16" :class="isActive('/samples') ? 'text-black' : 'text-gray-500 group-hover:text-emerald-400'" />
                            <span>Sample Store</span>
                        </Link>
                    </template>
                </nav>
            </div>

            <!-- Tombol Keluar Footer Sidebar -->
            <div class="p-4 border-t border-gray-900/60 bg-[#090a0c]">
                <Link
                    href="/logout"
                    method="post"
                    as="button"
                    class="w-full flex items-center justify-center gap-2 bg-rose-500/10 hover:bg-rose-500 border border-rose-500/20 text-rose-400 hover:text-black font-bold text-xs px-4 py-3 rounded-xl transition-all duration-300 focus:outline-none"
                >
                    <LogOut :size="14" />
                    <span>Sign Out</span>
                </Link>
            </div>
        </aside>

        <!-- ================= MAIN CONTENT CONTAINER ================= -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden relative z-10">
            <!-- Neon Glow Background -->
            <div class="absolute w-[300px] h-[300px] md:w-[500px] md:h-[500px] bg-emerald-500/[0.015] rounded-full filter blur-[120px] top-[-10%] right-[-10%] pointer-events-none"></div>

            <!-- ================= TOP HEADER BAR ================= -->
            <!-- Sesudah -->
<header class="h-16 md:h-18 border-b border-gray-900/80 bg-[#0b0c0e]/60 backdrop-blur-md flex justify-between items-center px-4 md:px-8 flex-shrink-0 relative z-30">
                
                <div class="flex items-center gap-3">
                    <!-- Hamburger Trigger Button (Hanya muncul di Layar HP/Tablet) -->
                    <button 
                        @click="isSidebarMobileOpen = true"
                        class="p-2 -ml-2 rounded-xl bg-[#111317] border border-gray-800 text-gray-400 hover:text-white lg:hidden focus:outline-none"
                    >
                        <Menu :size="18" />
                    </button>
                    
                    <h2 class="font-extrabold text-sm md:text-base tracking-tight text-white capitalize truncate max-w-[140px] md:max-w-none">
                        {{ currentUrl.split('/')[1] || 'Dashboard' }} Workspace
                    </h2>
                </div>

                <!-- Bagian Kanan Header -->
                <div class="flex items-center gap-2 md:gap-4">
                    <!-- Notifikasi -->
                    <button class="w-8 h-8 md:w-9 md:h-9 rounded-xl bg-[#111317] border border-gray-800 flex items-center justify-center text-gray-400 hover:text-white transition-colors focus:outline-none relative">
                        <span class="absolute top-2 right-2 w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                        <Bell :size="14" />
                    </button>

                    <div class="h-4 w-[1px] bg-gray-900"></div>

                    <!-- Dropdown User -->
                    <div class="relative">
                        <button 
                            @click="isProfileOpen = !isProfileOpen"
                            class="flex items-center gap-2 bg-[#111317] border border-gray-800 p-1.5 md:pl-2.5 md:pr-3 md:py-1.5 rounded-xl hover:border-gray-700 transition-all focus:outline-none select-none"
                        >
                            <div class="w-5 h-5 md:w-6 md:h-6 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center text-[10px] md:text-xs font-black uppercase">
                                {{ user?.name ? user.name.charAt(0) : 'U' }}
                            </div>
                            <span class="text-xs font-bold text-gray-300 max-w-[70px] md:max-w-[100px] truncate hidden sm:inline">
                                {{ user?.name || 'Guest' }}
                            </span>
                            <ChevronDown :size="12" class="text-gray-500" />
                        </button>

                        <div 
                            v-if="isProfileOpen"
                            class="absolute right-0 mt-2 w-44 bg-[#111317] border border-gray-800 rounded-xl py-1.5 shadow-2xl z-50 animate-fade-in"
                        >
                            <div class="px-3 py-1.5 border-b border-gray-900/80 mb-1">
                                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-wider">Signed in as</p>
                                <p class="text-xs font-semibold text-gray-300 truncate">{{ user?.email || 'user@breakloop.com' }}</p>
                            </div>
                            <Link href="/profile" class="flex items-center gap-2 px-3 py-2 text-xs font-medium text-gray-400 hover:text-white hover:bg-[#16181f] transition-colors">
                                <UserIcon :size="13" /> My Profile
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ================= ISI KONTEN ================= -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                <slot />
            </main>
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.15s ease-out forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-4px); }
    to { opacity: 1; transform: translateY(0); }
}
/* Efek Transisi Blackout Overlay */
.fade-enter-active, .fade-leave-active { transition: opacity 0.2s ease; }
.fade-enter-from, .fade-leave-to { opacity: 0; }
</style>