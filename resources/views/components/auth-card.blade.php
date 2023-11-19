<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div>
        {{ $logo }}
    </div>

    <div class="card card-side glass rounded bg-base-200 card-bordered w-2/3 sm:w-2/5">
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>