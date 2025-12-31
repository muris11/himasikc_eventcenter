                    <input type="text" wire:model="name" id="name"
                        class="w-full px-3 py-2 border border-border rounded-lg shadow-sm focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors bg-surface text-text-main placeholder-text-muted/50"
                        placeholder="Masukkan nama kategori">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3 pt-6 border-t border-border">
                    <a href="{{ route('admin.blog-categories.index') }}"
                        class="px-4 py-2 border border-border text-text-muted rounded-lg hover:bg-surface-secondary hover:text-text-main transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white rounded-lg shadow-sm shadow-primary-500/30 transition-all flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Buat Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
