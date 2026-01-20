<div class="grid grid-cols-4 gap-8 my-12"
    x-data="{ colors: ['white', 'black', 'primary', 'secondary', 'accent', 'neutral', 'error', 'success', 'warning', 'muted', 'destructive'] }">
    <template x-for="(color, index) in colors" :key="index">
        <div class="border rounded-lg overflow-hidden">
            <header class="p-4">
                <h2 x-text="color"></h2>
            </header>

            <section :class="`bg-${color} p-4`">
                <div x-data="{ shades: ['dark', 'light'] }">
                    <div class="flex">
                        <!-- Adjusted grid-cols based on the number of items -->
                        <template x-for="shade in shades">
                            <div class="p-2 text-center rounded-full h-8 w-8" :class="`bg-${color}-${shade}`"></div>
                        </template>
                    </div>
                </div>
            </section>
        </div>

    </template>
</div>