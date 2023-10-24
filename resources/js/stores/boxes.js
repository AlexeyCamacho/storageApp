import { defineStore } from 'pinia'
import apiBoxesService from '../API/boxes.js';
import { useToast } from 'vue-toastification';
const toast = useToast()

export const useBoxesStore = defineStore('boxes',{
    id: 'box',
    state: () => ({
        error: null
    }),
    actions: {
        async importBoxes(data) {
            try {
                await apiBoxesService.importBoxes(data)
                    .then((response) => {
                        toast.success('Ящики импортированы');
                        return true;
                    })
            } catch (error) {
                this.error = error;
                toast.error(error.response.data.message);
            }
        },
        async exportBoxes(data) {
            try {
                await apiBoxesService.exportBoxes(data)
                    .then((response) => {
                        toast.success('Ящики экспортированы');
                        return true;
                    })
            } catch (error) {
                this.error = error;
                toast.error(error.response.data.message);
            }
        },
        async moveBoxes(data) {
            try {
                await apiBoxesService.moveBoxes(data)
                    .then((response) => {
                        toast.success('Ящики перемещены');
                        console.log(response.data)
                        return true;
                    })
            } catch (error) {
                this.error = error;
                toast.error(error.response.data.message);
            }
        },
    }
})
