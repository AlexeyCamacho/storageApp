<template>
    <div class="border-gray-400 border-2 rounded-md p-2">
        <div class="border-b-2 border-gray-300 flex justify-between">
            {{ this.room.name }}
        </div>
        <div>
            <template v-for="boxes in this.getBoxesCountByType">
                <StateBox :boxes="boxes"></StateBox>
            </template>
        </div>
    </div>
</template>

<script>
import StateBox from "./StateBox.vue";
export default {
    name: "StateRoom",
    props: {
        room: Object
    },
    components: {
        StateBox
    },
    computed: {
        getBoxesCountByType() {
            let boxesCountByType = {};
            if (!this.room) {
                return;
            }
            for(let key in this.room.boxes) {
                let box = this.room.boxes[key];
                if (!(box.type in boxesCountByType)) {
                    boxesCountByType[box.type] = [];
                }
                boxesCountByType[box.type].push(box);
            }
            return boxesCountByType;
        }
    }
}
</script>

<style scoped>

</style>
