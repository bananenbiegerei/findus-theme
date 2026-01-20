<div class="grid grid-cols-4 gap-8 my-12"
    x-data="{
        colors: [
            { name: 'background', hasForeground: true },
            { name: 'foreground', hasForeground: false },
            { name: 'card', hasForeground: true },
            { name: 'popover', hasForeground: true },
            { name: 'primary', hasForeground: true },
            { name: 'secondary', hasForeground: true },
            { name: 'muted', hasForeground: true },
            { name: 'accent', hasForeground: true },
            { name: 'destructive', hasForeground: true },
            { name: 'border', hasForeground: false },
            { name: 'input', hasForeground: false },
            { name: 'ring', hasForeground: false }
        ]
    }">
    <template x-for="(color, index) in colors" :key="index">
        <div class="border rounded-lg overflow-hidden">
            <header class="p-4">
                <h2 x-text="color.name" class="capitalize"></h2>
            </header>

            <section :class="`bg-${color.name} p-4 min-h-16`">
                <template x-if="color.hasForeground">
                    <div class="flex items-center gap-2">
                        <div class="p-2 text-center rounded-full h-8 w-8" :class="`bg-${color.name}-foreground`"></div>
                        <span class="text-xs" :class="`text-${color.name}-foreground`">foreground</span>
                    </div>
                </template>
            </section>
        </div>
    </template>
</div>
