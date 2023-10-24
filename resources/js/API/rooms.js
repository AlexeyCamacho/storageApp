let path = '/api/rooms'
import axios from 'axios'

export default {
    async getAllRooms() {
        return axios.get(`${path}`);
    },
}
