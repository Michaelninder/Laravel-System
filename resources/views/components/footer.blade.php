<footer class="bg-gray-100 text-gray-600 text-sm py-4 mt-12 border-t">
    <div class="container mx-auto px-4 flex flex-col sm:flex-row justify-between items-center">
        <div class="mb-2 sm:mb-0 text-center sm:text-left">
            © {{ date('Y') }} {{ __('footer.copyright') }} —
            <a href="https://xpsystems.eu" target="_blank" class="text-blue-600 hover:underline font-semibold">
                xpsystems.eu
            </a>
        </div>

        <div class="text-center sm:text-right">
            {{ __('footer.built_by') }}
            <a href="https://github.com/Michaelninder/Laravel-System/tree/main" target="_blank" class="text-blue-600 hover:underline font-semibold">
                michaelninder
            </a>
            —
            <span class="italic">{{ __('footer.project') }}: Laravel-System</span>
        </div>
    </div>
</footer>
