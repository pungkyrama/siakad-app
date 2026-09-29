<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Akademik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex h-full shadow-xl z-10">
        <div class="h-16 flex items-center justify-center border-b border-slate-800">
            <h1 class="text-2xl font-bold tracking-wider text-blue-400">SIAKAD<span class="text-white">PRO</span></h1>
        </div>
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center px-6 py-3 text-slate-300 hover:bg-slate-800 hover:text-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                
                <li class="pt-4 pb-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Master Data</li>
                <li><a href="{{ route('faculties.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Fakultas</a></li>
                <li><a href="{{ route('departments.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Program Studi</a></li>
                <li><a href="{{ route('academic-years.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Tahun Akademik</a></li>
                <li><a href="{{ route('rooms.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Ruangan</a></li>
                <li><a href="{{ route('courses.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Mata Kuliah</a></li>

                <li class="pt-4 pb-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Pengguna</li>
                <li><a href="{{ route('lecturers.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Dosen</a></li>
                <li><a href="{{ route('students.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Mahasiswa</a></li>

                <li class="pt-4 pb-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Akademik</li>
                <li><a href="{{ route('class-schedules.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Jadwal Kelas</a></li>
                <li><a href="{{ route('krs.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">KRS Mahasiswa</a></li>
                <li><a href="{{ route('grades.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Penilaian</a></li>

                <li class="pt-4 pb-2 px-6 text-xs font-semibold text-slate-500 uppercase tracking-wider">Keuangan</li>
                <li><a href="{{ route('invoices.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Tagihan UKT</a></li>
                <li><a href="{{ route('payments.index') }}" class="block px-6 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">Pembayaran</a></li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <!-- Header -->
        <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6 z-0">
            <div class="flex items-center">
                <!-- Mobile menu button (optional) -->
                <button class="md:hidden text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <div class="flex items-center space-x-4">
                <div class="text-sm font-medium text-gray-700">Admin</div>
                <div class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold">
                    A
                </div>
            </div>
        </header>

        <!-- Main Workspace -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 p-6">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-sm" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
