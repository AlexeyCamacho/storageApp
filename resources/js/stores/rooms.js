import { defineStore } from 'pinia'
import apiRoomsService from '../API/rooms.js';

export const useRoomsStore = defineStore('rooms',{
    id: 'room',
    state: () => ({
        rooms: [],
        loading: false,
        error: null
    }),
    actions: {
        async loadRooms() {
            this.rooms = []
            this.loading = true
            try {
                this.rooms = await apiRoomsService.getAllRooms()
                    .then((response) => response.data )
            } catch (error) {
                this.error = error
            } finally {
                this.loading = false
            }
        },
    }
})
