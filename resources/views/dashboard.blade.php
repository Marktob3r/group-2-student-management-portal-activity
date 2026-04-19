<x-app-layout>
    <div class="py-8 px-6" x-data="{ 
        showAdd: false, 
        showEdit: false, 
        showDelete: false, 
        selected: { id:null, student_id:'', name:'', course:'', year:'', block:'' },
        openEdit(e) { this.selected = {...e}; this.showEdit = true; },
        openDelete(e) { this.selected = {...e}; this.showDelete = true; } 
    }">
        
        <div class="max-w-7xl mx-auto">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-gray-700">Total Enrollees: {{ $enrollees->count() }}</h3>
                <button @click="showAdd = true" class="bg-green-800 text-white px-4 py-2 rounded-lg font-semibold">
                    + Add Enrollee
                </button>
            </div>

            <div class="overflow-x-auto bg-white rounded-xl shadow">
                <table class="min-w-full text-sm">
                    <thead class="bg-green-900 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Student ID</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($enrollees as $e)
                        <tr>
                            <td class="px-4 py-3">{{ $e->student_id }}</td>
                            <td class="px-4 py-3">{{ $e->name }}</td>
                            <td class="px-4 py-3">
                                <button @click="openEdit({ id:{{ $e->id }}, student_id:'{{ $e->student_id }}', name:'{{ $e->name }}' })" class="text-blue-600 mr-2">Edit</button>
                                <button @click="openDelete({ id:{{ $e->id }}, name:'{{ $e->name }}' })" class="text-red-600">Delete</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="p-4 text-center">No records found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="showAdd" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-white rounded-xl p-6 w-full max-w-lg">
                <h3 class="text-lg font-bold mb-4">Add New Enrollee</h3>
                <form method="POST" action="{{ route('enrollees.store') }}">
                    @csrf
                    <input type="text" name="student_id" placeholder="Student ID" class="w-full mb-2 border rounded p-2">
                    <input type="text" name="name" placeholder="Full Name" class="w-full mb-2 border rounded p-2">
                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" @click="showAdd = false">Cancel</button>
                        <button type="submit" class="bg-green-800 text-white px-4 py-2 rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>