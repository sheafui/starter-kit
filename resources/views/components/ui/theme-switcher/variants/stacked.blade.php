@aware(['darkIcon'=>'moon','lightIcon'=>'sun','systemIcon'=>'computer-desktop','iconVariant' => "mini"])
<div class=" flex items-center transition-all border rounded-box dark:border-white/10 border-black/10 duration-200 overflow-hidden">
    <x-ui.button 
        :icon="$lightIcon"
        :iconVariant="$iconVariant"
        variant="none" {{-- the button itself variant --}}
        class="dark:hover:bg-white/10 hover:bg-black/5"
        x-on:click="$theme.setLight()"
        x-bind:class="{
            'dark:!bg-white/5 !bg-black/10' : $theme.isLight
        }"
        role="button"
        aria-pressed="true"
        x-bind:aria-pressed="$theme.isLight"
        aria-label="Activate light theme"
    />
    <x-ui.button 
        :icon="$darkIcon"
        :iconVariant="$iconVariant"
        variant="none" {{-- the button itself variant --}}
        class="dark:hover:bg-white/10 hover:bg-black/5"
        x-on:click="$theme.setDark()"
        x-bind:class="{
            'dark:!bg-white/5 !bg-black/10' : $theme.isDark
        }"
        role="button"
        aria-pressed="true"
        x-bind:aria-pressed="$theme.isDark"
        aria-label="Activate dark theme"
    />
    <x-ui.button 
        :icon="$systemIcon"
        :iconVariant="$iconVariant"
        variant="none" {{-- the button itself variant --}}
        class="dark:hover:bg-white/10 hover:bg-black/5"
        x-on:click="$theme.setSystem()"
        x-bind:class="{
            'dark:!bg-white/5 !bg-black/10' : $theme.isSystem
        }"
        role="button"
        aria-pressed="true"
        x-bind:aria-pressed="$theme.isSystem"
        aria-label="Activate system theme"
    />
</div>