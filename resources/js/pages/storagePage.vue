<template>
    <div class="py-2">
        <div class="mb-2 flex gap-2">
            <div>
                <PrimaryButton @click="this.showImportBoxesModal = true">Импорт</PrimaryButton>
            </div>
            <div>
                <SecondaryButton @click="this.showExportBoxesModal = true">Экспорт</SecondaryButton>
            </div>
            <div>
                <SecondaryButton @click="this.showMoveBoxesModal = true">Переместить</SecondaryButton>
            </div>
        </div>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-3">
            <StateStorage :rooms="this.roomsStore.rooms"></StateStorage>
            <div class="grid grid-cols-4 gap-2">
                <template v-for="room in this.roomsStore.rooms">
                    <StateRoom :room="room"></StateRoom>
                </template>
            </div>
        </div>
    </div>

    <FormBoxesModal v-model:show="this.showImportBoxesModal" v-model:processing="this.processing" @submit="importBoxes" :name="'Импорт'"></FormBoxesModal>
    <FormBoxesModal v-model:show="this.showExportBoxesModal" v-model:processing="this.processing" @submit="exportBoxes" :name="'Экспорт'"></FormBoxesModal>
    <MoveBoxesModal v-model:show="this.showMoveBoxesModal" v-model:processing="this.processing" :options="this.getRoomsOptions" @submit="moveBoxes" :name="'Перемещение'"></MoveBoxesModal>
</template>

<script>
import StateStorage from "../components/storage/StateStorage.vue";
import StateRoom from "../components/storage/StateRoom.vue";
import { useRoomsStore } from '../stores/rooms'
import PrimaryButton from "../components/shared/buttons/PrimaryButton.vue";
import SecondaryButton from "../components/shared/buttons/SecondaryButton.vue";
import FormBoxesModal from "../components/shared/modal/FormBoxesModal.vue";
import {useBoxesStore} from "../stores/boxes.js";
import MoveBoxesModal from "../components/shared/modal/MoveBoxesModal.vue";
export default {
    name: "storagePage",
    setup() {
        const roomsStore = useRoomsStore();
        const boxesStore = useBoxesStore();
        return { roomsStore, boxesStore }
    },
    data() {
        return {
            showImportBoxesModal: false,
            showExportBoxesModal: false,
            showMoveBoxesModal: false,
            processing: false,
        }
    },
    components: {
        MoveBoxesModal,
        SecondaryButton,
        PrimaryButton,
        StateRoom,
        StateStorage,
        FormBoxesModal
    },
    methods: {
        importBoxes(data) {
            this.boxesStore.importBoxes(data)
                .then((res) => {
                    this.roomsStore.loadRooms();
            }).finally(() => {
                this.processing = false;
                this.showImportBoxesModal = false;
            })
        },
        exportBoxes(data) {
            this.boxesStore.exportBoxes(data)
                .then((res) => {
                    this.roomsStore.loadRooms();
                }).finally(() => {
                this.processing = false;
                this.showExportBoxesModal = false;
            })
        },
        moveBoxes(data) {
            this.boxesStore.moveBoxes(data)
                .then((res) => {
                    this.roomsStore.loadRooms();
                }).finally(() => {
                this.processing = false;
                this.showMoveBoxesModal = false;
            })
        }
    },
    computed: {
        getRoomsOptions() {
            let options = [];
            this.roomsStore.rooms.forEach((room) => {
                options.push({
                    value: room.id,
                    name: room.name
                });
            });
            return options;
        }
    },
    mounted() {
        this.roomsStore.loadRooms();
    },
}
</script>

<style scoped>

</style>
