<x-app-layout>
    <div class="relative flex size-full min-h-screen flex-col bg-white dark:bg-[#101a23] group/design-root overflow-x-hidden">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-[#101a23] overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-[#314f68]">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold mb-4">Edit Prospect</h2>
                        
                        <form method="POST" action="{{ route('prospects.update', $prospect) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label for="name_first" class="block text-sm font-medium text-gray-700 dark:text-gray-200">First Name</label>
                                <input type="text" name="name_first" id="name_first" value="{{ old('name_first', $prospect->name_first) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="name_last" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Last Name</label>
                                <input type="text" name="name_last" id="name_last" value="{{ old('name_last', $prospect->name_last) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $prospect->email) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ old('phone', $prospect->phone) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="fax" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fax</label>
                                <input type="text" name="fax" id="fax" value="{{ old('fax', $prospect->fax) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="company" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Company</label>
                                <input type="text" name="company" id="company" value="{{ old('company', $prospect->company) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                                <select name="status" id="status" 
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="0" {{ $prospect->status == 0 ? 'selected' : '' }}>DEAD</option>
                                    <option value="1" {{ $prospect->status == 1 ? 'selected' : '' }}>COLD</option>
                                    <option value="2" {{ $prospect->status == 2 ? 'selected' : '' }}>NEUTRAL</option>
                                    <option value="3" {{ $prospect->status == 3 ? 'selected' : '' }}>WARM</option>
                                    <option value="4" {{ $prospect->status == 4 ? 'selected' : '' }}>HOT</option>
                                </select>
                            </div>

                            <div class="flex gap-4">
                                <button type="submit" 
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Prospect
                                </button>
                                <a href="{{ route('prospects.index') }}" 
                                    class="inline-flex justify-center rounded-md border border-gray-300 dark:border-[#314f68] bg-white dark:bg-[#223749] py-2 px-4 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm hover:bg-gray-50 dark:hover:bg-[#314f68] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 