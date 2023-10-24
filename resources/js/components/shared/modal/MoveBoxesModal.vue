<template>
    <Modal :show="this.show" @close="closeModal" :max-width="'md'">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ this.name }} ящиков
            </h2>
            <form>
                <div class="form-control w-full my-1">
                    <label class="label" for="name">
                        <span class="label-text">Переместить из</span>
                    </label>
                    <Select v-model="this.boxesForm.data.from" :options="this.options"></Select>
                </div>
                <div class="form-control w-full my-1">
                    <label class="label" for="name">
                        <span class="label-text">Переместить в</span>
                    </label>
                    <Select v-model="this.boxesForm.data.to" :options="this.options"></Select>
                </div>
                <div class="form-control w-full my-1">
                    <label class="label" for="name">
                        <span class="label-text">Кол-во ящиков с яблоками</span>
                    </label>
                    <InputNumber type="number" v-model="this.boxesForm.data.countBoxes.apple"></InputNumber>
                </div>
                <div class="form-control w-full my-1">
                    <label class="label" for="name">
                        <span class="label-text">Кол-во ящиков с грушами</span>
                    </label>
                    <InputNumber type="number" v-model="this.boxesForm.data.countBoxes.pear"></InputNumber>
                </div>
                <div class="form-control w-full my-1">
                    <label class="label" for="name">
                        <span class="label-text">Кол-во ящиков с апельсинами</span>
                    </label>
                    <InputNumber type="number" v-model="this.boxesForm.data.countBoxes.orange"></InputNumber>
                </div>
            </form>

            <div class="mt-6 flex justify-end gap-2">
                <SecondaryButton @click="closeModal">Отмена</SecondaryButton>
                <PrimaryButton :class="{ 'opacity-25': this.processing }"
                               :disabled="this.processing"
                               @click="submit"
                >{{ this.name }}</PrimaryButton>
            </div>
        </div>
    </Modal>
</template>

<script>
import Modal from './Modal.vue';
import InputNumber from "../inputs/InputNumber.vue";
import PrimaryButton from "../buttons/PrimaryButton.vue";
import SecondaryButton from "../buttons/SecondaryButton.vue";
import Select from "../inputs/Select.vue";

export default {
    components: {
        Select,
        SecondaryButton,
        PrimaryButton,
        InputNumber,
        Modal,
    },
    props: {
        show: Boolean,
        processing: Boolean,
        name: String,
        options: Array,
    },
    emits: ['update:show', 'update:processing', 'submit'],
    computed: {
        proxyShow: {
            get() {
                return this.show
            },
            set(value) {
                this.$emit('update:show', value)
            }
        },
        proxyProcessing: {
            get() {
                return this.processing
            },
            set(value) {
                this.$emit('update:processing', value)
            }
        }
    },
    data() {
        return {
            boxesForm: {
                data: {
                    countBoxes: {
                        apple: 0,
                        pear: 0,
                        orange: 0,
                    },
                    from: 0,
                    to: 0
                },
            }
        }
    },
    methods: {
        closeModal() {
            this.proxyShow = false;
            this.resetImportBoxesForm();
        },
        async submit() {
            this.proxyProcessing = true;
            this.$emit('submit', this.boxesForm.data);
            this.resetImportBoxesForm();
        },
        resetImportBoxesForm() {
            for (let key in this.boxesForm.data.countBoxes) {
                this.boxesForm.data.countBoxes[key] = 0;
            }
            this.boxesForm.data.to = 0;
            this.boxesForm.data.from = 0;
        }
    },
}
</script>
