@aware(['darkIcon'=>'moon','lightIcon'=>'sun','systemIcon'=>'computer-desktop','iconVariant' => "mini"])
<x-ui.dropdown>
    <x-slot:button 
        class="cursor-pointer hover:opacity-80 transition"
        role="button"
        aria-haspopup="true"
        aria-expanded="false"
        aria-controls="theme-menu"
    >
        <x-ui.icon :name="$darkIcon" :variant="$iconVariant" class="dark:hidden inline-flex"/>
        <x-ui.icon :name="$lightIcon" :variant="$iconVariant" class="hidden dark:inline-flex"/>
    </x-slot:button>
    
    <x-slot:menu>
        <x-ui.dropdown.item 
            :icon="$lightIcon"
            :iconVariant="$iconVariant"
            x-on:click="$theme.setLight();close()"
            x-bind:class="{'dark:bg-white/5 bg-black/5' : $theme.isLight }"
        >
            light
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item 
            :icon="$darkIcon"
            :iconVariant="$iconVariant"
            x-on:click="$theme.setDark();close()"
            x-bind:class="{'dark:bg-white/5 bg-black/5' : $theme.isDark }"
        >
            dark
        </x-ui.dropdown.item>
        
        <x-ui.dropdown.item 
            :icon="$systemIcon"
            :iconVariant="$iconVariant"
            x-on:click="$theme.setSystem();close()"
            x-bind:class="{'dark:bg-white/5 bg-black/5' : $theme.isSystem }"
        >
            system
        </x-ui.dropdown.item>
    </x-slot:menu>
</x-ui.dropdown>