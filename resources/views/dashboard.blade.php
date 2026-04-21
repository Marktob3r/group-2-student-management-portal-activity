<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold text-white">Student Enrollment Records</h2>
                <p class="text-xs mt-0.5" style="color:rgba(255,255,255,0.5);">Gordon College · College of Computer Studies</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8"
        x-data="{
            showAdd: false, showEdit: false,
            showDelete: false, showLogout: false,
            selected: { id:null, student_id:'', name:'', course:'', year:'', block:'' },
            openEdit(e) { this.selected = {...e}; this.showEdit = true; },
            openDelete(e) { this.selected = {...e}; this.showDelete = true; }
        }"
        @logout.window="showLogout = false"
        @open-logout.window="showLogout = true">

        @if (session('success'))
            <div class="mb-5 p-4 rounded-xl flex items-center gap-3 border"
                style="background:#F0FDF4; border-color:#86EFAC; color:#166534;">
                <svg class="h-5 w-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-sm font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Top bar --}}
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="px-4 py-2 rounded-xl text-sm font-semibold"
                    style="background:#1B2A4A; color:#C9A84C; border:1px solid rgba(201,168,76,0.3);">
                    Total Enrollees: <span class="font-bold">{{ $enrollees->count() }}</span>
                </div>
            </div>
            <button @click="showAdd = true"
                class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold shadow-md transition-all duration-200 active:scale-95 focus:outline-none"
                style="background:#C9A84C; color:#1B2A4A;"
                onmouseover="this.style.background='#E2C170'; this.style.transform='translateY(-1px)'"
                onmouseout="this.style.background='#C9A84C'; this.style.transform='translateY(0)'">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Add Enrollee
            </button>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto rounded-2xl shadow-lg border" style="border-color:#dde3ed;">
            <table class="min-w-full text-sm">
                <thead>
                    <tr style="background:linear-gradient(135deg,#1B2A4A 0%,#243459 100%);">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Student ID</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Full Name</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Course</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Year</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Block</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color:#C9A84C; letter-spacing:0.8px;">Actions</th>
                    </tr>
                </thead>
                <tbody style="background:#fff; divide-color:#eef0f5;">
                    @forelse ($enrollees as $i => $e)
                    <tr class="transition-colors duration-150 hover:bg-blue-50"
                        style="background:{{ $i%2===0 ? '#ffffff' : '#F8F9FC' }}; border-bottom:1px solid #eef0f5;">
                        <td class="px-6 py-4 font-bold text-xs" style="color:#1B2A4A; font-family:monospace; letter-spacing:0.5px;">{{ $e->student_id }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $e->name }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold"
                                style="background:rgba(27,42,74,0.08); color:#1B2A4A;">
                                {{ $e->course }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold"
                                style="background:rgba(201,168,76,0.15); color:#7A5C10;">
                                Year {{ $e->year }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-bold"
                                style="background:rgba(27,42,74,0.08); color:#1B2A4A;">
                                {{ $e->block }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button
                                    @click="openEdit({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}', name:'{{ addslashes($e->name) }}', course:'{{ $e->course }}', year:'{{ $e->year }}', block:'{{ $e->block }}' })"
                                    class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all duration-150 active:scale-95"
                                    style="background:#1B2A4A; color:#C9A84C; border:1px solid rgba(201,168,76,0.3);"
                                    onmouseover="this.style.background='#243459'"
                                    onmouseout="this.style.background='#1B2A4A'">
                                    Edit
                                </button>
                                <button
                                    @click="openDelete({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}', name:'{{ addslashes($e->name) }}' })"
                                    class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all duration-150 active:scale-95"
                                    style="background:#FEF2F2; color:#DC2626; border:1px solid #FECACA;"
                                    onmouseover="this.style.background='#FEE2E2'"
                                    onmouseout="this.style.background='#FEF2F2'">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="text-4xl">📋</div>
                                <p class="font-semibold text-gray-500">No enrollees found</p>
                                <p class="text-xs text-gray-400">Click "Add Enrollee" to get started.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ADD MODAL --}}
        <div x-show="showAdd" x-transition style="display:none"
            class="fixed inset-0 flex items-center justify-center z-50 p-4"
            style="background:rgba(17,29,53,0.7); backdrop-filter:blur(4px);">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
                <div class="px-6 py-4 flex justify-between items-center"
                    style="background:linear-gradient(135deg,#1B2A4A,#243459); border-bottom:3px solid #C9A84C;">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background:rgba(201,168,76,0.2);">➕</div>
                        <h3 class="text-base font-bold text-white">Add New Enrollee</h3>
                    </div>
                    <button @click="showAdd=false" class="text-white/60 hover:text-white text-2xl leading-none transition">&times;</button>
                </div>
                <form method="POST" action="{{ route('enrollees.store') }}" class="p-6 space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Student ID <span class="text-red-500">*</span></label>
                        <input type="text" name="student_id" maxlength="6" placeholder="e.g. 230001 (6 digits)"
                            class="w-full border-2 rounded-xl p-3 text-sm focus:outline-none transition @error('student_id') border-red-400 @else border-gray-200 @enderror"
                            style="focus-border-color:#1B2A4A;" />
                        @error('student_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="e.g. Maria Santos"
                            class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition @error('name') border-red-400 @enderror" />
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course <span class="text-red-500">*</span></label>
                        <select name="course" class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                            <option value="">-- Select Course --</option>
                            @foreach(['BSIT','BSCS','BSCS-EMC DAT','BSEMC-GD'] as $course)
                            <option value="{{ $course }}">{{ $course }}</option>
                            @endforeach
                        </select>
                        @error('course')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Year Level <span class="text-red-500">*</span></label>
                            <select name="year" class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                                <option value="">-- Year --</option>
                                @foreach([1,2,3,4] as $yr)
                                <option value="{{ $yr }}">Year {{ $yr }}</option>
                                @endforeach
                            </select>
                            @error('year')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Block <span class="text-red-500">*</span></label>
                            <div class="flex gap-2">
                                <select name="block_select" class="flex-1 border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                                    <option value="">A–D</option>
                                    @foreach(['A','B','C','D'] as $blk)
                                    <option value="{{ $blk }}">{{ $blk }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="block" placeholder="Custom"
                                    @input="$event.target.value = $event.target.value.replace(/[^A-Z]/g,'').slice(0,5)"
                                    maxlength="5"
                                    class="w-20 border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition" />
                            </div>
                            @error('block')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showAdd=false"
                            class="px-5 py-2 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2 rounded-xl text-sm font-bold shadow transition-all active:scale-95"
                            style="background:#C9A84C; color:#1B2A4A;"
                            onmouseover="this.style.background='#E2C170'"
                            onmouseout="this.style.background='#C9A84C'">
                            Add Enrollee
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div x-show="showEdit" x-transition style="display:none"
            class="fixed inset-0 flex items-center justify-center z-50 p-4"
            style="background:rgba(17,29,53,0.7); backdrop-filter:blur(4px);">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden">
                <div class="px-6 py-4 flex justify-between items-center"
                    style="background:linear-gradient(135deg,#1B2A4A,#243459); border-bottom:3px solid #C9A84C;">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background:rgba(201,168,76,0.2);">✏️</div>
                        <h3 class="text-base font-bold text-white">Edit Enrollee — <span class="font-mono" x-text="selected.student_id"></span></h3>
                    </div>
                    <button @click="showEdit=false" class="text-white/60 hover:text-white text-2xl leading-none transition">&times;</button>
                </div>
                <form method="POST" :action="`/enrollees/${selected.id}`" class="p-6 space-y-4">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Student ID</label>
                        <p class="rounded-xl p-3 text-sm font-mono font-bold" style="background:#F8F9FC; color:#1B2A4A;" x-text="selected.student_id"></p>
                        <small class="text-gray-400 text-xs mt-1 block">Student ID cannot be changed.</small>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" x-model="selected.name"
                            class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition" />
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Course <span class="text-red-500">*</span></label>
                        <select name="course" x-model="selected.course" class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                            <option value="">-- Select Course --</option>
                            @foreach(['BSIT','BSCS','BSCS-EMC DAT','BSEMC-GD'] as $course)
                            <option value="{{ $course }}">{{ $course }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Year Level <span class="text-red-500">*</span></label>
                            <select name="year" x-model="selected.year" class="w-full border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                                <option value="">-- Year --</option>
                                @foreach([1,2,3,4] as $yr)
                                <option value="{{ $yr }}">Year {{ $yr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Block <span class="text-red-500">*</span></label>
                            <div class="flex gap-2">
                                <select name="block_select" x-model="selected.block" class="flex-1 border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition">
                                    <option value="">A–D</option>
                                    @foreach(['A','B','C','D'] as $blk)
                                    <option value="{{ $blk }}">{{ $blk }}</option>
                                    @endforeach
                                </select>
                                <input type="text" name="block" x-model="selected.block"
                                    @input="selected.block = $event.target.value.replace(/[^A-Z]/g,'').slice(0,5)"
                                    placeholder="Custom" maxlength="5"
                                    class="w-20 border-2 border-gray-200 rounded-xl p-3 text-sm focus:outline-none transition" />
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" @click="showEdit=false"
                            class="px-5 py-2 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2 rounded-xl text-sm font-bold shadow transition-all active:scale-95"
                            style="background:#C9A84C; color:#1B2A4A;"
                            onmouseover="this.style.background='#E2C170'"
                            onmouseout="this.style.background='#C9A84C'">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DELETE MODAL --}}
        <div x-show="showDelete" x-transition style="display:none"
            class="fixed inset-0 flex items-center justify-center z-50 p-4"
            style="background:rgba(17,29,53,0.7); backdrop-filter:blur(4px);">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
                <div class="px-6 py-4" style="background:linear-gradient(135deg,#7f1d1d,#991b1b); border-bottom:3px solid #FCA5A5;">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-sm" style="background:rgba(255,255,255,0.15);">🗑️</div>
                        <h3 class="text-base font-bold text-white">Confirm Deletion</h3>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-700 mb-1">
                        Are you sure you want to delete <strong x-text="selected.name"></strong>
                        (<span class="font-mono text-xs" x-text="selected.student_id"></span>)?
                    </p>
                    <p class="text-xs font-semibold mb-6" style="color:#DC2626;">⚠️ This action cannot be undone.</p>
                    <form method="POST" :action="`/enrollees/${selected.id}`">
                        @csrf @method('DELETE')
                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showDelete=false"
                                class="px-5 py-2 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-6 py-2 rounded-xl text-sm font-bold text-white shadow transition-all active:scale-95"
                                style="background:#DC2626;"
                                onmouseover="this.style.background='#B91C1C'"
                                onmouseout="this.style.background='#DC2626'">
                                Yes, Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- LOGOUT MODAL --}}
        <div x-show="showLogout"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            style="display:none"
            class="fixed inset-0 flex items-center justify-center z-50 p-4"
            style="background:rgba(17,29,53,0.7); backdrop-filter:blur(4px);"
            @keydown.escape.window="showLogout = false">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
                <div class="px-6 py-5 flex items-center gap-3"
                    style="background:linear-gradient(135deg,#1B2A4A,#243459); border-bottom:3px solid #C9A84C;">
                    <div class="flex-shrink-0 w-9 h-9 rounded-full flex items-center justify-center" style="background:rgba(201,168,76,0.2);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" style="color:#C9A84C;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                    </div>
                    <h3 class="text-base font-bold text-white">Confirm Logout</h3>
                </div>
                <div class="p-6">
                    <p class="text-base font-semibold text-gray-800 mb-1">Are you sure you want to logout?</p>
                    <p class="text-sm text-gray-500 mb-6">Your current session will be ended.</p>
                    <div class="flex justify-end gap-3">
                        <button id="logout-modal-cancel" type="button" @click="showLogout = false"
                            class="px-5 py-2 rounded-xl text-sm font-semibold border border-gray-200 text-gray-600 hover:bg-gray-50 transition">
                            Cancel
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button id="logout-modal-confirm" type="submit"
                                class="px-6 py-2 rounded-xl text-sm font-bold shadow transition-all active:scale-95"
                                style="background:#C9A84C; color:#1B2A4A;"
                                onmouseover="this.style.background='#E2C170'"
                                onmouseout="this.style.background='#C9A84C'">
                                Yes, Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end x-data --}}
</x-app-layout>