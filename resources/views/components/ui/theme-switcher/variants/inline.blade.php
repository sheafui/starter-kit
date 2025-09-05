@aware(['darkIcon'=>'moon','lightIcon'=>'sun','iconVariant' => "mini"])

<div
    class="flex items-center transition-all duration-200 size-10 overflow-hidden"
 >
    <x-ui.button 
        :icon="$lightIcon" 
        :$iconVariant
        variant="none"
        class="hover:opacity-80 transition"
        x-show="$theme.isResolvedToLight"
        x-on:click="$theme.toggle()"
        style="display: none;"
        iconVariant="outline"
        role="button"
        aria-pressed="true"
        x-bind:aria-pressed="$theme.isResolvedToLight"
        aria-label="Activate light theme"
    />
    <x-ui.button 
        :icon="$darkIcon" 
        :$iconVariant
        variant="none"
        class="hover:opacity-80 transition"
        x-show="$theme.isResolvedToDark"
        x-on:click="$theme.toggle()"
        style="display: none;"
        iconVariant="outline"
        role="button"
        aria-pressed="true"
        x-bind:aria-pressed="$theme.isResolvedToDark"
        aria-label="Activate dark theme"
    />
</div>