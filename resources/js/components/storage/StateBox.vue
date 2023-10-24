<template>
    <div>
        <div class="flex justify-between">
            <div>{{this.getNameBox(boxes[0].type)}}</div>
            <div>{{ boxes.length }}</div>
        </div>
    </div>
</template>

<script>
export default {
    name: "StateBox",
    props: {
        boxes: Array
    },
    methods: {
        getNameBox(type) {
            let index = type.lastIndexOf('\\') + 1;
            return type.slice(index);
        }
    }
}
</script>

<style scoped>

</style>
