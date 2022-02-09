<template>
    <button :class="classes">
        <slot />
    </button>
</template>

<script>
import { defineComponent } from 'vue'

export default defineComponent({
    props: ['active'],

    computed: {
        classes() {
            return this.active
                ? 'px-5 py-3 text-base font-medium text-black border-b border-indigo-600 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out'
                : 'px-5 py-3 text-base font-medium text-black border-b border-white hover:border-gray-100 hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out'
        }
    }
})
</script>
