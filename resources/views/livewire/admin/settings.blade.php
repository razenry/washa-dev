<div class="bg-white dark:bg-gray-900 p-6 shadow-md text-gray-900 dark:text-white rounded-lg transition-colors">
    <h2 class="text-2xl font-semibold mb-4">Profile Management</h2>

    <form wire:submit.prevent="updateProfile">
        <div class="flex items-center space-x-4 mb-6">
            <!-- Profile Photo -->
            <img src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/100' }}"
                alt="Profile Picture"
                class="w-24 h-24 rounded-full border border-gray-300 dark:border-gray-700">

            <div>
                <label class="block text-sm font-medium">Profile Photo</label>
                <input type="file" wire:model="photo"
                    class="mt-2 block w-full text-sm text-gray-700 dark:text-gray-300
                    file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border file:border-gray-300 dark:file:border-gray-600
                    file:text-sm file:bg-gray-100 dark:file:bg-gray-800 hover:file:bg-gray-200 dark:hover:file:bg-gray-700">
            </div>
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label class="block text-sm font-medium">Email</label>
            <input type="email" wire:model="email"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-800
                border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring focus:ring-indigo-500
                text-gray-900 dark:text-white">
            @error('email') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Password Field -->
        <div class="mb-4">
            <label class="block text-sm font-medium">Password (Leave blank to keep current password)</label>
            <input type="password" wire:model="password"
                class="mt-1 block w-full px-4 py-2 bg-gray-100 dark:bg-gray-800
                border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring focus:ring-indigo-500
                text-gray-900 dark:text-white">
            @error('password') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Save Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                <span wire:loading.remove wire:target="add">Save changes</span>
                <span wire:loading wire:target="add" class="hidden">Processing...</span>
            </button>
        </div>
    </form>
</div>
