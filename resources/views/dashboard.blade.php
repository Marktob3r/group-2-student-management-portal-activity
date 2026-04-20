<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Student Enrollment Records
            </h2>
        </div>
    </x-slot>

    <div class="py-8 px-6"
        x-data="{
            showAdd: false, showEdit: false,
            showDelete: false, showLogout: false,
            selected: { id:null, student_id:'', name:'',
            course:'', year:'', block:'' },
            openEdit(e) { this.selected = {...e}; this.showEdit = true; },
            openDelete(e) { this.selected = {...e}; this.showDelete = true; }
        }"
        @logout.window="showLogout = false"
        @open-logout.window="showLogout = true">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-700">
                Total Enrollees: <span class="text-green-700">{{ $enrollees->count() }}</span>
            </h3>
            <button @click="showAdd = true"
                class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold
                hover:bg-green-700 shadow-md transition duration-200">
                + Add Enrollee
            </button>
        </div>

        <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
            <table class="min-w-full text-sm">
                <thead class="bg-gradient-to-r from-green-700 to-green-800 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Student ID</th>
                        <th class="px-6 py-4 text-left font-semibold">Name</th>
                        <th class="px-6 py-4 text-left font-semibold">Course</th>
                        <th class="px-6 py-4 text-left font-semibold">Year</th>
                        <th class="px-6 py-4 text-left font-semibold">Block</th>
                        <th class="px-6 py-4 text-left font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($enrollees as $i => $e)
                    <tr class="hover:bg-gray-50 transition {{ $i%2===0?'bg-white':'bg-gray-50' }}">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $e->student_id }}</td>
                        <td class="px-6 py-4">{{ $e->name }}</td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">{{ $e->course }}</span></td>
                        <td class="px-6 py-4"><span class="font-medium">Year {{ $e->year }}</span></td>
                        <td class="px-6 py-4"><span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">{{ $e->block }}</span></td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <button
                                    @click="openEdit({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}',
                                    name:'{{ $e->name }}', course:'{{ $e->course }}',
                                    year:'{{ $e->year }}', block:'{{ $e->block }}' })"
                                    class="bg-blue-600 text-white px-4 py-1 rounded text-sm
                                    font-medium hover:bg-blue-700 transition shadow">Edit
                                </button>
                                <button
                                    @click="openDelete({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}',
                                    name:'{{ $e->name }}' })"
                                    class="bg-red-600 text-white px-4 py-1 rounded text-sm
                                    font-medium hover:bg-red-700 transition shadow">Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-6 py-8 text-center text-gray-400">
                        No enrollees found. Click "Add Enrollee" to get started.
                    </td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ADD MODAL --}}
        <div x-show="showAdd" x-transition style="display:none"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">Add New Enrollee</h3>
                    <button @click="showAdd=false" class="text-white text-2xl hover:text-gray-100">&times;</button>
                </div>
                <form method="POST" action="{{ route('enrollees.store') }}" class="p-6">
                    @csrf
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Student ID <span class="text-red-500">*</span></label>
                        <input type="text" name="student_id" maxlength="6"
                            placeholder="e.g. 230001 (6 digits)"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition @error('student_id') border-red-500 @enderror" />
                        @error('student_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" placeholder="e.g. Maria Santos"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition @error('name') border-red-500 @enderror" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Course <span class="text-red-500">*</span></label>
                        <select name="course"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition">
                            <option value="">-- Select Course --</option>
                            @foreach(['BSIT','BSCS','BSCS-EMC DAT','BSEMC-GD'] as $course)
                            <option value="{{ $course }}">{{ $course }}</option>
                            @endforeach
                        </select>
                        @error('course')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Year Level <span class="text-red-500">*</span></label>
                        <select name="year"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition">
                            <option value="">-- Select Year --</option>
                            @foreach([1,2,3,4] as $yr)
                            <option value="{{ $yr }}">Year {{ $yr }}</option>
                            @endforeach
                        </select>
                        @error('year')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Block <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <select name="block_select" 
                                class="flex-1 border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition">
                                <option value="">-- A, B, C, D --</option>
                                @foreach(['A','B','C','D'] as $blk)
                                <option value="{{ $blk }}">{{ $blk }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="block" placeholder="Custom (A-Z)"
                                @input="$event.target.value = $event.target.value.replace(/[^A-Z]/g,'').slice(0,5)"
                                maxlength="5"
                                class="flex-1 border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-green-500 focus:outline-none transition" />
                        </div>
                        <small class="text-gray-500 text-xs mt-1 block">Choose from preset OR enter custom (capital letters only)</small>
                        @error('block')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-3 mt-8">
                        <button type="button" @click="showAdd=false"
                            class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                            Cancel</button>
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow">
                            Add Enrollee</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- EDIT MODAL --}}
        <div x-show="showEdit" x-transition style="display:none"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-white">
                        Edit Enrollee — <span x-text="selected.student_id"></span>
                    </h3>
                    <button @click="showEdit=false" class="text-white text-2xl hover:text-gray-100">&times;</button>
                </div>
                <form method="POST" :action="`/enrollees/${selected.id}`" class="p-6">
                    @csrf @method('PUT')
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Student ID</label>
                        <p class="bg-gray-100 p-3 rounded-lg text-sm font-medium" x-text="selected.student_id"></p>
                        <small class="text-gray-500 text-xs mt-1 block">Student ID cannot be changed.</small>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" x-model="selected.name"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-blue-500 focus:outline-none transition" />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Course <span class="text-red-500">*</span></label>
                        <select name="course" x-model="selected.course"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-blue-500 focus:outline-none transition">
                            <option value="">-- Select Course --</option>
                            @foreach(['BSIT','BSCS','BSCS-EMC DAT','BSEMC-GD'] as $course)
                            <option value="{{ $course }}">{{ $course }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Year Level <span class="text-red-500">*</span></label>
                        <select name="year" x-model="selected.year"
                            class="w-full border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-blue-500 focus:outline-none transition">
                            <option value="">-- Select Year --</option>
                            @foreach([1,2,3,4] as $yr)
                            <option value="{{ $yr }}">Year {{ $yr }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Block <span class="text-red-500">*</span></label>
                        <div class="flex gap-2">
                            <select name="block_select" x-model="selected.block"
                                class="flex-1 border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-blue-500 focus:outline-none transition">
                                <option value="">-- A, B, C, D --</option>
                                @foreach(['A','B','C','D'] as $blk)
                                <option value="{{ $blk }}">{{ $blk }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="block" x-model="selected.block"
                                @input="selected.block = $event.target.value.replace(/[^A-Z]/g,'').slice(0,5)"
                                placeholder="Custom (A-Z)" maxlength="5"
                                class="flex-1 border-2 border-gray-300 rounded-lg p-3 text-sm focus:border-blue-500 focus:outline-none transition" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8">
                        <button type="button" @click="showEdit=false"
                            class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                            Cancel</button>
                        <button type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow">
                            Save Changes</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- DELETE MODAL --}}
        <div x-show="showDelete" x-transition style="display:none"
            class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-md overflow-hidden">
                <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">Confirm Deletion</h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-gray-700 mb-2">
                        Are you sure you want to delete
                        <strong x-text="selected.name"></strong>
                        (<span x-text="selected.student_id"></span>)?
                    </p>
                    <p class="text-xs text-red-600 mb-5 font-semibold">⚠️ This action cannot be undone.</p>
                    <form method="POST" :action="`/enrollees/${selected.id}`">
                        @csrf @method('DELETE')
                        <div class="flex justify-end gap-3">
                            <button type="button" @click="showDelete=false"
                                class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-400 transition">
                                Cancel</button>
                            <button type="submit"
                                class="px-6 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition shadow">
                                Yes, Delete</button>
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
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 p-4"
            @keydown.escape.window="showLogout = false">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden">
                {{-- Modal Header --}}
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-5 flex items-center gap-3">
                    <div class="flex-shrink-0 bg-white/20 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white">Confirm Logout</h3>
                </div>
                {{-- Modal Body --}}
                <div class="p-6">
                    <p class="text-base text-gray-700 mb-1 font-medium">
                        Are you sure you want to logout?
                    </p>
                    <p class="text-sm text-gray-500 mb-6">Your current session will be ended.</p>
                    <div class="flex justify-end gap-3">
                        <button
                            id="logout-modal-cancel"
                            type="button"
                            @click="showLogout = false"
                            class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 border border-gray-300 transition duration-150">
                            Cancel
                        </button>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button
                                id="logout-modal-confirm"
                                type="submit"
                                class="px-6 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg font-semibold hover:from-green-700 hover:to-green-800 shadow-md transition duration-150 active:scale-95">
                                Yes, Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>{{-- end x-data --}}
</x-app-layout>