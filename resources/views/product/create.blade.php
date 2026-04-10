<x-app-layout>
    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md overflow-hidden">

                {{-- Card Header --}}
                <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center gap-3">
                    <a href="{{ route('product.index') }}"
                        class="p-1.5 rounded-lg text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 leading-tight">Add New Product</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Fill in the details to add a new product</p>
                    </div>
                </div>

                {{-- Form Body --}}
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="px-6 py-6 space-y-5">

                        {{-- Product Name --}}
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                placeholder="e.g. Laptop, Camera, etc.">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Quantity & Price (side by side) --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Quantity</label>
                                <input type="number" name="qty" id="qty" value="{{ old('qty', 0) }}" min="0"
                                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('qty')
                                    <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Price (Rp)</label>
                                <input type="number" name="price" id="price" value="{{ old('price', 0) }}" min="0" step="0.01"
                                    class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('price')
                                    <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Owner --}}
                        <div>
                            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Product Owner</label>
                            <select name="user_id" id="user_id"
                                class="block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                <option value="" disabled selected>Select an owner</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} — {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="mt-1.5 text-xs text-red-500 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    {{-- Card Footer --}}
                    <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('product.index') }}"
                            class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition">
                            Create Product
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>
