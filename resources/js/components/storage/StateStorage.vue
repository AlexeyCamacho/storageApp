<template>
    <div class="mb-4 border-2 rounded-md p-2 border-gray-400">
        <div class="text-lg mb-1 border-b-2">Состояние склада:</div>
        <div class="w-1/6">
            <template v-for="boxes in this.getStateStore">
                <StateBox :boxes="boxes"></StateBox>
            </template>
        </div>
    </div>
</template>

<script>
import StateBox from "./StateBox.vue";

export default {
    name: "StateStorage",
    components: {StateBox},
    props: {
        rooms: Array
    },
    computed: {
        getStateStore() {
            let boxesCountByType = {};
            if (!this.rooms.length) {
                return;
            }
            for(let key in this.rooms) {
                let room = this.rooms[key];
                for(let keyBox in room.boxes) {
                    let box = room.boxes[keyBox];
                    if (!(box.type in boxesCountByType)) {
                        boxesCountByType[box.type] = [];
                    }
                    boxesCountByType[box.type].push(box);
                }
            }
            return boxesCountByType;
        }
    }
}
</script>

<style scoped>

</style>
