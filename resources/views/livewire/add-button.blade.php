<div>
    <button type="submit" wire:click.prevent="prosesData" wire:target="prosesData"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        <span wire:loading.remove wire:target="prosesData">Add</span>
        <span wire:loading wire:target="prosesData" class="hidden animate-pulse">Processing...</span>
    </button>
</div>

