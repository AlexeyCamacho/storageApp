<template>
    <Disclosure as="nav" class="bg-white shadow" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button -->
                    <DisclosureButton class="z-10 inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <div class="block h-8 w-auto lg:hidden">
                            <StorageLogo></StorageLogo>
                        </div>
                        <div class="hidden h-8 w-auto lg:block">
                            <StorageLogo></StorageLogo>
                        </div>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <div class="hidden sm:-my-px sm:flex sm:space-x-8 ml-8" v-for="item in navigation">
                            <router-link
                                :key="item.name"
                                :to="item.href"
                                :class="[this.$route.path === item.href ? 'border-blue-400 text-gray-900' :
                                    'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700',
                                    'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium']"
                            >
                                {{ item.name }}
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DisclosurePanel class="sm:hidden">
            <div class="space-y-1 pt-2 pb-4">
                <DisclosureButton as="a" class="block" v-for="item in navigation">
                    <router-link
                        :key="item.name"
                        :to="item.href"
                        :class="[this.$route.path === item.href ? 'block border-l-4 border-blue-400 bg-indigo-50 py-2 pl-3 pr-4 text-base font-medium text-neutral-700' :
                                    'block py-2 pl-3 pr-4 text-base font-medium text-neutral-700']"
                    >
                        {{ item.name }}
                    </router-link>
                </DisclosureButton>
            </div>
        </DisclosurePanel>

    </Disclosure>
</template>

<script>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon } from '@heroicons/vue/24/outline'
import {defineComponent} from "vue";
import StorageLogo from "../icons/StorageLogo.vue";


export default defineComponent({
    data() {
        return {
            navigation: [
                {name: 'Склад', href: '/', current: true},
            ]
        }
    },
    components: {
        Bars3Icon,
        Disclosure,
        DisclosureButton,
        DisclosurePanel,
        XMarkIcon,
        StorageLogo
    },
})

</script>
