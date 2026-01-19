<div class="grid grid-cols-4 gap-8 my-12" x-data="{ colors: ['white', 'black', 'primary', 'secondary', 'accent', 'neutral', 'error', 'success', 'warning', 'muted', 'destructive'] }">
    <template x-for="(color, index) in colors" :key="index">
        <div :class="`bg-${color} p-4`">
            <p x-text="color"></p>
            <div x-data="{ shades: ['dark', 'light'] }">
                <div class="grid grid-cols-2"> <!-- Adjusted grid-cols based on the number of items -->
                    <template x-for="shade in shades">
                        <div class="p-2 text-center" :class="`bg-${color}-${shade}`" x-text="shade"></div>
                    </template>
                </div>
            </div>
        </div>
    </template>
</div>