<x-app-layout>
    <div class="relative flex size-full min-h-screen flex-col bg-white dark:bg-[#101a23] group/design-root overflow-x-hidden">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-[#101a23] overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-[#314f68]">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="text-2xl font-bold mb-4">View/Edit Note</h2>

                        <form method="POST" action="{{ route('notes.update', $note) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="prospect_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Prospect</label>
                                <select name="prospect_id" id="prospect_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    @foreach($prospects as $prospect)
                                        <option value="{{ $prospect->id }}" {{ $note->prospect_id == $prospect->id ? 'selected' : '' }}>
                                            {{ $prospect->name_first }} {{ $prospect->name_last }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Title</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $note->title) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Note</label>
                                <textarea name="body" id="body" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('body', $note->body) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="type_of_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Type of Contact</label>
                                <select name="type_of_contact" id="type_of_contact" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="Phone Call" {{ $note->type_of_contact == 'Phone Call' ? 'selected' : '' }}>Phone Call</option>
                                    <option value="Email" {{ $note->type_of_contact == 'Email' ? 'selected' : '' }}>Email</option>
                                    <option value="Meeting" {{ $note->type_of_contact == 'Meeting' ? 'selected' : '' }}>Meeting</option>
                                    <option value="Other" {{ $note->type_of_contact == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="ai_response_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Sales Pitch</label>
                                <select name="ai_response_id" id="ai_response_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="">No Pitch</option>
                                    @foreach($pitches as $pitch)
                                        <option value="{{ $pitch->id }}" {{ $note->ai_response_id == $pitch->id ? 'selected' : '' }}>
                                            #{{ $pitch->id }} - {{ Str::limit($pitch->response, 50) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Prospect Status</label>
                                <select name="status" id="status" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-[#314f68] dark:bg-[#223749] shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                    <option value="4" {{ $prospect->status == 4 ? 'selected' : '' }}>Hot</option>
                                    <option value="3" {{ $prospect->status == 3 ? 'selected' : '' }}>Warm</option>
                                    <option value="2" {{ $prospect->status == 2 ? 'selected' : '' }}>Neutral</option>
                                    <option value="1" {{ $prospect->status == 1 ? 'selected' : '' }}>Cold</option>
                                    <option value="0" {{ $prospect->status == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>

                            <div class="flex gap-4">
                                <button type="submit"
                                    class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                    Update Note
                                </button>
                                <a href="{{ route('notes.index') }}"
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
