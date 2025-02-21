<x-app-layout>
    <div class="relative flex size-full min-h-screen flex-col bg-white dark:bg-[#101a23] group/design-root overflow-x-hidden">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-[#101a23] overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-[#314f68]">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold mb-4">View/Edit Pitch</h2>

                        <form method="POST" action="{{ route('salesai.update', $pitch) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="prompt" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Original Prompt</label>
                                <input type="text" name="prompt" id="prompt" value="{{ old('prompt', $pitch->prompt) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="response" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Response</label>
                                <textarea name="response" id="response" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('response', $pitch->response) }}</textarea>
                            </div>

                            <div class="flex gap-4">
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Pitch
                                </button>
                                <a href="{{ route('pitches.index') }}"
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
